<?php
class Report_controller extends CI_Controller{

function __construct(){
	parent::__construct();
	//$this->load->model('agenciesmodel');
}


function DisplayPendingShipments(){
	$pendingtotals['pendingConsignments']=$this->agenciesmodel->getPendingStockTotals();
	$pendingtotals['COMMODITY']=$this->agenciesmodel->show_commodities();



			$this->load->view('REPORTpending_commodities_View', $pendingtotals);
		}

		
public function pendingstocksReports() {
	$psid = $this->uri->segment(3);//get id from the url
	$data2['PSTOCKS'] = $this->agenciesmodel->showPendingStock();
	$data2['single_PSTOCKS'] = $this->agenciesmodel->showPendingStock_id($psid);
	$data2['COMMODITY']=$this->agenciesmodel->show_commodities();
	$data2['FUNDING']=$this->agenciesmodel->show_fundingorgs();

	$this->load->view('REPORTpendingshipments',$data2);
}

public function commoditiesPerAgency()
  {
	#$commodityperagency['perAgency']=$this->agenciesmodel->commodityAgency();
	$commodityperagency['COMMODITY']=$this->agenciesmodel->show_commodities();
	$commodityperagency['FUNDING']=$this->agenciesmodel->show_fundingorgs();
	$commodityperagency['PSTOCKS'] = $this->agenciesmodel->showPendingStock();
	
	$this->load->view('REPORTcommodities_per_View',$commodityperagency);
		

}


public function Current_pending(){
	$commoditycomparison['COMMODITY']=$this->agenciesmodel->show_commodities();
	$commoditycomparison['FUNDING']=$this->agenciesmodel->show_fundingorgs();
	$commoditycomparison['PSTOCKS'] = $this->agenciesmodel->showPendingStock();
	$commoditycomparison['CENTRAL'] = $this->agenciesmodel->showCentralStock();

	$this->load->view('REPORTcentralvspending', $commoditycomparison);
}

 public function centralLevelDhisStocksReports($period="000000"){

        $period_post=$this->input->post("date");
        if(isset($period_post))
        {
            $period=$period_post;
        }
        $centralReport['dates']=$this->agenciesmodel->get_central_dhis_periods();

        $centralReport['period']=$this->agenciesmodel->getCentralDhisAAC($period);



        $centralReport['p']=$period;
        $this->load->view('centralDhisReport',$centralReport);


    }

    public function getCentralReport($period="000000"){

        $period_post=$this->input->post("date");
        if(isset($period_post))
        {
            $period=$period_post;
        }
        $centralReport['dates']=$this->agenciesmodel->get_central_static_periods();

        $centralReport['period']=$this->agenciesmodel->getCentralAAC($period);



        $centralReport['p']=$period;
        $this->load->view('centralReport',$centralReport);


    }


    public function countyLevelDhisStocksReports($period="000000",$county_id="ahwTMNAJvrL"){

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

        $centralReport['dates']=$this->agenciesmodel->get_county_dhis_periods();
        $centralReport['names']=$this->agenciesmodel->get_county_dhis_names();





        $centralReport['period']=$this->agenciesmodel->getCountyDhisAAC($period,$county_id);
        $centralReport['p']=$period;
        $centralReport['c']=$county_id;
        $this->load->view('countyDhisReport',$centralReport);

        //print_r($centralReport);

    }




    public function dashboard()
    {
        $period=$this->agenciesmodel->get_most_recent_county_period();
        //$commodities=array();
        $reports=array();
        //$period="201409";
        $commodities=$this->agenciesmodel->get_all_commodities();
        $counties=$this->agenciesmodel->get_county_dhis_names();
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
                    "mos"=>$this->agenciesmodel->get_mos_of_commodity_in_county($county->county_id,$period,$commodity->drug_id)
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


        $data["items"]=$final;
        $this->load->view('dashboard',$data);

    }




    public function select_period(){

        $centralReport['period'] =  "";
        $centralReport['period_dates'] = $this->agenciesmodel->show_static_param_periods();
        $this->load->view('centralreport',$centralReport);

    }

    public function get_mos_of_commodity_in_county($county_id,$period,$commodity_id)
    {

    }



}

?>