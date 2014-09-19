<?php

/*
 * mysql操作类
 * url http://github.com/whaten
 * 欢迎大家扩展回馈
 */
abstract class Database{

	protected $_pdo; //object >> pdo对象
	protected $_sql; //string >> 保存最后一条执行的sql
	protected $_table; //string >> 表名
	protected $_column; //string >> 需要查询的字段
	protected $_where; //string >> sql条件
	protected $_value; //array >> sql中添加或者修改的值
	protected $_offset; //int >> 偏移量
	protected $_limit; //int >> sql作用的条数

	/*
	 * 创建一个pdo连接，读取conf/application.ini中的配置
	 */
	protected function __construct(){
		$config = new Yaf_Config_Ini(APP_PATH . '/conf/application.ini');
		$dbConfig = $config->get('product')->db;
		$dsn = "mysql:host=$dbConfig->host;port=$dbConfig->prot;charset=$dbConfig->charset;dbname=$dbConfig->name";
		$this->_pdo = new PDO($dsn, $dbConfig->user, $dbConfig->pwd);
	}

	/*
	 * 添加数据
	 * $this->_value = array('name'=>'xiaoming');
	 * $this->_insert();
	 * @return int 最后插入数据的id
	 */
	protected function _insert(){
		$sql = "INSERT INTO `$this->_table` ";
		$column = $value = '';
		foreach ($this->_value as $key => $val) {
			$column .= ',`' . $key . '`';
			$value .= ',"' . $val . '"';
		}
		if($column && $value){
			$column = '(' . substr($column, 1) . ')';
			$value = '(' . substr($value, 1) . ')';
		}
		$this->_sql = $sql .= $column . ' VALUES' . $value;
		$s = $this->_pdo->exec($sql);
		return $this->_getLastId();

	}

	/*
	 * 更新数据
	 * $this->_value = array('name'=>'xiaohong');
	 * $this->_where = 'id=1';
	 * $this->_update();
	 * @return int 受影响的行数
	 */
	protected function _update(){
		$sql = "UPDATE `$this->_table` SET ";
		$column = '';
		foreach($this->_value as $key=>$val){
			$column .= ',`' . $key . "`='$val'";
		}
		$sql .= substr($column, 1);
		if($this->_where) $sql .= " WHERE $this->_where";
		$this->_sql = $sql;
		return $this->_pdo->exec($sql);
	}

	/*
	 * 删除数据
	 * $this->_where = 'id=1';
	 * $this->_delete();
	 * @return int 受影响的行数
	 */
	protected function _delete(){
		$sql = "DELETE FROM `$this->_table` WHERE $this->_where";
		$this->_sql = $sql;
		return $this->_pdo->exec($sql);
	}

	/*
	 * 查询一条数据
	 * $this->_where = array('id'=>1);
	 * $this->_column = 'name';
	 * $this->_getOne();
	 * @return array 返回一个一维数组
	 */
	protected function _getOne(){
		$column = $this->_column ? $this->_column : '*';
		$sql = "SELECT $column FROM `$this->_table` WHERE ";
		$where = '';
		foreach($this->_where as $key=>$val){
			$where .= " and `$key`='$val'";
		}
		$sql .= substr($where, 4) . ' LIMIT 0,1';
		$this->_sql = $sql;
		$pdo = $this->_pdo->query($sql);
		return $pdo->fetchColumn();
	}

	/*
	 * 查询多条数据
	 * $this->_where = array('name'='xiaoming');
	 * $this->_column = 'id';
	 * $this->_limit = 10;
	 * $this->_getAll();
	 * @return array 返回一个二维数组
	 */
	protected function _getAll(){
		$column = $this->_column ? $this->_column : '*';
		$sql = "SELECT $column FROM `$this->_table` WHERE ";
		$where = '';
		foreach($this->_where as $key=>$val){
			$where .= " and `$key`='$val'";
		}
		$sql .= substr($where, 4);
		$limit = 1;
		$offset = 0;
		if($this->_offset) $offset = $this->_offset;
		if($this->_limit) $limit = $this->_limit;
		$sql .= " LIMIT $offset, $limit";
		$this->_sql = $sql;
		$pdo = $this->_pdo->query($sql);
		return $pdo->fetchAll(PDO::FETCH_ASSOC);
	}

	/*
	 * 查询最后插入数据的id
	 * @return int
	 */
	protected function _getLastId(){
		return $this->_pdo->lastInsertId();
	}


}
