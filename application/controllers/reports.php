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
        if(isset($period_post))
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
        if(isset($period_post))
        {
            $period=$period_post;
        }

        $this->load->model("report_model");

        $central_report['dates']=$this->report_model->get_central_level_periods();

        $central_report['period']=$this->report_model->get_central_level_mos($period);

        $central_report['p']=$period;
        $this->load->view('central_mos',$central_report);
    }

    public function national_mos($period="000000")
    { 

        $period_post=$this->input->post("date");
        if(isset($period_post))
        {
            $period=$period_post;
        }
        $this->load->model("report_model");
        $national_report['dates']=$this->report_model->get_central_level_periods();

        $national_report['period']=$this->report_model->get_national_level_mos($period);
        $national_report['p']=$period;
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
        $this->load->model("report_model");
        $county_report['dates']=$this->report_model->get_county_periods();
        $county_report['names']=$this->report_model->get_county_names();

        $county_report['period']=$this->report_model->get_county_mos($period,$county_id);
        $county_report['p']=$period;
        $county_report['c']=$county_id;
        $this->load->view('county_mos',$county_report);

        //print_r($county_report);
    }

    public function stocks()
    {
        $this->load->view('stocks_report');
    }
    public function commodities()
    {
        $this->load->view('commodities_report');
    }

    public function agencies()
    {
        $this->load->view('agencies_report');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */