<?php
/**
* Classe de conexão com o banco de dados
* @author: Roberto Ramos
* @retorno: PreparedStantment
*/
class Repositorio
{
	private $dsn;
	private $user;
	private $pass;

	function __construct()
	{
		$this->dns = "mysql:dbname=lifeCMS;host=localhost";
		$this->user = "root";
		$this->pass = "@rdc456#";
	}

	public static function GetConection(){
		try{
			$conn = new PDO(self::$dsn, self::$user, self::$pass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "<p>Ocorreu um erro ao se conectar ao banco de dados.</p>";
			echo "<p>Message:</p><p>/t".$e->getMessage()."</p>";
		}
		return $conn;
	}

}
?>