<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Current_stock extends MY_Controller
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

        $this->load->model('stocks_model');
        $this->load->model('commodity_model');
        $this->load->model('agency_model');
    }

    public function index()
    {
        $this->show_central_level_stock();
    }



    public function show_central_level_stock(){

        $datacl['central_level'] = $this->stocks_model->show_central_stock();
        $datacl['commodity'] = $this->commodity_model->show_malaria_commodities();
        $datacl['supply_chain_agency'] = $this->agency_model->show_supply_chain_agencies();
        $datacl['funding_agency'] = $this->agency_model->show_funding_orgs();

        $this->load->view('current_stock',$datacl);
    }

    public function update_central_level(){

        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        $id= $this->input->post('central_level_stock_id');//central_level_stock_id
        $f_agency_name= ($this->input->post('funding_agency'));

        $data = array(
            'commodity_id' => $this->commodity_model->get_commodity_id_with_the_given_name($this->input->post('commodity_name')),
            //'pack_size' => $this->input->post('pack_size'),
            'supply_agency_id' =>$this->agency_model->get_agency_id_with_the_given_name($supply_chain_agency),
            'funding_agency_id' => $this->agency_model->get_funding_agency_id($f_agency_name),
            'opening_balance' => $this->input->post('opening_balance'),
            'total_receipts_from_suppliers'=>$this->input->post('total_receipts_from_suppliers'),
            'soh_closing_balance'=>$this->input->post('soh_closing_balance'),
            'total_issues_to_facilities'=>$this->input->post('total_issues_to_facilities'),
            'earliest_expiry_date'=>$this->input->post('earliest_expiry_date'),
            'quantity_expiring'=>$this->input->post('quantity_expiring'),
            //'report_date'=>$this->input->post('report_date'),
        );
        $this->stocks_model->update_central_data($id,$data);
        $this->show_central_level_stock();



    }

    public function delete_central_level_data($id){



        $this->db->where('central_level_stock_id', $id);
        $deleterecord=$this->db->delete('central_level_data');
        $data['status'] =  "";
        if($deleterecord){
            $data['status'] =  "Parameter deleted Successfully!..";
        }
        //$this->show_central_level_stock();
        redirect(base_url()."current_stock");


    }



    public function save_central_level(){

        $commodity_name=($this->input->post('commodity_name'));
        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        $f_agency_name= ($this->input->post('funding_agency'));


        $dataArray = array(
            'funding_agency_id' => $this->agency_model->get_funding_agency_id($f_agency_name),
            'commodity_id' => $this->commodity_model->get_commodity_id_with_the_given_name($this->input->post('commodity_name')),	//GET THE COMODITIES ID
            'supply_agency_id' =>$this->agency_model->get_agency_id_with_the_given_name($supply_chain_agency),
            'opening_balance' => $this->input->post('opening_balance'),
            'total_receipts_from_suppliers'=>$this->input->post('total_receipts_from_suppliers'),
            'soh_closing_balance'=>$this->input->post('soh_closing_balance'),
            'total_issues_to_facilities'=>$this->input->post('total_issues_to_facilities'),
            'earliest_expiry_date'=>$this->input->post('earliest_expiry_date'),
            'quantity_expiring'=>$this->input->post('quantity_expiring'),
            'report_date'=>str_replace("-",null,$this->input->post('report_date')),
            'batch_number'=>$this->input->post('batch_number')

        );


        $this->stocks_model->add_central_stock($dataArray);

        //$this->show_central_level_stock();
        redirect(base_url()."current_stock");


    }



}
/*save_central_level*/

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */