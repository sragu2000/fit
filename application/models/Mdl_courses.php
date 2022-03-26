<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_courses extends CI_Model {
    public function listcourses(){
        $flag=$this->db->query("SELECT * FROM fitmodules")->result();
        // $flag= $this->db->query("SELECT * FROM fitmodules");
        return json_encode($flag,true);

    }
    public function mdlshowArticle($modid){
        $flag=$this->db->query("SELECT authorid as user,adate as date,articleheading as heading,articletext as lesson FROM fitarticles WHERE moduleid='$modid'")->result();
        return json_encode($flag,true);
    }
    public function addArticles(){
        $moduleid=$this->input->post('module');
        $authorid=$this->session->userdata('useroffit');
        $adate=date("Y/m/d");
        $atime=date("h:i:sa");
        $articleheading=$this->input->post('heading');
        $articletext=$this->input->post('articletext');
        if($this->db->query("INSERT INTO fitarticles(moduleid,authorid,adate,atime,articleheading,articletext) VALUES('$moduleid','$authorid','$adate','$atime','$articleheading','$articletext')")){
            return array("message"=>"Success","result"=>true);
        }else{
            return array("message"=>"Failed","result"=>false);
        }
    }
}
