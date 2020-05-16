<?php
class DB{
    /**
     * @return PDO
     */
    private function DB(){
        $server     = 'localhost';     
        $database   = 'tmi';        
        $user       = 'root';          
        $password    = '';          
        try {
            date_default_timezone_set('Europe/Madrid');
            setlocale (LC_TIME, "es_ES");
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $connection = new PDO("mysql:host=$server;dbname=$database", $user, $password, $options);
            return $connection;
        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage()); 
        }
    }
    
    /**
     * @return array
     */
    protected function executeSelect( $sql, $param = array() ){
        try{
            $connection = $this->accessDB();
            $stm = $connection->prepare($sql);
            $stm->execute($param);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    /**
     * This method executes Insert, Delete and Update and this return in all cases the rows affected. 
     * In other case, if $withLastID is 1 the method return the last auto increment ID of the insert.
     * 
     * @return int
     */
    protected function executeDML( $dml, $param = array() , $withLastID = 0){
        try{
            $connection = $this->accessDB();
            $stm = $connection->prepare($dml);
            $stm->execute($param);
            $rowsAffectedOrLastID = 0;
            if($withLastID != 0 &&  (strpos(strtoupper($dml), 'INSERT')!==false)){
                $rowsAffectedOrLastID = $pdo->lastInsertId();
            } else{
                $rowsAffectedOrLastID = $stm->rowCount();
            }
            return $rowsAffectedOrLastID;
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    }    
}

?>