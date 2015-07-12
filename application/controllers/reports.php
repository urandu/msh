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