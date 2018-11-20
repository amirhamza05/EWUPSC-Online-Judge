<?php


class site_content {
   

//starting connection

 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;

 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection
  public function get_url(){
    $url=$_SERVER['REQUEST_URI'];
    return $url;
  }

  public function get_page_name(){
  	$url=$this->get_url();
  	$url=explode('/', $url);
  	$len=count($url);
  	$page_name=$url[$len-1];
  	if($page_name=="")$page_name="index.php";
  	return  $page_name;
  }
 


}


?>

