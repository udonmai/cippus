<?php
		class HomeAction extends CommonAction{
						public function 	showpics(){
									$this->showall('Pics');			
							}
						public function editpics(){ 
							//显示id是GET['id']的图片的信息						
									$this->show('Pics',$_GET['id']);  	
							}
						 public function updatepics(){
									$this->edit($_POST['title'],$_POST['editorValue'],$_GET['id'],'Pics');
							}
						public function topic(){
													$this->show('Topics');
							}
						public function showtopics(){
									$this->showall('Topics');								
							}
						public function edittopics(){
										$this->show('Topics',$_GET['id']);
								}
						public function updatetopics(){
										$this->edit($_POST['title'],$_POST['editorValue'],$_GET['id'],'Topics');			
								}
//	class HomeAction extends CommonAction{
	/*	public function showpics(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
			}else{
			$pics=M('pics');
			$list=$pics->select();
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";	
			foreach($list as $example){
				$show.="<ul><li>".$example['id']."</li>";
				$id=$example['id'];
				$show.="<li>".$example['title']."</li>";
				$show.="<li>".$example['lanchtime']."</li>";
				$show.="<li>".'<a href=__APP__/Admin/Home/editpic?id='."$id".'>'.编辑.'</a>'.'</li></ul>';		
			}
			$this->assign('login',$login);
			$this->assign('show',$show);
			$this->display();
	}
		}*/
/*		public function editpic(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$pics=M('pics');
			$id=$_GET['id'];
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$action='__APP__/Admin/Home/updatepic?id='."$id";
			$example=array();
			$example=$pics->where("id='$id'")->find();
			$title=$example['title'];
			$title="<p id='tt'>标题:</p><input id='title' type='text' name='title'"."value='$title'"."/>";
			$this->assign('login',$login);
			$this->assign('title',$title);
			$this->assign('action',$action);
			$this->assign('contents',$example['content']);
			$this->display('Public:other');			
		}
	}*/
/*		public function updatepic(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$news=M('pics');
			$id=$_GET['id'];
			$contents['title']=$_POST['title'];
			$contents['content']=$_POST['editorValue'];
			$news->where("id='$id'")->save($contents);	
			$this->redirect("showpics");			
		}
	}*/
	/*	public function showtopics(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$pics=M('topics');
			$list=$pics->select();
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			foreach($list as $example){
				$show.="<ul><li>".$example['id']."</li>";
				$id=$example['id'];
				$show.="<li>".$example['title']."</li>";
				$show.="<li>".$example['lanchtime']."</li>";
				$show.="<li>".'<a href=__APP__/Admin/Home/topic?id='."$id".'>'.编辑.'</a>'.'</li></ul>';		
			}
			$this->assign('login',$login);
			$this->assign('show',$show);
			$this->display();	
		}
	}
		public function topic(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$action="__APP__/Admin/Home/updatetopic";
			$title='<p id="tt">标题:</p><input id="title" type="text" name="title"/>';
			if(isset($_GET['id'])){
				$topics=M('topics');
				$id=$_GET['id'];
				$action='__APP__/Admin/Home/updatetopics?id='."$id";
				$example=array();
				$example=$topics->where("id='$id'")->find();
				$title=$example['title'];
				$title="<p id='tt'>标题:</p><input id='title' type='text' name='title'"."value='$title'"."/>";			
			}			
			$this->assign('action',$action);
			$this->assign('title',$title);
			$this->assign('contents',$example['content']);
			$this->display("Public:other");	
		}
	}
/*		public function updatetopic(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$topics=M('topics');
			$contents['title']=$_POST['title'];
			$contents['content']=$_POST['editorValue'];
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				$topics->where("id='$id'")->save($contents);			
			}
			else{
				$contents['lanchtime']=date("Y-m-d H:i:s");
				$topics->data($contents)->add();			
			}
			//dump($contents);
			$this->redirect("showtopics");	
		}
	}	*/	
	}
?>
