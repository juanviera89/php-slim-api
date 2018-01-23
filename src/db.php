<?php


class dbConnection {

    //private $db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8mb4', 'username', 'password', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    private $db = null;

     public function __construct($host,$dbname,$user,$pass,$charset){
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->db = new PDO($dsn, $user, $pass, $opt);

        
       /*  $pdo = new PDO($dsn, $user, $pass, $opt);

        $this -> $db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8mb4', 'username', 'password');
        $this->$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); */
    }

    public function getData($table,$selectCols = array(),$conditionCol = array(),$conditionVals = array(),$logicOps = array()) {

        $cols = '';

        $cols = count($selectCols) > 0 ? ( count($selectCols) == count($selectCols,1) ? join(", ", $selectCols) : '*' ) : '*';

        //$table = $this->filterArgs($table);

        $query = "SELECT $cols FROM $table";

        if ( count($conditionCol) > 0  && count($conditionCol) == count($conditionVals) && count($conditionCol) == (count($logicOps) + 1 ) ){
            $condQuery= " WHERE ";

            for ($i=0; $i < count($conditionCol) ; $i++) { 
                $condQuery = $condQuery . $conditionCol[$i] . " = ? " . ( $i < count($logicOps) ? $logicOps[$i] : "") ;
            }

            $query = $query . $condQuery;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($conditionVals);

        return $stmt->fetchAll();
     }

    private function filterArgs($arg){
        return $arg;
    }
}
