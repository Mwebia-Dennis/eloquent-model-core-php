<?php
	
	/**
	 * 
	 */
	class QueryBuilder
	{
		
		private $table;
		public $sql = '';
		function __construct($table)
		{

			if($table == '') {

				throw new Exception("Table name cannot be null", 1);
				
			}
			$this->table = $table;
		}

		public function setInsertClause($data)
		{

			if(!$data) {

				throw new Exception("data to be inserted cannot be null", 1);
				
			}else if(!is_array($data)) {

				throw new Exception("Invalid parameter type, data passed should be of type array", 1);
				
			}

			$sql = "INSERT INTO ".$this->table." ";

        	$columns = "";
        	$values = "";
        	$i = 0;
        	foreach ($data as $col_name => $col_value) {
        		
        		$columns .= "`". $col_name."`";
        		$values .= "'".$this->escape($col_value)."'";

        		if ($i < (sizeof($data)-1)) {
        			
        			$columns .= ", ";
        			$values .= ", ";
        		}
                $i++;


        	}

        	$sql .= "(".$columns.") VALUES (".$values.")";

        	return $sql;
		}

		public function setSelectClause($columns, $distinct = false){


			$cols = '';

            if(is_array($columns)) {

            	$counter = 0;
            	foreach ($columns as $column_name) {
					
					$cols .= $this->escape($column_name);


					if ($counter < (sizeof($columns)-1)) {
						//adding commas between columns
						$cols .= ",";
					}

					$counter ++ ;
				}

            }else if($columns == '*') {

            	//select every column
            	$cols .= $columns;
            }else {
            	throw new Exception("Invalid parameter type, column should be of type array", 1);            	
            }

			$sql = 'SELECT ';
			$distinct = ($distinct)?'DISTINCT ':'';
			$sql .= $distinct.$cols;

            if($this->table){

            	$sql .= " FROM ".$this->table;
            }

            return $sql;
		}

		public function setWhereClause($condition) {

			if (!$condition) {
				
				throw new Exception("Conditions to used on where clause cannot be null", 1);
				
			}

			$whereClause = '';

			if($condition) {

				$whereClause = $this->escape($condition[0])." ".$this->escape($condition[1])." '".$this->escape($condition[2])."' ";
            }

            return $whereClause;

		}

		public function setUpdateClause($new_data)
		{


			if(!$new_data) {

				throw new Exception("data to be updated cannot be null", 1);
				
			}else if(!is_array($new_data)) {

				throw new Exception("Invalid parameter type, data passed should be of type array", 1);
				
			}


			$sql = '';

			if($new_data && is_array($new_data)) {

				$sql .= "UPDATE ".$this->table." SET ";

	        	$i = 0;
	        	foreach ($new_data as $col_name => $col_value) {
	        		
	        		$sql .= $this->escape($col_name) . " = '". $this->escape($col_value)."'";

	        		if($i < (sizeof($new_data)-1)) {

	        			$sql .=", ";
	        		}
	        		$i++;
	        	}
        	}

        	return $sql;

		}

		public function setDeleteClause()
		{
			return "DELETE FROM ".$this->table;
		}
		private function escape($string_char) {

        	global $conn;
            return $conn->real_escape_string($string_char);
        }


	}

?>