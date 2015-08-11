<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mos_color_codes extends MY_Controller
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
        $this->load->model('mos_color_codes_model');
        $data['colors']=$this->mos_color_codes_model->get_all();
		$this->load->view('mos_color_codes',$data);
	}

    public function edit_color()
    {
        $color_id=$this->input->post("color_id");
        $color=$this->input->post("color");
        $this->load->model('mos_color_codes_model');
        $this->mos_color_codes_model->edit_color($color_id,$color);
        redirect(base_url()."mos_color_codes");

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */