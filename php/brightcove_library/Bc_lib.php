<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bc_lib {
  //set the read token
  private $readToken='';
  //set the video fields to bring from brightcove
  private $videoFields="id,videoStillURL,playsTotal,thumbnailURL";
  private $CI="";

  public function __construct(){
    $this->CI=& get_instance();
    //load the brightcove model
    $this->CI->load->model("bc_model","bcMod");
    //load the brightcove library and set it the object name
    $this->CI->load->library("BCMAPI","","BCMAPI");
  }
  //get data for one video from brightcove server
  function get_bc_data_by_videoid($videoId){
    //get a brightcove instance
    $bc=new $this->CI->BCMAPI($this->readToken,'');
    //get the video information
    $data=$bc->find("videobyid",array("video_id"=>$videoId,"video_fields"=>$this->videoFields));
    return $data;
  }
  //get data for many videos from brigthcove server
  function update_url_videos(){
    $stringIds="";
    //Instatiate the bc api and set it read token
    $bc=new $this->CI->BCMAPI($this->readToken,'');
    //get brightcove ids from local db
    $videoIds=$this->CI->bcMod->get_local_videos();

    if(count($videoIds)>0){
      //concatenate each video founded into a string
      foreach ($videoIds as $video) {
        $stringIds.=$video->brightcove_id.",";
      }
      //Remove last comma from string of ids
      $stringIds=substr($stringIds,0,strlen($stringIds)-1);
      //get fresh data from bc server
      $videos=$bc->find("videosbyids",array("video_ids"=>$stringIds,"video_fields"=>$this->videoFields));
      //check if there are available videos
      if(count($videos)>0){
        //update the local db information
        foreach ($videos as $video) {
          $this->CI->bcMod->update_video_bc($video->id,array("brightcove_id"=>$video->id,
                                                             "video_stillUrl"=>$video->videoStillURL,
                                                             "video_thumbnailURL"=>$video->thumbnailURL,
                                                             "video_playsTotal"=>$video->playsTotal)
                                                            );
        }
        return "videos were updated!";
      }
      else{
        return "Couldn't get videos from brightcove!";
      }
    }
    else{
      "Couldn't find videos on local db!";
    }
  }
}
?>