<?php
	class CommonAction extends Action{
		  /**
     				*--构造函数 
     				*--检测用户是否登录
     */
		public function _initialize(){
			if(!isset($_SESSION['account']))
				$this->redirect('Index/login');
		}
		/**
				*--显示编辑页面
				*--即显示Ueditor提供的富文本编辑页面
		*/
		public function show($method='',$id){
			if($method==''){
			 //找到相应的缓存文件
						$contents = include DATA_PATH.'~'.$this->getActionName().'.php';  
							//转到相应的edit 处理
						$action  = '__APP__/Admin/'.$this->getActionName()."/edit";
			}
			else{
					$Method = strtolower($method);
					if($id==''){
											$action = '__APP__/Admin/'.$this->getActionName().'/update'.$Method;
						}
					else{						
							$action = '__APP__/Admin/'.$this->getActionName().'/update'.$Method."?id=$id";
							$content = include DATA_PATH.'~'.$method.'.php'; 
							foreach($content as $value)	{
											if($value['id']==$id){
														$contents = $value;
														break ;												
												}								
								}
								$title = $value['title'];
							}
					}
			$title = "<p id='tt'>标题:</p><input id='title' type='text' name='title'"."value='$title'"."/>";
			$this->assign('title',$title);
			$this->assign('action',$action);
			//获得了缓存内容
			$this->assign('contents',$contents['content']);
			$this->display('Public:other');
			}
		/**
				*--提交编辑后内容处理函数
				*--并重定向到相应的页面
		*/
		public function edit($title,$content,$id='',$method=''){
			if($method!=''){
					$db = M($method);
					$contents['id']=$id;
					$contents['title']=$title;
					$contents['lanchtime']=date("Y-m-d H:i:s");
					$contents['content']=$content;
					if($id!='')
				   		$db->where("id='$id'")->save($contents);
				   else
				   		$db->data($contents)->add();
				   $list = $db->select();	
					if(is_file(DATA_PATH.'~'.$method.'.php')){
							unlink(DATA_PATH.'~'.$method.'.php');						
						}
						F('~'.$method,$list);
							chmod(DATA_PATH.'~'.$method.'.php',0777);
							$Method = strtolower($method);
							$this->redirect('show'.$Method);
					}
				else{
							$others = M('others');
							$Method = strtolower($this->getActionName());
							$contents['TypeName'] = $Method;
							$contents['Content'] = $_POST['editorValue'];
							//将更改过的信息更新至数据库
							$others->where("TypeName='$Method'")->save($contents);
							//同时更新相应的缓存文件
							//判断缓存文件是否存在
							if(is_file(DATA_PATH.'~'.$this->getActionName().'.php')){
							//先删除缓存文件
							unlink(DATA_PATH.'~'.$this->getActionName().'.php'); 
							}
							//再产生缓存文件
							F('~'.$this->method,$contents);
							//更改缓存文件访问权限
							//------注意 ：在类Unix系统下 通过www-data生成的文件会有访问权限问题 
							//所以我们将文件权限设置为所有用户都能进行
							//读，写，执行	
							chmod(DATA_PATH.'~'.$this->getActionName().'.php',0777);
							$this->display('Index:index');
				}
		}
					/**
					*--显示内容列表	
					*--包括news,pics,topics的显示页面都继承于此	
			*/
				public function showall($method=''){
								if($method!=''){
											$db = M($method);
											$jumpUrl = 'show';
											$jumpUrl.= strtolower($method);
											$Method = strtolower($method);
											//$list = include DATA_PATH.'~'.$method.'.php';
											$num=1;
											$news=M($method);
											//总记录数
										$count=$news->count();
										$Page=$count."条记录 ";
										//总页数
										if(($count%$mark)!=0)
													$pages=(int)($count/$num)+1;
										else 
													$pages=$count/$num;
										//当前为第几页
										if(!isset($_GET['currentpage'])){
														$first=0;
														$currentpage=1;
											}
										else{
														$first=($_GET['currentpage']-1)*$num;
														$currentpage=$_GET['currentpage'];
											}
										//如果是第一页
										if($currentpage==1){
													$Page.=$currentpage.'/'.$pages.'页 ';
									//首页
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage=1>首页</a>';
													if($pages>1)  //如果存在下一页
																$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage=2> 下一页</a>';
											}
									//如果是中间页
										else if(($currentpage>1)&&($currentpage<$pages)){
													$Page.=$currentpage.'/'.$pages.'页';
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage=1> 首页</a>';
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage='.($currentpage-1).' > 上一页</a> '.'<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage='.($currentpage+1).'> 下一页</a>';			
										}
										//如果是尾页
										else{
													$Page.=$currentpage.'/'.$pages.'页';
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage=1> 首页</a>';
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage='.($currentpage-1).'> 上一页</a> ';
										}
							//尾页
													$Page.='<a href=__APP__/Admin/'.$this->getActionName().'/'.$jumpUrl.'?currentpage='.$pages.'> 尾页</a>';			
				//每次查询新闻的条目
												$list = $db->order('lanchtime desc')->limit($first.','.$num)->select();//$first为此页面的首个记录在总记录中的位置
								foreach($list as $example){
										$show.="<ul><li>".$example['id']."</li>";
										$id=$example['id'];
										$show.="<li>".$example['title']."</li>";
										$show.="<li>".$example['lanchtime']."</li>";
										$show.="<li>".'<a href=__APP__/Admin/'.$this->getActionName().'/edit'.$Method."?id=$id".'>编辑</a><a href=__APP__/Admin/'.$this->getActionName().'/delete?method='.$method."&id=$id".'> 删除</a</li></ul>';		
							}
									$this->assign('show',$show);
									$this->assign('page',$Page);
									$this->display();									
									}
					}
			/**
				*--删除信息处理函数
				*--目前仅新闻，首页置顶新闻拥有相应的删除功能
				*/
				
		public function delete(){
					//获取要删除的文件的id
					//获取method ----要操作的数据表
						$action = M($_GET['method']);
				  //如果文件删除失败 	
				 		echo $id = $_GET['id'];
						if(false==$action->where("id='$id'")->delete()){
										$message = "删除失败!";
										//echo "删除失败!";	
										$this->assign('message',$message);
										$this->display('/Public:success');				//重定向到错误页面
							}
						else{
										if(is_file(DATA_PATH.'~'.$_GET['method'].'.php')){
												unlink(DATA_PATH.'~'.$_GET['method'].'.php'); 
										}
										$contents = $action->select();
										F('~'.$_GET['method'],$contents);
										chmod(DATA_PATH.'~'.$method.'.php',0777);
										$Method = strtolower($_GET['method']);
										$this->redirect('show'.$Method);
							}
			}
		}
?>
