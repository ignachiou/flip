<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

//modelo para conectar la base de datos con el modelo

class DbArticulo extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function getLastId(){
    	
    	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "biblio";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
     	die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT max(id_revista) FROM revista";
$result = $conn->query($sql);


     // output data of each row
    // $row = $result;
     $row = $result->fetch_assoc();
     $last = $row["max(id_revista)"];
    	return $last;
    	
    }
    
    public static function tableName()
    {
        return 'articulo';
    }
    
}