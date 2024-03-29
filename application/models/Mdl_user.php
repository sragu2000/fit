<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_user extends CI_Model {
    public function viewAnotherProfile($userid){
        $v1=$this->db->query("select fitusername as name, fitusercourse as course from usersfit where fituserindexnum='$userid'")->result();
        $data["userdetails"]=$v1;
        $v2=$this->db->query("select articleid as aid, articleheading as heading, moduleid as module from fitarticles where authorid='$userid'")->result();
        $data["articles"]=$v2;
        return json_encode($data,true);
    }
    public function getUserName($userid){
        $sqlquery=$this->db->query("select * from usersfit where fituserindexnum='$userid'");
        if($sqlquery->num_rows()>0){
            return $sqlquery->first_row()->fitusername;
        }else{
            return "User Not Found";
        }
    }
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
    public function resetPass($resetText,$email){
        if($this->db->query("UPDATE usersfit SET resetText='$resetText' WHERE fituseremail='$email'")){
            return true;
        }else{
            return false;
        }
    }
    public function requestToChangePasswordByUserLink($newpass){
        $newpass=md5($newpass);
        $email=$_SESSION['useremailoffit'];
        if($this->db->query("UPDATE usersfit SET fituserpassword='$newpass' WHERE fituseremail='$email'")){
            $this->db->query("UPDATE usersfit SET resetText='' WHERE fituseremail='$email'");
            return true;
        }else{
            return false;
        }
    }
    public function chkUserOfResetText($resetText){
        $query=$this->db->query("SELECT * FROM usersfit WHERE resetText='$resetText'");
        if($query->num_rows()==1){
            return array("email"=>$query->first_row()->fituseremail,"result"=>true);
        }else{
            return array("email"=>"","result"=>false);
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

    public function getprofile(){
        $indnum=$this->session->userdata('useroffit');
        $val=$this->db->query("select fitusername as name, fituseremail as email, fituserindexnum as indnum, fitusercourse as course from usersfit where fituserindexnum='$indnum'")->result();
        return json_encode($val,true);
    }

    public function deleteusermdl(){
        $ind=$this->session->userdata('useroffit');
        $this->db->query("delete from usersfit where fituserindexnum='$ind'");
        return true;
    }

    public function getUserRole(){
        $ind=$this->session->userdata('useroffit');
        $val=$this->db->query("select * from usersfit where fituserindexnum='$ind'")->first_row()->firuserrole;
        return $val;
    }

    public function is_a_person_user($email){
        if($this->db->query("select * from usersfit where fituseremail='$email'")->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function changeMyPassword($oldPassword,$newPassword){
        $newPassword=md5($newPassword);
        $user=$this->session->userdata('useroffit');
        $oldpassFromDb=$this->db->query("select * from usersfit where fituserindexnum='$user'")->first_row()->fituserpassword;
        if($oldpassFromDb==md5($oldPassword)){
            if($this->db->query("UPDATE usersfit SET fituserpassword='$newPassword' where fituserindexnum='$user'")){
                return array("message"=>"Password Changed Successfully","result"=>true);
            }else{
                return array("message"=>"Can't Change the Password.. Try again Later","result"=>true);
            }
            
        }else{
            return array("message"=>"Enter Correct Password","result"=>false);
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
