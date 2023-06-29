<?php 
class db{
private $pwd="";
private $user="root";
private $con;

public function getconnection(){
	try{

$this->con=new PDO('mysql:host=localhost;dbname=myweb_db',$this->user,$this->pwd);
return $this->con;
}
catch(PDOException $x){
	echo"db connection fail".$x.getMessage();

}}}
$obj=new db();
$obj->getconnection();


?>