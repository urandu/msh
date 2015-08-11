<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forecast extends MY_Controller
{
    private $data;
    protected $before_filter = array(
        'action' => '_check_if_logged_in',
        'except' => array()
    );

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	function __construct()
    {
       parent::__construct();

     $this->load->model("commodity_model");
      $this->load->model("forecast_model");
    }

    public function index($period="000000"){

        $period_post=$this->input->post("date");
        if(isset($period_post))
        {
            $period=$period_post;


    
        }
      $forecast_data['dates']=$this->forecast_model->get_forecast_period();
      $forecast_data['selected_period']=$period;
        $forecast_data['period']=$this->forecast_model->show_commodity_forecast_data($period);
        $forecast_data['commodity']=$this->commodity_model->show_malaria_commodities();
        $this->load->view('forecast',$forecast_data);
        

       

    }
    public function save_forecast_commodity_data()
    {
      $date=($this->input->post('forecast_start_date'));
      $period=($this->input->post('forecast_period'));

      //$commodity_id=($this->input->post('commodity_id'));
      $commodity_name=($this->input->post('commodity_name'));
      $commodity_id=$this->forecast_model->get_commodity_id_with_the_given_name($commodity_name);

      $monthly_consumption=($this->input->post('forecast_monthly_consumption'));
      $start_date=str_replace("-", null, $date);

      $forecast = array(
			'forecast_start_date' => $start_date,
			'forecast_period' => $period,
			'commodity_id' => $commodity_id,
			'forecast_monthly_consumption' => $monthly_consumption
		);

         
     $this->forecast_model->add_commodity_forecast_data($forecast);
     $this->index($period="000000");




    }


    public function update_forecast_commodity_data()
    {
      $forecast_id=($this->input->post('id'));
      $start_date=($this->input->post('forecast_start_date'));
      $period=($this->input->post('forecast_period'));
      //$commodity_id=($this->input->post('commodity_id'));
      $commodity_name=($this->input->post('commodity_name'));
      $monthly_consumption=($this->input->post('forecast_monthly_consumption'));
      $commodity_id=$this->forecast_model->get_commodity_id_with_the_given_name($commodity_name);

      $forecast_update = array(
      'forecast_start_date' => $start_date,
      'forecast_period' => $period,
      'commodity_id' => $commodity_id,
      'forecast_monthly_consumption' => $monthly_consumption
    );


      $this->forecast_model->update_forecast_commodity_data($forecast_id, $forecast_update);
      $this->index($period="000000");

    }


    function delete_forecast($id)   {
  
   $this->db->where('commodity_forecast_data_id', $id);
   $deleterecord=$this->db->delete('commodity_forecast_data');
    
  $this->index($period="000000");
  }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>

