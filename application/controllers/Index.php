<?php

	/* ��ҳ */
	class IndexController extends Yaf_Controller_Abstract {

		/* �Զ����ã������ڹ��췽�� */
		public function init(){}

		/* Ĭ��Action */
		public function indexAction() {
			$str = 'Thanks a lot!';
			$this->getView()->assign("content", $str);
		}
	}
?>
