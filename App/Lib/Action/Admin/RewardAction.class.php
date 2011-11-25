<?php
			class RewardAction extends CommonAction{	
				}
	/*class RewardAction extends CommonAction{
		public function show(){
		if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$others=M('others');
			$action="__APP__/Admin/Reward/edit";
			$contents=$others->where('TypeName="reward"')->getField('Content');
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
			$contetns['TypeName']="reward";
			$contents['Content']=$_POST['editorValue'];
			$others->where('TypeName="reward"')->save($contents);
			$this->display('Index:index');
		}
	}
	}*/
?>
