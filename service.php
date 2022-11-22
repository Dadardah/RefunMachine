<?php
$filepath = realpath(dirname(__FILE__));
//include_once $filepath.".\lib\Session.php";
include_once $filepath."/lib/Session.php";
Session::init();
spl_autoload_register(function($classes){
  include 'classes/'.$classes.".php";
});
$users = new Users();
?>
<?php
$trigger = "";
if (isset($_GET['trigger']))
{
  $trigger = $_GET['trigger'];
}
$service_name = "";
if (isset($_POST['service_name']))
{
  $service_name = $_POST['service_name'];
};
if ($service_name == "get_bottle")
{
    $barcode = $_POST['barcode'];
    
    $list = $users->get_bottle($barcode);
    //echo json_encode($list);
    echo json_encode($list);
}
else if ($service_name == "insert_bottle_tran")
{
    
    $barcode = $_POST['barcode'];
    $date = $_POST['date'];
    $list = $users->insert_bottle_tran($barcode);

    
    echo json_encode($list);
}
else if ($service_name == "get_bottle_tran")
{
    
    $barcode = $_POST['barcode'];
    $date = $_POST['date'];

 

    $list = $users->get_bottle_tran($barcode,$date);

    
    echo json_encode($list);
}
else if ($service_name == "get_donate")
{
    $date = $_POST['date'];
    $list = $users->get_donate($date);

    
    echo json_encode($list);
}
else if ($service_name == "get_history")
{
  $query = '';
  $saida = array();
  $userid = Session::get("id");
  $query .= " SELECT * FROM tbl_bottle_tran LEFT JOIN tbl_bottle on tbl_bottle_tran.barcode = tbl_bottle.barcode where user_id = '"  . $userid . "' ";
  $list = $users->get_history($query);

  $dados = array();
  
  foreach($list as $row)
  {
      $sub_array = array();
      $sub_array[] = $row["datetime"];
      $sub_array[] = $row["name"] . ", " . $row["brand"] . ", " . $row["volume"];
      $sub_array[] = $row["quantity"];
      $dados[] = $sub_array;	
  }


$saida = array(
   "draw"				=>	intval($_POST["draw"]),
  "recordsTotal"		=> 	10,
  "recordsFiltered"	=>	9999,
  "data"				=>	$dados
);
  
  //echo json_encode($list);
  echo json_encode($saida);
}else if ($trigger == "machine_insert_bottle_tran")
{
  $users->set_bottle_tran("INSERT INTO `tbl_bottle_tran` (`user_id`, `barcode`, `datetime`, `quantity`) 
  VALUES ((SELECT id FROM tbl_users ORDER BY last_login desc LIMIT 1)
      ,(SELECT tran.barcode FROM tbl_bottle_tran as tran ORDER BY tran.datetime desc LIMIT 1)
      , current_timestamp()
      , '1' );");
  $result = array("save successfully");
  echo json_encode($result);
}else if ($trigger == "machine_insert_donate")
{
  $users->set_bottle_tran("INSERT INTO `tbl_donate` (`running`, `bottles`, `date`, `timestamp`) VALUES (NULL, '1', 'current_timestamp()', current_timestamp());");
  $result = array("save successfully");
  echo json_encode($result);
}
else if ($trigger == "machine_refun")
{
  $list = $users->query("SELECT user_id, page_name, `timestamp` FROM tbl_page_active limit 1");
  $user_id = "";
  $page_name = "";
  foreach($list as $row)
  {
      $user_id = $row["user_id"];
      $page_name = $row["page_name"];
  }
  if ($page_name == "scan"){
    $users->set_bottle_tran("INSERT INTO `tbl_bottle_tran` (`user_id`, `barcode`, `datetime`, `quantity`) 
    VALUES ('" . $user_id . "'
        ,(SELECT tran.barcode FROM tbl_bottle_tran as tran ORDER BY tran.datetime desc LIMIT 1)
        , current_timestamp()
        , '1' );");
  }else{
    $users->set_bottle_tran("INSERT INTO `tbl_donate` (`running`, `bottles`, `date`, `timestamp`) VALUES (NULL, '1', current_timestamp(), current_timestamp());");
  }
  
  $result = array("save successfully");
  echo json_encode($result);
}
else if ($service_name == "getdatetime")
{
  $list = $users->getdatetime();
  echo json_encode($list);
}
?>