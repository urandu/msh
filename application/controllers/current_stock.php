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



    public function show_central_level_stock($period="000000"){

        //$datacl['central_level_data_by_period']=$this->stocks_model->show_current_stock_by_period($selected_period);
        /*$datacl['central_level'] = $this->stocks_model->show_central_stock();
        show_sorted_central_stock*/

        $period_post=$this->input->post("period");
        if(isset($period_post))
        {
            $period=$period_post;
        }

        $datacl['central_level_data_by_period']=$this->stocks_model->show_current_stock_by_period($period);
        $datacl['central_level'] = $this->stocks_model->show_sorted_central_stock();
        $datacl['commodity'] = $this->commodity_model->show_malaria_commodities();
        $datacl['supply_chain_agency'] = $this->agency_model->show_supply_chain_agencies();
        $datacl['funding_agency'] = $this->agency_model->show_funding_orgs();
        $datacl['period']=$period;
        $datacl['pending_shipment'] = $this->stocks_model->show_pending_shipments();

        /*show_pending_shipments*/

        $this->load->view('current_stock',$datacl);


        /*$datacl['central_level'] = $this->stocks_model->show_sorted_central_stock();*/
        /*$this->load->view('current_stock',$datacl);*/


    }

    public function update_central_level(){
        /*	$today = date("Ym"); */

        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        $id= $this->input->post('central_level_stock_id');//central_level_stock_id
        $f_agency_name= ($this->input->post('funding_agency_name'));

        $today = $this->input->post('period');

        $data = array(
            'period'=>$today,
            'commodity_id' => $this->commodity_model->get_commodity_id_with_the_given_name($this->input->post('commodity_name')),
            'soh_closing_balance'=>$this->input->post('soh_closing_balance'),
            'supply_agency_id' =>$this->agency_model->get_agency_id_with_the_given_name($supply_chain_agency),
            'funding_agency_id' => $this->agency_model->get_funding_agency_id($f_agency_name),

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
        $this->show_central_level_stock();



    }



    public function save_central_level(){

        //$commodity_name=($this->input->post('commodity_name'));
        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        //$f_agency_name= ($this->input->post('funding_agency_name'));
        $date = $this->input->post('period');
        $quantity_received=$this->input->post('soh_closing_balance');
        $pid=$this->input->post('pending_shipment_id');
        $values=$this->stocks_model->show_pending_shipment_by_id($pid);
        foreach ($values as $key) {
            $commodity_id=$key->commodity_id;
            $funding_agency_id=$key->funding_agency_id;
            $expected_quantity=$key->quantity;
            
        }
        if($quantity_received < $expected_quantity || $quantity_received==$expected_quantity){
             $today=str_replace("-", null, $date);
        $data_array = array(
            'pending_stock_id'=>$pid,
            'period'=>$today,
            'funding_agency_id' => $funding_agency_id,
            'commodity_id' => $commodity_id,    //GET THE COMODITIES ID
            'supply_agency_id' =>$this->agency_model->get_agency_id_with_the_given_name($supply_chain_agency),
            'soh_closing_balance'=>$quantity_received,


        );
        $this->stocks_model->add_central_stock($data_array);
        $fetched_data=$this->stocks_model->show_pending_shipment($pid);
        foreach ($fetched_data as $value) {
            $quantity_on_hand=$value->quantity;
        }
        $quantity_remaining=$quantity_on_hand-$quantity_received;

        if($quantity_remaining!=0){

            $second_array= array('quantity' =>$quantity_remaining);
       $this->stocks_model->update_pending_shipment($pid, $second_array);
       $this->show_central_level_stock();

        }else{
            $this->stocks_model->delete_pending_data($pid);
            $this->show_central_level_stock();
        }
    }else{
        /*$data['msg']="The quantity you entered as received is more than the quantity expected.";
        $this->show_central_level_stock();*/
        echo " <font color= #FF0000 ><b> Error! Quantity received is more than quantity expected</b></font>";
        $this->show_central_level_stock();

    }
       

       



    }

    function get_by_id()
    {
        $pending_shipment_id = $_GET['pending_shipment_id'];
        $data=$this->stocks_model->show_pending_shipment_by_id($pending_shipment_id);
        
        $data_array = array();
        foreach($data as $myvalue){
        $commodity_id=$myvalue->commodity_id;
        $funding_agency_id=$myvalue->funding_agency_id;
        $funding_agency_name=$this->stocks_model->get_funding_agency_name($funding_agency_id);
        $commodity_name= $this->stocks_model->get_commodity_id_with_the_given_id($commodity_id);
       
        $data_array[] = $funding_agency_id;
        $data_array[] = $funding_agency_name;
        $data_array[] = $commodity_id;
        $data_array[] = $commodity_name;
        //echo($funding_agency_name." ".$commodity_name);
        }
        /*NOTES:
            0 - funding agency id
            1 - funding agency name
            2 - commodity id
            3 - commodity name
        */   
        $return = json_encode($data_array);
        echo $return;
        
    }



}
/*save_central_level*/

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */