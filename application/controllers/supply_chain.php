<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supply_chain extends MY_Controller
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

		$this->load->model('agency_model');

	}

	public function index()
	{

		$this->show_agency_id();

	}


	public function show_agency_id() {
		$id = $this->uri->segment(3);//get id from the url
		$data['agencies'] = $this->agency_model->show_supply_chain_agencies();
		$data['single_agency'] = $this->agency_model->show_supply_chain_agencies_id($id);

		$this->load->view('supply_chain',$data);
	}

	function update_agency_id1() {
		$id= $this->input->post('supply_agency_id');
		$data = array(
			'SUPPLY_CHAIN_AGENCY' => $this->input->post('supply_agency_name'),
			'CONTACT_PERSON' => $this->input->post('contact_person'),
			'CONTACT_PHONE' => $this->input->post('contact_phone'),
			'COMMENT' => $this->input->post('supply_agency_description'),
			'EMAIL' => $this->input->post('email')

		);
		$updaterecord=$this->agency_model->update_supply_chain_agencies_id1($id,$data);

		$data['formupdate'] =  "";
		if($updaterecord){
			$data['formupdate'] =  "set";
		}


		$id = $this->uri->segment(3);//get id from the url
		$data['agencies'] = $this->agency_model->show_supply_chain_agencies();
		$data['single_agency'] = $this->agency_model->show_supply_chain_agencies_id($id);


		//$this->load->view('supply_chain',$data);
//bildad changed this to a redirect on 14 of july 2015 at 2.05 am
		// $this->show_agency_id();
        redirect(base_url()."supply_chain");
	}

	function delete_supply_chain_agency($id)   {

		$this->db->where('supply_chain_agency_id', $id);
		$deleterecord=$this->db->delete('supply_chain_agencies');
		$data['status'] =  "";
		if($deleterecord){
			$data['status'] =  "Agency deleted Successfully!..";
		}

		$this->show_agency_id();
	}





	public function save_supply_chain_agency()
	{
		$agency_name = ($this->input->post('supply_agency_name'));
		$person = ($this->input->post('contact_person'));
		$contact = ($this->input->post('contact_phone'));
		$phone = ($this->input->post('supply_chain_description'));
		$email = ($this->input->post('email'));


		$agency = array(
			'SUPPLY_CHAIN_AGENCY' => $agency_name,
			'CONTACT_PERSON' => $person,
			'CONTACT_PHONE' => $contact,
			'COMMENT' => $phone,
			'EMAIL' => $email
		);

		$agencyId = $this->agency_model->add_supply_chain_agency($agency);
		$data['message'] = "";
		if ($agencyId) {
			$data['message'] = "Agency Saved Successfully!..";
		}

		redirect(base_url()."supply_chain");

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */