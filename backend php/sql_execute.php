<?php

	require 'db_connection.php';

    class QueryMysql {

        private $result;

        public function getData() {

            $_data = [];

            if ($this->result) {

                if($this->result->num_rows > 0){
                
                    while($row = $this->result->fetch_assoc()){
                        
                        $_data[] = $row;
                    }
                    
                }
            }
            
            return $_data;
            
        }
        
        public function execute($sql) {

            global $conn;
            $this->result = $conn->query($sql);
            return $this;
        }

        public function runCustomQueries($sql){

            return $this->execute($sql)->getData();        	
        }

        public function isSuccess()
        {
            return ($this->result == true);
        }
    
    }
?>