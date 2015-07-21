<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

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
	public function index()
	{
		//$this->load->view('county');
	}

    public function central_mos()
    {
        $this->load->view('central_mos');
    }
    public function facility_mos()
    {
        $this->load->view('facility_mos');
    }

    public function national_mos()
    {
        $this->load->view('national_mos');
    }

    public function county_mos()
    {
        $this->load->view('county_mos');
    }

    public function stocks()
    {

        $this->load->model('report_model');
        $commoditycomparison['COMMODITY']=$this->report_model->show_malaria_commodities();
        $commoditycomparison['FUNDING']=$this->report_model->show_funding_orgs();
        $commoditycomparison['PSTOCKS']=$this->report_model->pending_shipments();
        $commoditycomparison['SORTED']=$this->report_model->show_pending_shipments();
        $commoditycomparison['CENTRAL']=$this->report_model->show_central_stock();

        $this->load->view('stocks_report', $commoditycomparison);
    }
    public function commodities()
    {
     
         $this->load->model('report_model');
        $data['COMMODITY'] = $this->report_model->show_malaria_commodities();
        $data['pendingConsignments']=$this->report_model->show_pending_shipments();
        $data['pending_per_commodity'] = $this->report_model->show_pending_shipment_per_commodity();
        $this->load->view('commodities_report', $data);
        
    }

    public function agencies()
    {
         $this->load->model('report_model');
        $commodityperagency['COMMODITY']=$this->report_model->show_malaria_commodities();
        $commodityperagency['FUNDING']=$this->report_model->show_funding_orgs();
        $commodityperagency['PSTOCKS']=$this->report_model->pending_shipments();


         $this->load->view('agencies_report', $commodityperagency);
    }
    public function individual_commodity(){
       $this->load->model('report_model');
        $data2['COMMODITY']=$this->report_model->show_malaria_commodities();
        $data2['FUNDING']=$this->report_model->show_funding_orgs();
        $data2['PSTOCKS']=$this->report_model->show_shipments();
        $data2['SORTED']=$this->report_model->pending_shipments();

        $this->load->view('individual_commodities', $data2);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */