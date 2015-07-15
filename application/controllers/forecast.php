<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forecast extends CI_Controller {

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
        $forecast_data['period']=$this->forecast_model->show_commodity_forecast_data($period);
        $forecast_data['commodity']=$this->commodity_model->show_malaria_commodities();
         $this->load->view('forecast',$forecast_data);

       /* $forecast_data['dates']=$this->forecast_model->get_forecast_period();
        //$forecast_data['period']=$this->forecast_model->show_commodity_forecast_data($period);
        $forecast_data['commodity']=$this->commodity_model->show_malaria_commodities();
       $forecast_data['period']=$this->forecast_model->get_commodity_forecast_data();

        //var_dump($forecast_data);

        $this->load->view('forecast',$forecast_data);*/

/**/
    }
    public function save_forecast_commodity_data()
    {
      $start_date=($this->input->post('forecast_start_date'));
      $period=($this->input->post('forecast_period'));
      $commodity_id=($this->input->post('commodity_id'));
     // $commodity_name=($this->input->post('commodity_name'));
      $monthly_consumption=($this->input->post('forecast_monthly_consumption'));

      $forecast = array(
			'forecast_start_date' => $start_date,
			'forecast_period' => $period,
			'commodity_id' => $commodity_id,
			'forecast_monthly_consumption' => $monthly_consumption
		);
         
     $this->forecast_model->add_commodity_forecast_data($forecast);
     $this->index();


    }

    public function update_commodity_forecast_data_id()
    {


    }

// 	public function show_commodity_forecast_data() {
// 		$fid = $this->uri->segment(3);//get id from the url
// 		$data3['staticParams'] = $this->forecast_model->show_commodity_forecast_data($period);
// 		$data3['single_staticparam'] = $this->forecast_model->show_commodity_forecast_data_id($fid);
//         $data3['COMMODITY']=$this->commodity_model->show_commodities();
//         $this->load->view('forecast',$data3);
// }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>