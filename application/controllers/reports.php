<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller
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
    public function index()
    {
        //$this->load->view('county');
    }

    public function facility_mos($period="000000")
    {

        $period_post=$this->input->post("date");
        if(isset($period_post))
        {
            $period=$period_post;
        }


        $this->load->model("report_model");

        $facility_report['dates']=$this->report_model->get_facility_level_periods();

        $facility_report['period']=$this->report_model->get_facility_level_mos($period);


        $facility_report['p']=$period;
        $this->load->view('facility_mos',$facility_report);
    }
    public function forecast_mos($period="000000")
    {

        $period_post=$this->input->post("date");

        if(!empty($period_post))

        {
            $period=$period_post;
        }
        $this->load->model("report_model");
        $forecast_report['dates']=$this->report_model->get_forecast_commodity_data_periods();

        $forecast_report['period']=$this->report_model->get_forecast_commodity_data_mos($period);
        $forecast_report['p']=$period;
        $this->load->view('forecast_mos',$forecast_report);
    }
    public function central_mos($period="000000")
    {
        $period_post=$this->input->post("date");

        if(!empty($period_post))

        {
            $period=$period_post;
        }

        $this->load->model("report_model");

//$central_report=array();
        $central_report['dates']=$this->report_model->get_central_level_periods();
        if($period!="000000")
        {


            $central_report['period']=$this->report_model->get_central_level_mos($period);
            $central_report['p']=$period;
        }




        $this->load->view('central_mos',$central_report);
    }

    public function national_mos($period="000000")
    {

        $no_reporting_rate=$this->input->post("no_reporting_rate");
        $period_post=$this->input->post("date");
        if(!empty($period_post))
        {
            $period=$period_post;
        }
        $this->load->model("report_model");
        $national_report['dates']=$this->report_model->get_central_level_periods();
if($period!="000000")
{
    if(empty($no_reporting_rate))
    {
        $national_report['period']=$this->report_model->get_national_level_mos($period);
    }
    else
    {
        $national_report['period']=$this->report_model->get_national_level_mos_no_reporting_rate($period);
        $national_report['reporting_rate']="no reporting rate";
    }

    $national_report['p']=$period;
}

        $this->load->view('national_mos',$national_report);
    }

    public function county_mos($period="000000",$county_id="ahwTMNAJvrL")
    {

        $period_post=$this->input->post("date");
        $county_post=$this->input->post("county");

        if(!empty($period_post))
        {
            $period=$period_post;
        }

        if(!empty($county_post))
        {
            $county_id=$county_post;
        }
        //echo($period);
        //echo($county_id);
        $this->load->model("report_model");
        $county_report['dates']=$this->report_model->get_county_periods();
        $county_report['names']=$this->report_model->get_county_names();
if($period!="000000")
{
    $county_report['period']=$this->report_model->get_county_mos($period,$county_id);
    $county_report['p']=$period;
    $county_report['c']=$county_id;

    /*print_r($county_report);
    die("ddddddddddddddddddddddd");*/
}

        $this->load->view('county_mos',$county_report);

        //print_r($county_report);
    }
     public function variance_tracker($period="000000")
     {
        $period_post=$this->input->post("date");
        if(!empty($period_post))
        {
            $period=$period_post;
        }
        $this->load->model("report_model");
        $variance['dates']=$this->report_model->forecast_variance_periods();
if($period!="000000")
{
    $variance['period']=$this->report_model->forecast_variance_tracker($period);
    $variance['p']=$period;
}

        $this->load->view('variance_tracker',$variance);
       

        
     }

    public function stocks($period=000000)
    {

         $period_post=$this->input->post('period');

        if(isset($period_post))
        {
            $period=$period_post;

            $this->load->model('report_model');
        $commoditycomparison['COMMODITY']=$this->report_model->show_malaria_commodities();
        $commoditycomparison['FUNDING']=$this->report_model->show_funding_orgs();

        $commoditycomparison['PSTOCKS']=$this->report_model->show_shipments_by_period($period);
        $commoditycomparison['SORTED']=$this->report_model->show_pending_shipments_per_period($period);
        $commoditycomparison['CENTRAL']=$this->report_model->show_central_stock_by_period($period);
        $commoditycomparison['select_period']=$this->report_model->show_sorted_pending_stock();
        $commoditycomparison['period']=$period;


        $this->load->view('stocks_report', $commoditycomparison);
        }
        
    }
    public function commodities($period=000000)
    {
        $period_post=$this->input->post('period');

        if(isset($period_post))
        {
            $period=$period_post;
        }
         $this->load->model('report_model');
        $data['COMMODITY'] = $this->report_model->show_malaria_commodities();
        $data['pendingConsignments']=$this->report_model->show_pending_shipments_per_period($period);
        $data['select_period']=$this->report_model->show_sorted_pending_stock();
        $data['period']=$period;
        $this->load->view('commodities_report', $data);
        
    }

    public function agencies($period="000000")
    {
        $period_post=$this->input->post('period');

        if(isset($period_post))
        {
            $period=$period_post;
        }
        $this->load->model('report_model');
        $commodityperagency['PSTOCKS']=$this->report_model->show_shipments_by_period($period);
        $commodityperagency['COMMODITY']=$this->report_model->show_malaria_commodities();
        $commodityperagency['FUNDING']=$this->report_model->show_funding_orgs();
        $commodityperagency['period']=$this->report_model->show_sorted_pending_stock();
        $commodityperagency['selected_period']=$period;


        

         $this->load->view('agencies_report', $commodityperagency);
    }
    public function individual_commodity($period=000000){
        $period_post=$this->input->post('period');

        if(isset($period_post))
        {
            $period=$period_post;
        }


       $this->load->model('report_model');
        $data2['COMMODITY']=$this->report_model->show_malaria_commodities();
        $data2['FUNDING']=$this->report_model->show_funding_orgs();
        $data2['select_period']=$this->report_model->show_sorted_pending_stock();
        $data2['PSTOCKS']=$this->report_model->show_shipments_by_period($period);
        $data2['period']=$period;


        $this->load->view('individual_commodities', $data2);


        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */