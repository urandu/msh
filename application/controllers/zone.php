<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone extends MY_Controller
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

		$this->load->model('zone_model');

	}


	public function index()
	{
		$this->show_zone_id();
	}


	public function show_zone_id() {
		$id = $this->uri->segment(3);//get id from the url
		$data['zones'] = $this->zone_model->show_zones();
		$data['single_zone'] = $this->zone_model->show_zone_id($id);
		$this->load->view('zone',$data);
	}


	function update_zone_id1() {
		$id= $this->input->post('zone_id');
		$data = array(
			'zone' => $this->input->post('zone_name'),
			'comment' => $this->input->post('zone_comment'),
		);
		$update_zone=$this->zone_model->update_zones_id1($id,$data);
		$data['status'] =  "";
		if ($update_zone) {
			$data['status'] =  "Zone updated Successfully!..";
		}
		//$this->show_zone_id();
        redirect(base_url()."zone");
	}

	function save_zone() {
		$data = array(
			'zone' => $this->input->post('zone_name'),
			'comment' => $this->input->post('zone_comment'),
		);
		$save_zone=$this->zone_model->add_zone($data);
		$data['status'] =  "";
		if ($save_zone) {
			$data['status'] =  "Zone saved Successfully!..";
		}

        redirect(base_url()."zone");
    }

	function delete_zone($id)   {
		$deleterecord=$this->zone_model->delete_zone($id);
		$data['status'] =  "";
		if($deleterecord){
			$data['status'] =  "Zone deleted Successfully!..";
		}

		//$this->show_zone_id();
        redirect(base_url()."zone");
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */