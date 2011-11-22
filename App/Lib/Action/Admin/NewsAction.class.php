<?php
	class NewsAction extends Action{
		public function show(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$action="__APP__/Admin/News/edit";
			$title='<p id="tt">标题:</p><input id="title" type="text" name="title"/>';
			$this->assign('login',$login);
			$this->assign('action',$action);
			$this->assign('title',$title);
			$this->display("Public:other");
		}
	}
		public function edit(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$others=M('news');
			$contents['title']=$_POST['title'];
			$contents['lanchtime']=date("Y-m-d H:i:s");
			$contents['content']=$_POST['editorValue'];
			$others->data($contents)->add();
			$this->redirect("showall");
		}
	}
		public function showall(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			
			$news=M('news');
			$count=$news->count();
			$mark=10;//每页的记录数
			$Page=$count."条记录 ";
		//总页数
			if(($count%$mark)!=0)
				$pages=(int)($count/$mark)+1;
			else 
				$pages=$count/$mark;
		//当前为第几页
			if(!isset($_GET['currentpage'])){
				$first=0;
				$currentpage=1;
			}
			else{
				$first=($_GET['currentpage']-1)*$mark;
				$currentpage=$_GET['currentpage'];
			}
		//如果是第一页
			if($currentpage==1){
				$Page.=$currentpage.'/'.$pages.'页 ';
		//首页
			$Page.='<a href=__APP__/Admin/News/showall?currentpage=1>首页</a>';
				if($pages>1)  //如果存在下一页
					$Page.='<a href=__APP__/Admin/News/showall?currentpage=2> 下一页</a>';
			}
		//如果是中间页
			else if(($currentpage>1)&&($currentpage<$pages)){
				$Page.=$currentpage.'/'.$pages.'页';
		//首页
			$Page.='<a href=__APP__/Admin/News/showall?currentpage=1> 首页</a>';
				$Page.='<a href=__APP__/Admin/News/showall?currentpage='.($currentpage-1).' > 上一页</a> '.'<a href=__APP__/Admin/News/showall?currentpage='.($currentpage+1).'> 下一页</a>';			
			}
		//如果是尾页
			else{
				$Page.=$currentpage.'/'.$pages.'页';
				$Page.='<a href=__APP__/Admin/News/showall?currentpage=1> 首页</a>';
				$Page.='<a href=__APP__/Admin/News/showall?currentpage='.($currentpage-1).'> 上一页</a> ';
			}
		//尾页
				$Page.='<a href=__APP__/Admin/News/showall?currentpage='.$pages.'> 尾页</a>';
		//直接跳转到某页
		/*	$Page.='<form name=currentpage action=__APP__/Admin/News/showall?currentpage='..' method=get >
			 		第<input name=currentpage id=currentpage type=text />页'
					.'<input type=submit value=Go/> 
				</form>';*/
		//每次查询新闻的条目
			$list=$news->order('lanchtime desc')->limit($first.','.$mark)->select();//$first为此页面的首个记录在总记录中的位置
			foreach($list as $example){
				$show.="<ul>";
				$show.="<li>".$example['id']."</li>";
				$id=$example['id'];
				$show.="<li>".$example['title']."</li>";
				$show.="<li>".$example['lanchtime']."</li>";
				$show.="<li>".'<a href=__APP__/Admin/News/editall?id='."$id".'>'.编辑.'</a>'.' '.'<a href=__APP__/Admin/News/delete?id='."$id".'>'.删除.'</a>'."</li></ul>";	
			}	
			$this->assign('login',$login);
			$this->assign('show',$show);
			$this->assign('page',$Page);
			$this->display("Public:default");
		}
	}
		public function editall(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$login="<a href='__APP__/Admin/Quit/index'><div id='quit'>退出</div></a>";
			$news=M('news');
			$id=$_GET['id'];
			$example=array();
			$example=$news->where("id='$id'")->find();
			$title=$example['title'];
			$title="<p id='tt'>标题:</p><input id='title' type='text' name='title'"."value='$title'"."/>";	
			$action='__APP__/Admin/News/update?id='."$id";
			$this->assign('login',$login);
			$this->assign('action',$action);
			$this->assign('title',$title);
			$this->assign('contents',$example['content']);
			$this->display('Public:other');					
		}
	}
		public function update(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$news=M('news');
			$id=$_GET['id'];
			$contents['title']=$_POST['title'];
			$contents['content']=$_POST['editorValue'];
			$news->where("id='$id'")->save($contents);	
			$this->redirect("showall");				
		}
	}
		public function delete(){
			if(!isset($_SESSION['account'])){
			$this->redirect('Index/login');	
		}else{
			$news=M('news');	
			$id=$_GET['id'];
			$news->where("id='$id'")->delete();
			$this->redirect('showall');
		}
	}
	}
?>
