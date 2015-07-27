<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller
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

        $this->load->model("report_model");
        $period=$this->input->post("date");
        $county_period=$this->input->post("county_date");
        $county_id=$this->input->post("county_id");

        if(empty($period))
        {
            $period=$this->report_model->get_most_recent_county_period();
        }
if(empty($county_period))
        {
            $county_period="000000";
        }
        if(empty($county_id))
        {
            $county_id="ahwTMNAJvrL";
        }
        //$commodities=array();
        $reports=array();
        //$period="201409";
        $commodities=$this->report_model->get_all_commodities();
        $counties=$this->report_model->get_county_names();
        $final=array();
        $coun=array();
        foreach($commodities as $commodity)
        {
            unset($reports);
            unset($coun);
            foreach($counties as $county)
            {
                unset($temp);
                $temp=array(
                    "county_name"=>$county->county_name,
                    "county_id"=>$county->county_id,
                    "mos"=>$this->report_model->get_mos_of_commodity_in_county($county->county_id,$period,$commodity->drug_id)
                );
                $coun[]=$temp;

            }

            $reports=array(
                "commodity_name"=>$commodity->drug_name,
                "commodity_id"=>$commodity->drug_id,
                "period"=>$period,
                "counties"=>$coun

            );

            $final[]=$reports;
        }

        $data['names']=$this->report_model->get_county_names();
        if($county_period!="000000")
        {
            $data['period']=$this->report_model->get_county_mos($county_period,$county_id);
            $data['p1']=$county_period;
            $data['c']=$county_id;

            /*print_r($county_report);
            die("ddddddddddddddddddddddd");*/
        }

        $data['dates']=$this->report_model->get_county_periods();
        $data["items"]=$final;
        $data['bil']=$period;


        $national_period_post=$this->input->post("national_date");
        if(empty($national_period_post))
        {
            $national_period_post="000000";
        }
        $this->load->model("report_model");
        $data['national_dates']=$this->report_model->get_central_level_periods();
        if($national_period_post!="000000") {
            $data['national_period'] = $this->report_model->get_national_level_mos($national_period_post);
            $data['national_p'] = $national_period_post;
        }
        //print_r($data);
        //die("mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm");
		$this->load->view('welcome_message',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */