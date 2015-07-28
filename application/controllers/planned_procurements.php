<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planned_procurements extends MY_Controller
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
        $this->load->model('planned_procurements_model');
    }
    public function index()
    {
        $this->show_planned_procurements();
    }
    public function show_planned_procurements() {
        $data2['ALL_SHIPMENTS'] = $this->planned_procurements_model->show_all_planned_procurement();
        $data2['COMMODITY']=$this->planned_procurements_model->show_commodities();
        $data2['FUNDING']=$this->planned_procurements_model->show_fundingorgs();
        $this->load->view('planned_procurements',$data2);
    }
    public function show_planned_procurements_from_selected_planned_delivery_date() {
        $planned_delivery_date= ($this->input->post('planned_procurements_planned_delivery_date'));
        $psid = $this->uri->segment(3);//get id from the url
        $data2['PSTOCKS'] = $this->planned_procurements_model->show_planned_procurement($planned_delivery_date);
        $data2['single_PSTOCKS'] = $this->planned_procurements_model->show_planned_procurement_id($psid);
        $data2['COMMODITY']=$this->planned_procurements_model->show_commodities();
        $data2['FUNDING']=$this->planned_procurements_model->show_fundingorgs();
        $data2['planned_procurement_successfully_retrieved'] = "";
        $data2['ALL_SHIPMENTS'] = $this->planned_procurements_model->show_all_planned_procurement();
        if ($data2['PSTOCKS'] = $this->planned_procurements_model->show_planned_procurement($planned_delivery_date)){
            $data2['planned_procurement_successfully_retrieved'] = "retrieved";// display in view only if data is retrieved
        }
        $this->load->view('planned_procurements',$data2);
    }
    public function save_planned_procurement(){

        $commodity_name= ($this->input->post('commodity_name'));
        $funding_agency= ($this->input->post('funding_agency'));


        $commodity_id=$this->planned_procurements_model->get_commodity_id_with_the_given_name($commodity_name);
        $funding_agency_id=$this->planned_procurements_model->get_funding_agency_id($funding_agency);

        $pendingStock = array(
            'planned_delivery_date'=>$this->input->post('planned_delivery_date'),
            'quantity' => $this->input->post('quantity'),
            'comment'=>$this->input->post('ppdescription'),
            'commodity_id'=>$commodity_id,
            'funding_agency_id'=>$funding_agency_id,

        );

        $psId = $this->planned_procurements_model->add_planned_procurement($pendingStock);
        $data['pending_delivery_message'] =  "";
        if($psId){
            $data['pending_delivery_message'] =  "The Pending Stock was saved successfully!..";
        }

        $query = $this->planned_procurements_model->show_all_planned_procurement();
        if($query){
            $data['STATICPARAMS'] =  $query;
        }
        redirect(base_url()."planned_procurements");
    }
    public function update_planned_procurement_id() {
        $id= $this->input->post('planned_procurement_id');
        $commodity_name= $this->input->post('commodity_name');
        //'pack_size' => $this->input->post('pack_size'),
        $funding_agency_name = $this->input->post('funding_agency');
        $commodity_id=$this->planned_procurements_model->get_commodity_id_with_the_given_name($commodity_name);
        $funding_agency_id=$this->planned_procurements_model->get_funding_agency_id($funding_agency_name);
        $data = array(
            'planned_delivery_date'=>$this->input->post('planned_delivery_date'),
            'quantity' => $this->input->post('quantity'),
            'comment'=>$this->input->post('ppdescription'),
            'commodity_id'=>$commodity_id,
            'funding_agency_id'=>$funding_agency_id,
        );
        $this->planned_procurements_model->update_planned_procurement($id,$data);
        //$this->show_planned_procurements_from_selected_planned_delivery_date();
        redirect(base_url()."planned_procurements");
    }
    public function delete_planned_procurement($id){
        $this->db->where('planned_procurement_id', $id);
        $deleterecord=$this->db->delete('planned_procurement_details');
        $data['status'] =  "";
        if($deleterecord){
            $data['status'] =  "Parameter deleted Successfully!..";
        }
        // $this->show_planned_procurements_from_selected_planned_delivery_date();
        redirect(base_url()."planned_procurements");
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */