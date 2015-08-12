<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commodity extends MY_Controller
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

        $this->load->model('commodity_model');
    }

    public function index()
    {
        $this->show_commodities();
    }

    public function show_commodities() {
        $data['commodity'] = $this->commodity_model->show_malaria_commodities();
        $this->load->view('commodity',$data);

    }

    function update_commodity() {
        $id= $this->input->post('commodity_id');
        $data = array(
            'alt_name'=>$this->input->post('alt_name'),
            'commodity_name' => $this->input->post('commodity_name'),
            'unit_of_measure' => $this->input->post('unit_of_measure'),
            'commodity_description' => $this->input->post('commodity_description'),
        );
        $this->commodity_model->update_commodity($id,$data);
        $this->show_commodities();

    }


    function delete_commodity($id)   {

        $this->db->where('commodity_id', $id);
        $deleterecord=$this->db->delete('malaria_commodities');
        $data['status'] =  "";

        $this->show_commodities();
    }

    public function save_commodity(){

        //$this->load->helper('string');

        $commodity_name= ($this->input->post('commodity_name'));
        $uom= ($this->input->post('unit_of_measure'));
        $commodity_comment= ($this->input->post('commodity_description'));

        $commodity = array(
            'alt_name'=>$this->input->post('alt_name'),
            'commodity_name' => $commodity_name,
            'unit_of_measure' => $uom,
            'commodity_description' => $commodity_comment,
            'commodity_id'=>random_string('alnum', 16)
        );

        $commodityId = $this->commodity_model->add_commodity($commodity);
        $this->show_commodities();



    }





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */