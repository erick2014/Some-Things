<?php
class Bc_model extends CI_Model {

  function __construct() {
        parent::__construct();
  }

  function get_local_videos(){
    $this->db->select("brightcove_id");
    $this->db->from("videos");
    $query=$this->db->get();
    return $query->result();
  }

  function update_video_bc($bc_id,$video){
    $this->db->where('brightcove_id',$bc_id);
    $this->db->update("videos",$video);
  }


}