<?php

	/* 首页 */
	class IndexController extends Yaf_Controller_Abstract {

		/* 自动调用，类似于构造方法 */
		public function init(){}

		/* 默认Action */
		public function indexAction() {
			$str = 'Thanks a lot!';
			$this->getView()->assign("content", $str);
		}
	}
?>
