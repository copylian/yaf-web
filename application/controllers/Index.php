<?php

	/* 首页 */
	class IndexController extends Yaf_Controller_Abstract {

		/* 自动调用，类似于构造方法 */
		public function init(){}

		/* 默认Action */
		public function indexAction() {
			//$userModel = new models_table(); //实例化一个数据库对象
			//$userModel->getData(); //查询一条数据
			//$userModel->getDataAll(); //查询多条数据
			//$userModel->updateData(); //更新数据
			//$userModel->deleteData(); //删除数据
			//$userModel->insertData(); //插入数据
			$str = 'Thanks a lot!';
			$this->getView()->assign("content", $str);
		}
	}
?>
