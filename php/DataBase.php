<?php
	class DataBase{
		private $conn;
		private $dbName;
		private $host;
		private $user;
		private $pwd;
		private $result;

		public function __construct($host,$user,$pwd,$db){
			$this->host=$host;
			$this->user=$user;
			$this->pwd=$pwd;
			$this->dbName=$db;
		}
		public function __destruct(){
			$this->DisconnectDatabase();
		}

		public function ConnectDatabase(){
			$this->conn=mysqli_connect($this->host,$this->user,$this->pwd,$this->dbName);
		}
		public function CreateTable($table,$values){
			$sql=sprintf("CREATE TABLE %s (%s)",$table,$values);
			$this->ExecQuery($sql);
		}
		public function DeleteTable($table){
			$sql=sprintf("DROP TABLE %s",$table);
			$this->ExecQuery($sql);
		}
		public function InsertData($table,$values){
			$sql=sprintf("INSERT INTO %s VALUES (%s)",$table,$values);
			$this->ExecQuery($sql);
		}
		public function DeleteData($table,$filter){
			if($filter!=null){
				$sql=sprintf("DELETE FROM %s WHERE %s",$table,$filter);
			}
			else{
				$sql=sprintf("DELETE FROM %s",$table);	
			}
			$this->ExecQuery($sql);
		}
		public function ChangeData($table,$field,$value,$filter){
			if($filter!=null){
				$sql=sprintf("UPDATE %s SET %s=%s WHERE %s",$table,$field,$value,$filter);
			}
			else{
				$sql=sprintf("UPDATE %s SET %s=%s",$table,$field,$value);
			}
			$this->ExecQuery($sql);
		}
		public function GetTableList(){
			$sql=sprintf("SHOW TABLES");
			$this->ExecQuery($sql);
			return $this->CreateBundle();
		}
		public function GetData($table,$fields,$filter){
			if($filter!=null){
				$sql=sprintf("SELECT %s FROM %s WHERE %s",$fields,$table,$filter);
			}
			else{
				$sql=sprintf("SELECT %s FROM %s",$fields,$table);
			}
			$this->ExecQuery($sql);
			return $this->CreateBundle();
		}
		public function IsExistCol($table,$filter){
			$sql=sprintf("SELECT * FROM %s WHERE %s",$table,$filter);
			$this->ExecQuery($sql);
			if(mysqli_num_rows($this->result)==0){
				return false;
			}
			return true;
		}
		public function IsExistTable($target){
			$sql=sprintf("SELECT * FROM %s",$target);
			$this->ExecQuery($sql);
			if(mysqli_num_rows($this->result)==0){
				return false;
			}
			return true;
		}
		public function DisconnectDatabase(){
			mysqli_close($this->conn);
		}

		private function ExecQuery($sql){
			$this->result=mysqli_query($this->conn,$sql);
			if($this->$result===false){
				echo mysqli_error();
			}
		}
		private function CreateBundle(){
			$datas=array();
			while($row=mysqli_fetch_array($this->result)){
				$datas[]=$row;
			}
			return $datas;
		}
	}

?>