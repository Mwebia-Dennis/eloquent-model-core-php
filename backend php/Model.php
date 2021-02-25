<?php
	
	require 'sql_execute.php';
	require 'QueryBuilder.php';
	/**
	 * 
	 */
	class Model extends QueryBuilder
	{
		//sql required data;
		private $table = '';
		private $select = '';
		private $where_condition = '';
		private $order_by = '';
		private $limit = '';
		private $offset = 0;
		//create an instance of sql execute;
		private $queryMysql;

		function __construct($table)
		{
			Parent::__construct($table);
			$this->table = $table;
			$this->queryMysql = new QueryMysql();
		}

		public function all()
		{
			return $this->get();
		}
		public function save($data)
		{
			if(!$data){
				return false;
			}

			$sql = $this->setInsertClause($data, true);
			return $this->queryMysql->execute($sql)->isSuccess();

		}
		public function get()
		{
			
			$sql = '';
			if($this->select == '') {
				//create select statement
				$this->select();
			}

			$sql .= $this->select;

			if($this->where_condition != '') {

				$sql .= " WHERE ".$this->where_condition;
			}
			if($this->order_by != ''){
				$sql .= $this->order_by;
			}

			if($this->limit != '') {
				$sql .= " limit ".$this->limit;
				$sql .= " offset ".$this->offset;
			}

			$result = $this->queryMysql->execute($sql)->getData();
			return $result;
		}

		public function update($new_data, $col_value, $col = 'id') {

			$updateClause = $this->setUpdateClause($new_data);
			$this->where_condition = '';
			$this->where($col, $col_value);
			$sql = $updateClause." WHERE ".$this->where_condition;

			return $this->queryMysql->execute($sql)->isSuccess();
		}

		public function delete($col_value, $col = 'id')
		{
			
			$this->where_condition = '';
			$this->where($col, $col_value);
			$this->limit(1);
			$sql = $this->setDeleteClause()." WHERE ".$this->where_condition." limit ".$this->limit;

			return $this->queryMysql->execute($sql)->isSuccess();

		}

		public function select($cols = '*')
		{
			$this->select = $this->setSelectClause($cols);
			return $this;
		}

		public function distinct($cols = '*')
		{
			$this->select = $this->setSelectClause($cols, true);
			return $this;
		}

		public function where($column, $value, $operator = '=')
		{
			if($this->where_condition != '') {
				$this->where_condition .= ' AND ';
			}
			$this->where_condition .= $this->setWhereClause([$column, $operator, $value]);

			return $this;

		}
		public function orWhere($column, $value, $operator = '=')
		{
			if($this->where_condition != '') {
				$this->where_condition .= ' OR ';
			}
			$this->where_condition .= $this->setWhereClause([$column, $operator, $value]);

			return $this;

		}
		public function orderBy($col_name, $order_format = 'ASC')
		{

			if($this->order_by == '') {

				$this->order_by .= ' order by ';
			}else {

				//add comma since we adding new order column
				$this->order_by .= ",";
			}

			if ($col_name) {				

				$this->order_by .= $col_name." ".$order_format;
			}
			

			return $this;
		}

		public function limit($limit) {

			$this->limit = $limit;
			return $this;
		}


		public function offset($offset) {

			$this->offset = $offset;
			return $this;
		}

		public function count()
		{
			
			return sizeof($this->get());
		}
		public function first()
		{
			//set limit to 1 to get only the first result
			$this->limit(1);
			return $this->get();
		}

		public function reset()
		{
			$this->select = '';
			$this->where_condition = '';
			$this->order_by = '';
			$this->limit = '';
			$this->offset = 0;

			return $this;
		}
	}

?>