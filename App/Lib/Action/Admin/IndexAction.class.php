<?php
class IndexAction extends Action
{
	public function index()
    	{	
		if(!isset($_SESSION['account'])){
			$this->redirect('login');	
		}else{
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$contents="content<br/>";
			$this->assign('login',$login);
			$this->assign('contents',$contents);
			$this->assign('content','index');
			$this->display();
			}
    	}	
	public function login(){
		$this->display('login');	
	}	
	public function check(){
		$account=$_POST['account'];
		$password=$_POST['password'];
		$User=M('user');
		$pass=$User->where("account='$account'")->getField('password');
		if($password!='')
			{
			if($pass==$password){
			session_start();//打开session
			$_SESSION['account']=$account;
			$this->redirect('index');//显示首页
	}
		else{
			$this->display('Index/login');
			}
		}
	else{
		$this->display('Index/login');
	}
	}
}
?>
