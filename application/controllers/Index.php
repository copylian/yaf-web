<?php

	/* ��ҳ */
	class IndexController extends Yaf_Controller_Abstract {

		/* �Զ����ã������ڹ��췽�� */
		public function init(){}

		/* Ĭ��Action */
		public function indexAction() {
			//$userModel = new models_table(); //ʵ����һ�����ݿ����
			//$userModel->getData(); //��ѯһ������
			//$userModel->getDataAll(); //��ѯ��������
			//$userModel->updateData(); //��������
			//$userModel->deleteData(); //ɾ������
			//$userModel->insertData(); //��������
			$str = 'Thanks a lot!';
			$this->getView()->assign("content", $str);
		}
	}
?>
