<?php 

class sql extends PDO{
	PRIVATE $conn;

	public function __construct(){
		$this ->conn = new PDO ("mysql:host=localhost;dbname=dbphp7","root","");
	}

	
	private function setParams($statment,$parameters =array()){
	foreach ($parameters as $key => $value) {

		$statment->setParam($key,$value);}

	}



	private function setParam($statment,$key,$value){
		$statment ->bindParam($key,$value);
	}

	

	public function query($rawQuery,$params=array()){

	$stmt = $this ->conn->prepare($rawQuery);

	$this ->setParams($stms,$params);
	$stmt ->execute();
	return $stmt->execute();}

	
	public function select($rawQuery,$params=array()):array{

	$stmt = $this->query($rawQuery,$params);
	return $stmt->ftell(PDO::FETCH_ASSOC);
	}











}



?>