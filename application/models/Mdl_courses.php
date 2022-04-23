<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_courses extends CI_Model {
    public function listcourses(){
        $flag=$this->db->query("SELECT * FROM fitmodules")->result();
        // $flag= $this->db->query("SELECT * FROM fitmodules");
        return json_encode($flag,true);

    }
    public function mdlshowArticle($modid){
        $flag=$this->db->query("SELECT authorid as userid, usersfit.fitusername as username, articleid as aid, adate as date,articleheading as heading,articletext as lesson FROM fitarticles,usersfit WHERE moduleid='$modid' and usersfit.fituserindexnum=fitarticles.authorid ORDER BY articleid DESC")->result();
        return json_encode($flag,true);
    }
    public function addArticles(){
        $arr['moduleid']=$this->input->post('module');
        $moduleid=$this->input->post('module');

        $arr['authorid']=$this->session->userdata('useroffit'); //no need to validate
        $arr['adate']=date("Y/m/d");//no need to validate
        $arr['atime']=date("h:i:sa");//no need to validate

        $arr['articleheading']=trim($this->input->post('heading'));
        $arr['articletext']=$this->input->post('articletext');
        if($this->db->query("SELECT * FROM fitmodules WHERE moduleid='$moduleid'")->num_rows()==1){
            //empty() will return true if variable is empty
            if(empty($arr['moduleid'])||empty($arr['articletext'])||empty($arr['articleheading'])){
                return array("message"=>"Empty Input","result"=>false);
            }else{
                if($this->db->insert("fitarticles",$arr)){
                    return array("message"=>"Success","result"=>true);
                }else{
                    return array("message"=>"Failed","result"=>false);
                }
            }
        }else{
            return array("message"=>"Invalid Module ID","result"=>false);
        }
        
        
    }
}
