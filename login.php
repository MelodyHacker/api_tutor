<?php
// error_reporting(-1);
// ini_set('display_errors', 'On');
require 'connect.php';
mysqli_set_charset($databaseconnect,"utf8");
$username=$_POST['username'];
$password=$_POST['password'];
$token = $_POST['token'];
$status="";
$sqlall ="SELECT * FROM user";    
$queryall= mysqli_query($databaseconnect,$sqlall);
if (!$queryall) {
	printf("Error: %s\n", $databaseconnect->error);
exit();
}

if($token==""){
  while($result =mysqli_fetch_array($queryall,MYSQLI_ASSOC))
{
  if($username==$result['username_user'] and $password==$result['password_user']){
    $status="susscc----".$result['status_user']."_".$result['id_user'];
    $status=base64_encode($status);
    echo $status;
    exit();
  }
}

}else{
$ar = explode("----",base64_decode($token));
$ar2 = explode("_",$ar[1]);

while($result =mysqli_fetch_array($queryall,MYSQLI_ASSOC))
  {
    if($ar2[1]==$result['id_user'] and $ar2[0]==$result['status_user']){
      $status="susscc----".$result['status_user']."_".$result['id_user'];
      $status=base64_encode($status);
      echo $status;
exit();    
}
  }}

echo $status;
mysqli_close($databaseconnect);
?>