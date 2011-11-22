<?php
	class QuitAction extends Action{
		public function index(){
			if(!isset($_SESSION['account'])){
				$this->redirect('Index/login');			
			}
			else{
				session_start();
				unset($_SESSION['account']);
				$this->redirect('Index/login');
			}
		}
}
?>
