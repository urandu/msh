<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_shipments extends MY_Controller
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
        $this->load->model('pending_shipments_model');
    }
    public function index()
    {
        $this->show_pending_shipments();
    }
    public function show_pending_shipments() {
        $data2['ALL_SHIPMENTS'] = $this->pending_shipments_model->show_all_pending_shipment();
        $data2['COMMODITY']=$this->pending_shipments_model->show_commodities();
        $data2['FUNDING']=$this->pending_shipments_model->show_fundingorgs();
        $this->load->view('pending_shipments',$data2);
    }
    public function show_pending_shipments_from_selected_period() {
        $period= ($this->input->post('pending_shipments_period'));
        $psid = $this->uri->segment(3);//get id from the url
        $data2['PSTOCKS'] = $this->pending_shipments_model->show_pending_shipment($period);
        $data2['single_PSTOCKS'] = $this->pending_shipments_model->show_pending_shipment_id($psid);
        $data2['COMMODITY']=$this->pending_shipments_model->show_commodities();
        $data2['FUNDING']=$this->pending_shipments_model->show_fundingorgs();
        $data2['pending_shipment_successfully_retrieved'] = "";
        $data2['ALL_SHIPMENTS'] = $this->pending_shipments_model->show_all_pending_shipment();
        if ($data2['PSTOCKS'] = $this->pending_shipments_model->show_pending_shipment($period)){
            $data2['pending_shipment_successfully_retrieved'] = "retrieved";// display in view only if data is retrieved
        }
        $this->load->view('pending_shipments',$data2);
    }
    public function save_pending_shipment(){
        $period= (str_replace("-",null,$this->input->post('period')));

        $commodity_name= ($this->input->post('commodity_name'));
        $pack_size= ($this->input->post('pack_size'));
        $funding_agency= ($this->input->post('funding_agency'));
        $quantity= ($this->input->post('quantity'));
        $expected_time_of_arrival= ($this->input->post('expected_time_of_arrival'));
        $pddescription=($this->input->post('pddescription'));

        $commodity_id=$this->pending_shipments_model->get_commodity_id_with_the_given_name($commodity_name);
        $funding_agency_Id=$this->pending_shipments_model->get_funding_agency_id($funding_agency);

        $pendingStock = array(
            'commodity_id'=>$commodity_id,
            //'pack_size'=>$pack_size,
            'funding_agency_id'=>$funding_agency_Id,
            'quantity'=>$quantity,
            'comments'=>$pddescription,
            'expected_time_of_arrival'=>$expected_time_of_arrival,
            'period'=>$period
        );

        $psId = $this->pending_shipments_model->add_pending_shipment($pendingStock);
        $data['pending_delivery_message'] =  "";
        if($psId){
            $data['pending_delivery_message'] =  "The Pending Stock was saved successfully!..";
        }

        $query = $this->pending_shipments_model->show_all_pending_shipment();
        if($query){
            $data['STATICPARAMS'] =  $query;
        }
        redirect(base_url()."pending_shipments");
    }
    public function update_pending_shipment_id() {
        $id= $this->input->post('pending_sipment_id');
        $commodity_name= $this->input->post('commodity_name');
        //'pack_size' => $this->input->post('pack_size'),
        $funding_agency_name = $this->input->post('funding_agency');
        $commodity_id=$this->pending_shipments_model->get_commodity_id_with_the_given_name($commodity_name);
        $funding_agency_id=$this->pending_shipments_model->get_funding_agency_id($funding_agency_name);
        $data = array(
            'period'=>$this->input->post('period'),
            'quantity' => $this->input->post('quantity'),
            'expected_time_of_arrival'=>$this->input->post('expected_date_delivery'),
            'comments'=>$this->input->post('pddescription'),
            'commodity_id'=>$commodity_id,
            'funding_agency_id'=>$funding_agency_id,
        );
        $this->pending_shipments_model->update_pending_shipment($id,$data);
        //$this->show_pending_shipments_from_selected_period();
        redirect(base_url()."pending_shipments");
    }
    public function delete_pending_shipment($id){
        //$id= $this->input->post('pendingstockid');
        $this->db->where('pending_shipment_id', $id);
        $deleterecord=$this->db->delete('pending_shipment_details');
        $data['status'] =  "";
        if($deleterecord){
            $data['status'] =  "Parameter deleted Successfully!..";
        }
       // $this->show_pending_shipments_from_selected_period();
        redirect(base_url()."pending_shipments");
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */