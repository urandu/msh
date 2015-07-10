<?php
class Forecast_controller extends CI_Controller{

function __construct(){
	parent::__construct();
	//$this->load->model('agenciesmodel');
}

public function showStaticParams() {
		$fid = $this->uri->segment(3);//get id from the url
		$data3['staticParams'] = $this->agenciesmodel->showStaticParams();
		$data3['single_staticparam'] = $this->agenciesmodel->show_staticparams_id($fid);

		$data3['COMMODITY']=$this->agenciesmodel->show_commodities();




		$this->load->view('showstaticparams',$data3);
}


function updateStaticParamsid() {
	$id= $this->input->post('staticparams_id');

	$commodity_name= $this->input->post('commodity_name');
	$commodity_id=$this->agenciesmodel->get_commodity_id_with_the_given_name($commodity_name);

	$data = array(
	'period' => $this->input->post('period'),
	'commodity_id'=>$commodity_id,
	'projected_monthly_consumption' => $this->input->post('projected_monthly_consumption'),
	'average_monthly_consumption'=>$this->input->post('average_monthly_consumption'),
	'reporting_rate'=>$this->input->post('reporting_rate')

	);




	$this->agenciesmodel->update_static_id1($id,$data);
	$this->showStaticParams();
	     
}

public function deleteStaticParam(){
	 	$id= $this->input->post('staticparams_id');     
		     $this->db->where('staticparameterid', $id);
		     $deleterecord=$this->db->delete('static_parameters');
		     		$data['status'] =  "";
				if($deleterecord){
					$data['status'] =  "Parameter deleted Successfully!..";
				}
			$this->showStaticParams();
}




}

?>