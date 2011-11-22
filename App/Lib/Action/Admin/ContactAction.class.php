<?php
	class ContactAction extends Action{
		public function show(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$others=M('others');
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$action="__APP__/Admin/Contact/edit";
			$contents=$others->where('TypeName="contact"')->getField('Content');
			$this->assign('login',$login);
			$this->assign('action',$action);
			$this->assign('contents',$contents);
			$this->display('Public:other');
		}
	}
		public function edit(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$others=M('others');
			$contents['TypeName']="contact";
			$contents['Content']=$_POST['editorValue'];
			$others->where('TypeName="contact"')->save($contents);
			$this->display('Index:index');
		}
	}
	}
?>
