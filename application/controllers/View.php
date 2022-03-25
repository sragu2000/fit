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
			redirect("authenticate/login");
		}
	}
	public function module($courseId){
        $courseId=str_replace('module_', '', $courseId);
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $data["courseId"]=$courseId;
        $this->load->view("courses/vw_module",$data);
    }
}
