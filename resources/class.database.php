<?php

class Database extends PDO { 
	
	private static $_instance;
	private static $_dbn = '' ; 	//DBNAME
	private static $_dsn = ''; 		//mysql:host=HOST;dbname=DBNAME'
	private static $_dbuser = '' ; 	//DBUSER
	private static $_dbpwd = ''; 	//DBPASS
	
	var $host;  		
	var $password; 	
	var $user; 		
	var $database; 	

	public function __construct( ) {

    }
	
	public static function getInstance() {

		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		); 
		
        if (!isset(self::$_instance)) {
			 
            try {
                self::$_instance = new PDO(self::$_dsn, self::$_dbuser, self::$_dbpwd, $options);
            }
			//catch (PDOException $e) {
			catch(Exception $e) {
				self::$error = '<html><body>'.get_class($e).' dans '.$e->getFile().' à la ligne '.$e->getLine().' : '.$e->getMessage().'</body></html>';
				die (
					self::si_erreur()
				);
            }
        }
        return self::$_instance;
    }
	
	private static function si_erreur() {
		return self::$error;
	}
	
	public static function dbn(){
		return self::$_dbn;
	}
}

?>
