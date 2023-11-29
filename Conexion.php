<?php
class Conexion
{	
	public static function conectar(){

		$localhost = "localhost:3306";
		$database = "centrodeinformacion";
		$user = "root";
		$password = "mysql#123";
		$link = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);
		return $link;
	}
}
