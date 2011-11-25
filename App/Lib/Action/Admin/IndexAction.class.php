<?php
class IndexAction extends CommonAction
{
	/**
			*--构造函数
			*--不在构造函数中写任何代码
			*--防止页面重定向循环
	*/
	public function _initialize(){
			
		}
		/**
			显示首页
		*/
	public function index()
    	{	
    	if(!isset($_SESSION['account']))
    			$this->redirect('login');
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
		//	$contents="content<br/>";
			$this->assign('login',$login);
	//		$this->assign('contents',$contents);
	//		$this->assign('content','index');
			$this->display();
    	}	
    	/**
				*--登录页面    	
    	*/
	public function login(){
		if(isset($_SESSION['account']))
				$this->redirect('index');
		$this->display('login');	
	}	
	/**
			*--登录检查	
	*/
	public function check(){
			//登录验证
		if(empty($_POST['account'])) {
			$this->assign('message','帐号必须!');
			$this->display('login');
			return ;   //直接返回
		}
		elseif (empty($_POST['password'])){
			$this->assign('message', '密码必须!');
			$this->display('login');
			return ;		//直接返回
		}
		//如果帐号和密码都存在 
		$account=$_POST['account'];
		$password=$_POST['password'];
		$User=M('user');
		$pass=$User->where("account='$account'")->getField('password');
			if($pass==$password){
						session_start();								//打开session
						$_SESSION['account']=$account;
						$this->redirect('index');		//显示首页
					}
		else{
						$this->assign('message','密码或账户错误!');
						$this->display('login');
				}
		}
		/**
				*--用户登出		
		*/
			public function logout(){
						if(isset($_SESSION['account'])){
										unset($_SESSION['account']);
										unset($_SESSION);
										session_destroy();							
										$this->redirect('login');
							}	
							else{
										$this->assign('message','已经登出!');	
										$this->display('login');
										return ;							
								}			
				}
}
?>