<?php

include "mydbconfig.php";

class MySelect implements Iterator{

	protected $_query;
	protected $_sql;
	protected $_pointer = 0;
	protected $_numResult = 0;
	protected $_results = array();

	function __construct($sql){
		$this->_sql = $sql;
	}

	function rewind(){
		$this->_pointer = 0;
	}

	function key(){
		return $this->_pointer;
	}

	protected function _getQuery(){
		if(!$this->_query){
			$connection = MyConnect::getConnection();
			$this->_query = mysql_query($this->_sql, $connection);
			if(!$this->_query){
				throw new Exception('Gagal membaca data dari database:'.mysql_error());
			}
		}
		return $this->_query;
	}

	protected function _getNumResult(){
		if(!$this->_numResult){
			$this->_numResult = mysql_num_rows($this->_getQuery());
		}
		return $this->_numResult;
	}

	function valid(){
		if($this->_pointer >= 0 && $this->_pointer < $this->_getNumResult()){
			return true;
		}
		return false;
	}

	protected function _getRow($pointer){
		if(isset($this->_results[$pointer])){
			return $this->_results[$pointer];
		}
		$row = mysql_fetch_object($this->_getQuery());
		if($row){
			$this->_results[$pointer] = $row;
		}
		return $row;
	}

	function next(){
		$row = $this->_getRow($this->_pointer);
		if($row){
			$this->_pointer ++;
		}
		return $row;
	}

	function current(){
		return $this->_getRow($this->_pointer);
	}

	function close(){
		mysql_free_result($this->_getQuery());
		MyConnect::close();
	}

}

class MyTable {

	protected $_tableName;

	function __construct($tableName){
		$this->_tableName = $tableName;
	}

	public function connect(){
		return MyConnect::getConnection();
	}

	public function close(){
		MyConnect::close();
	}

	function save(array $data){
		$sql = "INSERT INTO ".$this->_tableName." SET";
		foreach($data as $field => $value){
			$sql .= " ".$field."='".mysql_real_escape_string($value, MyConnect::getConnection())."',";
		}
		$sql = rtrim($sql, ',');
		$result = mysql_query($sql, MyConnect::getConnection());
		if(!$result){
			throw new Exception('Gagal menyimpan data ke table '.$this->_tableName.': '.mysql_error());
		}
	}

	function update(array $data, $where = ''){
		$sql = "UPDATE ".$this->_tableName." SET";
		foreach($data as $field => $value){
			$sql .= " ".$field."='".mysql_real_escape_string($value, MyConnect::getConnection())."',";
		}
		$sql = rtrim($sql, ',');
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, MyConnect::getConnection());
		if(!$result){
			throw new Exception('Gagal mengupdate data table '.$this->_tableName.': '.mysql_error());
		}
	}

	function updateBy($field, $value, array $data){
		$where = "".$field."='".mysql_real_escape_string($value, MyConnect::getConnection())."'";
		$this->update($data, $where);
	}

	function updateByAnd($field, $value, $field2, $value2, array $data){
		$where = "".$field."='".mysql_real_escape_string($value)."'";
		$where .= " AND ".$field2."='".mysql_real_escape_string($value2, MyConnect::getConnection())."'";
		$this->update($data, $where);
	}

	function delete($where = ''){
		$sql = "DELETE FROM ".$this->_tableName."";
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, MyConnect::getConnection());
		if(!$result){
			throw new Exception('Gagal menghapus data dari table '.$this->_tableName.': '.mysql_error());
		}
	}

	function deleteBy($field, $value){
		$where = "".$field."='".$value."'";
		$this->delete($where);
	}

    /*contoh :
        $table = new MyTable();
        $data = $table->findManualQuery($tabel = 'post', $field = 'id_post,id_category,title,seotitle', $condition = 'WHERE id_category = "8" ORDER BY id_post DESC LIMIT 5');

        penjelasan : ambil data dari tabel post dengan field-field : id_post, id_category, title, dan seotitle kemudian dengan filter kondisi id_category = 8, urutkan menurut id_post dan sorting dengan metode DESC ambil sebanyak 5 data.
    */
	function findManualQuery($tabel = '', $field = '', $condition = ''){
		if($field){
			$sql = "SELECT ".$field." FROM ".$tabel."";
		}else{
			$sql = "SELECT * FROM ".$tabel."";
		}
		if($condition){
			$sql .= " ".$condition;
		}
		return new MySelect($sql);
	}

    /*contoh :
        $table = new MyTable('post');
        $data = $table->findAll(id_post, DESC);
        
        penjelasan : order data menurut id_post dan urutkan dengan metode DESC.
    */
	function findAll($field, $value){
		if (empty($field) || empty($value)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " ORDER BY ".$field." ".$value."";
			return new MySelect($sql);
		}
	}

	function findAllAnd($field, $value, $field2 , $value2){
		
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value2."'";
			$sql .= " ORDER BY ".$field." ".$value."";
			return new MySelect($sql);
	}
	
    /*contoh :
        $table = new MyTable('post');
        $data = $table->findAllLimit(id_post, DESC, '10');
        
        penjelasan : order data menurut id_post dan urutkan dengan metode DESC kemudian ambil data sebanyak 10.
    */
	function findAllLimit($field, $value, $value2){
		if (empty($field) || empty($value)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " LIMIT ".$value2."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " ORDER BY ".$field." ".$value."";
			$sql .= " LIMIT ".$value2."";
			return new MySelect($sql);
		}
	}

    /*contoh :
        $table = new MyTable('post');
        $table->findAllLimitBy(id_post, id_category, '8', DESC, '10');

        penjelasan : order data menurut id_post dan urutkan dengan metode DESC kemudian ambil data sebanyak 10 dengan kondisi id_category = 8.
    */
	function findAllLimitBy($field, $field2, $value, $value2, $value3){
		if (empty($field) || empty($value2)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " LIMIT ".$value3."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " ORDER BY ".$field." ".$value2."";
			$sql .= " LIMIT ".$value3."";
			return new MySelect($sql);
		}
	}
	
	function findAllLimitByRow($field, $field2, $value, $value2, $value3,$value4){
		if (empty($field) || empty($value2)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " LIMIT ".$value3.",".$value4."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " ORDER BY ".$field." ".$value2."";
			$sql .= " LIMIT ".$value3.",".$value4."";
			return new MySelect($sql);
		}
	}

    /*contoh :
        $table = new MyTable('post');
        $table->findAllLimitByAnd(id_category, 8, active, 'Y', id_post, DESC, 10);

        penjelasan : order data menurut id_post dan urutkan dengan metode DESC kemudian ambil data sebanyak 10 dengan kondisi id_category = 8 dan active = Y.
    */
	function findAllLimitByAnd($field, $field2, $field3, $value, $value2, $value3, $value4){
		if (empty($field) || empty($value2)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " LIMIT ".$value4."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field2."='".$value."'";
			$sql .= " AND ".$field3."='".$value2."'";
			$sql .= " ORDER BY ".$field." ".$value3."";
			$sql .= " LIMIT ".$value4."";
			return new MySelect($sql);
		}
	}

    /*contoh :
        $table = new MyTable('category');
        $table->findAllLimitByRand(id_category, '8', '10');

        penjelasan : ambil data sebanyak 10 dari id_category = 8 kemudian data diurutkan acak.
    */
	function findAllLimitByRand($field, $value, $value2){
		if (empty($field) || empty($value)){
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field."='".$value."'";
			$sql .= " LIMIT ".$value2."";
			return new MySelect($sql);		
		}else{
			$sql = "SELECT * FROM ".$this->_tableName."";
			$sql .= " WHERE ".$field."='".$value."'";
			$sql .= " ORDER BY RAND()";
			$sql .= " LIMIT ".$value2."";
			return new MySelect($sql);
		}
	}

	function findNotAll($field, $value){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."!='".$value."'";
		return new MySelect($sql);
	}

	function findAllRand(){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " ORDER BY RAND()";
		return new MySelect($sql);
	}

	function findBy($field, $value){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		return new MySelect($sql);
	}

	function findByDESC($field, $value, $field2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " ORDER BY ".$field2." DESC ";
		return new MySelect($sql);
	}

	function findByASC($field, $value, $field2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " ORDER BY ".$field2." ASC ";
		return new MySelect($sql);
	}

	function findByAnd($field, $value, $field2, $value2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " AND ".$field2."='".$value2."'";
		return new MySelect($sql);
	}

	function findByAndDESC($field, $value, $field2, $value2, $value3){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " AND ".$field2."='".$value2."'";
		$sql .= " ORDER BY ".$value3." DESC ";
		return new MySelect($sql);
	}

	function findByAndASC($field, $value, $field2, $value2, $value3){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " AND ".$field2."='".$value2."'";
		$sql .= " ORDER BY ".$value3." ASC ";
		return new MySelect($sql);
	}

	function findByLogin($field1, $value1, $field2, $value2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field1."='".$value1."'";
		$sql .= " AND ".$field2."='".$value2."'";
		return new MySelect($sql);
	}

	function findStat($field1, $value1, $field2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field1."='".$value1."'";
		$sql .= " GROUP BY ".$field2."";
		$result = mysql_query($sql, MyConnect::getConnection());
		$result = mysql_num_rows($result);
		return $result;
	}

	function findStatd($field1, $field2, $field3, $value1, $field4){
		$sql = "SELECT SUM(".$field1.") as ".$field2." FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field3."='".$value1."'";
		$sql .= " GROUP BY ".$field4."";
		$result = mysql_fetch_assoc(mysql_query($sql, MyConnect::getConnection()));
		$result = $result[$field2];
		return $result;
	}

	function findByPost($field, $value){
		$sql = "SELECT title, seotitle FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		return new MySelect($sql);
	}

	function findSearchPost($value, $value2){
		$pisah_kata = explode(" ",$value);
		$jml_katakan = (integer)count($pisah_kata);
		$jml_kata = $jml_katakan-1;
		$sql = "SELECT * FROM ".$this->_tableName." WHERE ";
		for ($i=0; $i<=$jml_kata; $i++){
			$sql .= "title OR content LIKE '%$pisah_kata[$i]%'";
			if ($i < $jml_kata ){
				$sql .= " OR ";
			}
		}
		$sql .= " AND active='Y' ORDER BY id_post DESC";
		$sql .= " LIMIT ".$value2."";
		return new MySelect($sql);
	}

	function findRelatedPost($value, $value2, $value3, $value4, $value5){
		$pisah_kata  = explode(",",$value);
		$jml_katakan = (integer)count($pisah_kata);
		$jml_kata = $jml_katakan-1; 
		$sql = "SELECT * FROM ".$this->_tableName." WHERE (id_post < ".$value2.") AND (id_post != ".$value2.") AND (" ;
			for ($i=0; $i<=$jml_kata; $i++){
				$sql .= "tag LIKE '%$pisah_kata[$i]%'";
				if ($i < $jml_kata ){
					$sql .= " OR ";
				}
			}
		$sql .= ") AND active='Y'";
		$sql .= " ORDER BY ".$value3." ".$value4."";
		$sql .= " LIMIT ".$value5."";
		return new MySelect($sql);
	}

	function numRow(){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$result = mysql_query($sql, MyConnect::getConnection());
		$result = mysql_num_rows($result);
		return $result;
	}

	function numRowBy($field, $value){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$result = mysql_query($sql, MyConnect::getConnection());
		$result = mysql_num_rows($result);
		return $result;
	}
	
	function numRowByAnd($field, $value, $field2, $value2){
		$sql = "SELECT * FROM ".$this->_tableName."";
		$sql .= " WHERE ".$field."='".$value."'";
		$sql .= " AND ".$field2."='".$value2."'";
		$result = mysql_query($sql, MyConnect::getConnection());
		$result = mysql_num_rows($result);
		return $result;
	}

	function numRowSearchPost($value){
		$pisah_kata = explode(" ",$value);
		$jml_katakan = (integer)count($pisah_kata);
		$jml_kata = $jml_katakan-1;
		$sql = "SELECT * FROM ".$this->_tableName." WHERE ";
		for ($i=0; $i<=$jml_kata; $i++){
			$sql .= "title OR content LIKE '%$pisah_kata[$i]%'";
			if ($i < $jml_kata ){
				$sql .= " OR ";
			}
		}
		$sql .= " AND active='Y' ORDER BY id_post DESC";
		$result = mysql_query($sql, MyConnect::getConnection());
		$result = mysql_num_rows($result);
		return $result;
	}
}

?>