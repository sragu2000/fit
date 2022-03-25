<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_courses extends CI_Model {
    public function listcourses(){
        $flag=$this->db->query("SELECT * FROM fitmodules")->result();
        // $flag= $this->db->query("SELECT * FROM fitmodules");
        return json_encode($flag,true);

    }
}
