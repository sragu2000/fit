<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_admin extends CI_Model {

    public function listuserprofiles(){
        $flag=$this->db->query("SELECT fitusername as usrname, fituserindexnum as indexnum FROM usersfit")->result();
        return json_encode($flag,true);
    }

    public function promoteme(){
        $user=$this->input->post('user');
        $mode=$this->input->post("mode");

        $userIndexNum=explode(":",$user)[1];
        if($mode=="Promote"){
            if($this->db->query("UPDATE usersfit SET firuserrole='fitpageadmin' WHERE fituserindexnum='$userIndexNum'")){
                return array("message"=>"User Promoted Successfully","result"=>true);
            }else{
                return array("message"=>"Try again Later", "result"=>false);
            }
        }else if($mode=="Demote"){
            if($this->db->query("UPDATE usersfit SET firuserrole='fitpageuser' WHERE fituserindexnum='$userIndexNum'")){
                return array("message"=>"User Demoted Successfully","result"=>true);
            }else{
                return array("message"=>"Try again Later", "result"=>false);
            }
        }else{
            return array("message"=>"Error Try again Later", "result"=>false);
        }
        
    }
    public function deleteThisModule($moduleId){
        if($this->db->query("delete from fitmodules where moduleid='$moduleId'")){ 
            return true;
        }else{
            return false;
        }
    }
    public function editThisModule($oldmoduleid, $modulename, $moduleid, $forcourse){
        if($this->db->query("update fitmodules set modulename='$modulename', moduleid='$moduleid', forcourse='$forcourse' where moduleid='$oldmoduleid'")){
            return true;
        }else{
            return false;
        }
    }

}
