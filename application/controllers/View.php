<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		//$this->load->model('Mdl_courses');
		if(! $this->Mdl_user->sessionCheck()){
			$pageUrl=current_url();
            $this->session->set_userdata('myurl',$pageUrl);
			redirect("authenticate/login");
		}
	}

	//function call from vw_dashboard
	//ex: http://localhost/fit/view/module/module_IN1400
	//last part is a parameter to function module
	public function module($courseId=NULL){
        //$courseId=str_replace('module_', '', $courseId);
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $data["courseId"]=$courseId;
        $this->load->view("courses/vw_module",$data);
    }

	public function myarticles(){
		$this->load->view("vw_header");
        $this->load->view("vw_navbar");
		$this->load->view("vw_myarticles");
	}

}
