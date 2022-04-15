<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		if($this->Mdl_user->sessionCheck()){
			redirect("dashboard");
		}
	}

	public function getName($n) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		return $randomString;
	}

	public function resetrequest($resetText){
		$user=$this->Mdl_user->chkUserOfResetText($resetText);
		//return array("email"=>$query->first_row()->fituseremail,"result"=>true);
		if($user["result"]==true){
			$userEmail=$user["email"];
			$this->session->set_userdata("useremailoffit",$userEmail);
			$this->load->view("vw_header");
			$this->load->view('vw_resetreq');
		}else{
			echo "error !";
		}
	}

	public function submitPass(){
		$newpass = $this->input->post('newpassword');
		if($this->Mdl_user->requestToChangePasswordByUserLink($newpass)){
			$this->sendJson(array("message" =>"Password Reset Success","result"=>true));
			$this->session->unset_userdata("useremailoffit");
		}else{
			$this->sendJson(array("message" =>"Password Reset Failed","result"=>false));
		}
	}

	public function resetpass(){
		$email=$this->input->post('email');
		if($this->Mdl_user->is_a_person_user($email)){
			$config = array();
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_user'] = 'fit.epizy@gmail.com';
			$config['smtp_pass'] = 'fitepizy2000';
			$config['smtp_port'] = 465;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('fit.epizy@gmail.com', 'FIT ADMIN');
			$this->email->to($email);
			$this->email->subject('Password Reset');
			$resetLink=md5($email).md5($this->getName(20));
			$fullUrl=base_url('authenticate/resetrequest/').$resetLink;
			if($this->Mdl_user->resetPass($resetLink,$email)){
				$this->email->message("Change your password here: $fullUrl");
				if($this->email->send()){
					$this->sendJson(array("message" =>"Password reset mail has been sent successfully","result"=>true));
				}else{
					$this->sendJson(array("message" =>"0x453 Error Try again later","result"=>false));
				}
			}else{
				$this->sendJson(array("message" =>"0x454 Error Try again later","result"=>false));
			}
		}else{
			$this->sendJson(array("message" =>"Email not found","result"=>false));
		}
	}
	public function forgotpassword(){
		$this->load->view("vw_header");
		$this->load->view("vw_forgotpassword");
	}
	public function login()
	{
		$this->load->view('vw_login');
	}
	public function index()
	{
		$this->load->view('vw_login');
	}

    public function signup()
	{
		$this->load->view('vw_signup');
	}
	public function usersignin(){
		$flag=$this->Mdl_user->checkuser();
		if($flag["result"]){
			$this->session->set_userdata("useroffit",$this->input->post('indnum'));
		}
		$this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"],"url"=>$this->session->userdata('myurl')));
		$this->session->unset_userdata("myurl");
	}
	public function signupuser(){
		$flag=$this->Mdl_user->addUser();
		$this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
	}
	private function sendJson($data) {
	  $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
