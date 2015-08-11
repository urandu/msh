<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_stocks extends MY_Controller
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

     $this->load->model('update_stocks_model');
    
    }
	public function index()
	{
		$this->show_current_stock();
	}

	
	public function show_current_stock($period="000000"){
		$period_post=$this->input->post("period");
		 if(isset($period_post))
        {
            $period=$period_post;
        }
        $data['update_stock']=$this->update_stocks_model->show_current_stock_by_period($period);
		$data['commodity']=$this->update_stocks_model->show_malaria_commodities();
		$data['stock']=$this->update_stocks_model->show_current_stock();
		$this->load->view('stock_update',$data);
	}

	public function save_current_data(){
		$qr=$this->input->post('quantity_received');
		$qi=$this->input->post('quantity_issued');
		$soh=$this->input->post('soh');
		$name=$this->input->post('commodity_name');
		$commodity_id=$this->update_stocks_model->get_commodity_id_with_the_given_name($name);
		$date = $this->input->post('period');
		$today=str_replace("-", null, $date);

		$my_array= array(
		'period'=>$today,
		'quantity_received' =>$qr,
		'quantity_issued'=>$qi,
		'soh'=>$soh,
		'commodity_id'=>$commodity_id,);

		$this->update_stocks_model->add_current_stock($my_array);
		$this->show_current_stock();

	}

	public function update_current_stock(){
		$id=$this->input->post('current_stock_id');
		$qr=$this->input->post('quantity_received');
		$qi=$this->input->post('quantity_issued');
		$soh=$this->input->post('soh');
		$name=$this->input->post('commodity_name');
		$commodity_id=$this->update_stocks_model->get_commodity_id_with_the_given_name($name);
		$today = $this->input->post('period');
		$my_array= array(
			'period'=>$today,
		'quantity_received' =>$qr,
		'quantity_issued'=>$qi,
		'soh'=>$soh,
		'commodity_id'=>$commodity_id);
		
		$this->update_stocks_model->update_commodity($id, $my_array);
		$this->show_current_stock();


		}


	 public function delete_data($id){	 	 
		$this->update_stocks_model->delete_current_data($id);
		$this->show_current_stock();
	 }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */