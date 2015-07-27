<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Current_stock extends CI_Controller {

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

        $this->load->view('current_stock',$datacl);


        /*$datacl['central_level'] = $this->stocks_model->show_sorted_central_stock();*/
        /*$this->load->view('current_stock',$datacl);*/


    }

    public function update_central_level(){
        /*	$today = date("Ym"); */

        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        $id= $this->input->post('central_level_stock_id');//central_level_stock_id
        $f_agency_name= ($this->input->post('funding_agency_name'));
        $today = date("Ym");

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

        $commodity_name=($this->input->post('commodity_name'));
        $supply_chain_agency= ($this->input->post('supply_chain_agency'));
        $f_agency_name= ($this->input->post('funding_agency_name'));
        $today = date("Ym");
        $time = date("F j, Y, g:i a");

        $dataArray = array(
            'period'=>$today,
            'funding_agency_id' => $this->agency_model->get_funding_agency_id($f_agency_name),
            'commodity_id' => $this->commodity_model->get_commodity_id_with_the_given_name($this->input->post('commodity_name')),	//GET THE COMODITIES ID
            'supply_agency_id' =>$this->agency_model->get_agency_id_with_the_given_name($supply_chain_agency),
            'soh_closing_balance'=>$this->input->post('soh_closing_balance'),


        );

        $this->stocks_model->add_central_stock($dataArray);

        $this->show_central_level_stock();



    }



}
/*save_central_level*/

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */