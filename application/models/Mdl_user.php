<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_user extends CI_Model {
    public function addUser(){
        $arr["fitusername"]=$this->input->post('username');
        $arr["firuserrole"]="fitpageuser";
		$arr["fituserindexnum"]=$this->input->post('indnum');
		$arr["fitusercourse"]=$this->input->post('course');
		$arr["fituseremail"]=$this->input->post('email');
        $email=$this->input->post('email');
        $indexnum=$this->input->post('indnum');
		$arr["fituserpassword"]=md5($this->input->post('password'));
        if($this->db->query("SELECT * FROM usersfit WHERE fituseremail='$email'")->num_rows()>0){
            return array("message"=>"Email or Index Number Already Exists","result"=>false);
        }else{
            if($this->db->insert('usersfit',$arr)){
                return array("message"=>"SignUp Success","result"=>true);
            }else{
                return array("message"=>"SignUp Failed","result"=>false);
            }
        }
    }
    public function checkuser(){
        $indNum=$this->input->post('indnum');
		$password=md5($this->input->post('password'));
        if($this->db->query("SELECT * FROM usersfit WHERE fituserindexnum='$indNum' and fituserpassword='$password'")->num_rows()==1){
            return array("message"=>"Login Success","result"=>true);
        }else{
            return array("message"=>"Login Failed","result"=>false);
        }
    }

    public function sessionCheck(){
        $session_data = $this->session->get_userdata();
        if (is_null($session_data)) {
          return false;
        }
        else if (empty($session_data['useroffit'])) {
          return false;
        }
        else if ($session_data['useroffit']=="") {
          return false;
        }
        else{
          $ses=$session_data['useroffit'];
          return true;
        }
    }
}
