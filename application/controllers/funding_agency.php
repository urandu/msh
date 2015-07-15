<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funding_agency extends MY_Controller
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
        $this->show_funding_agency();
    }


    public function show_funding_agency()
    {


        //$funding_agency_id = $this->uri->segment(3);//get id from the url
        $data['funding_agency'] = $this->agency_model->show_funding_orgs();
        //$data['single_funding_agency'] = $this->agency_model->show_funding_org_id($funding_agency_id);
        $this->load->view('funding_agency',$data);

    }
    function update_funding_agency() {
        $id= $this->input->post('funding_agency_id');
        $data = array(
            'funding_agency_name' => $this->input->post('funding_agency_name'),
            'comment' => $this->input->post('funding_agency_description'),

        );
        $this->agency_model->update_funding_agency($id,$data);
        $this->show_funding_agency();
    }
    function delete_funding_agency($id){
        $this->db->where('funding_agency_id', $id);
        $this->db->delete('funding_agencies');

        $this->show_funding_agency();
    }
    public function save_funding_agency(){
        $agency_name= ($this->input->post('funding_agency_name'));
        $fdescription= ($this->input->post('funding_agency_description'));
        $fagency = array(
            'funding_agency_name' => $agency_name,
            'comment' => $fdescription
        );

        $fundingagencyId = $this->agency_model->add_funding_agency($fagency);
        $this->show_funding_agency();


    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */