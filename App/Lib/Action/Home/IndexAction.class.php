<?php
	class IndexAction extends Action{
		public function index(){
		//读取首页图片
			$pics=M('pics');
			$list=$pics->order('lanchtime desc')->select();
			foreach($list as $example){
				$title=$example['title'];
				$start=stripos($example['content'],'Ue'); 
				$length=strripos($example['content'],"width")-2-$start;
				$url=substr($example['content'],$start,$length);
				$pic.='<div class="ca-item ca-item-1" ><img src='.$url.' alt='.$title.' ></div>';
			}
				$this->assign('pics',$pic);
		//读取首页重要新闻
			$topics=M('topics');
			$list=$topics->order('lanchtime desc')->select();
			foreach($list as $example){
				$id=$example['id'];
				$Topics.='<div class="important_item J_pop"><a href=javascript:void(0) name='."$id".'>'.$example['title']."</a><br></div>";
			}
			$this->assign('topics',$Topics);
		//读取新闻标题
			$news=M('news');
			$count=$news->count();
			$mark=10;//每页的记录数
			//$list=$news->order('lanchtime desc')->select();
			$list=$news->order('lanchtime desc')->limit('0,'.$mark)->select();//$first为此页面的首个记录在总记录中的位置
			$num=1;
			$space = '&nbsp&nbsp';
			foreach($list as $example){
				$id=$example['id'];
				$dt=substr($example['lanchtime'], 0, 10);
				if($num == 10) $space = ''; 
				$News.='<div class="media_item J_pop"><span class="number">'.$space.$num++.'. </span><a href=javascript:void(0) name='."$id".'>'.$example['title'].'</a><span class=dt>'.$dt.'</span><br></div>';

			}
			if(($count%$mark)!=0)
				$pages=(int)($count/$mark)+1;
			else 
				$pages=$count/$mark;
			if($pages!=1)
				$News.='<div id="more" style="display:none;">1</div>';	
			else 
				$News.='<div id="more" style="display:none;">0</div>';	
			$this->assign('news',$News);
		//读取创新小组
			$group=M('others');
			$this->assign('group',$group->where('TypeName="group"')->getField('Content'));
		//读取团队
			$team=M('others');
			$this->assign('team',$group->where('TypeName="team"')->getField('Content'));
		//读取奖项
			$reward=M('others');
			$this->assign('reward',$group->where('TypeName="reward"')->getField('Content'));
		//读取联系
			$contact=M('others');
			$this->assign('contact',$group->where('TypeName="contact"')->getField('Content'));
		//输出首页
			$this->display();		
		}	
		public function news(){
			$id=$_GET['id'];
			$news=M('news');
			$example=$news->where("id='$id'")->find();
			//dump($example);
			//$json=json_encode($example);
			//dump($json);
			echo $example['content'];		
		}
		public function topics(){
			$id=$_GET['id'];
			$topics=M('topics');
			$example=$topics->where("id='$id'")->find();		
			return ;
		}
		/********分页函数********/	
		public function page(){
			$news=M('news');
			$count=$news->count();//总条数
			$mark=10;//每次返回的条目数
			//总页数
			if(($count%$mark)!=0)
				$pages=(int)($count/$mark)+1;
			else 
				$pages=$count/$mark;
			
				$first=$_GET['more']*$mark;//此次要查询的条目起始位置
				$last=$_GET['more'];
				$list=$news->order('lanchtime desc')->limit($first.','.$mark)->select();//$first为此页面的首个记录在总记录中的位置
				$num=$last*$mark+1;
			foreach($list as $example){
				$id=$example['id'];
				$dt=substr($example['lanchtime'], 0, 10);
				$News.='<div class="media_item J_pop"><span class="number">'.$num++.'. </span><a href=javascript:void(0) name='."$id".'>'.$example['title'].'</a><span class=dt>'.$dt.'</span><br></div>';
			}
			if($last==($pages-1)){//如果此次是最后一次（即以后没有数据了）
			//	$News.='<div class="newss"><a href=page?more='.($last+1).'>更多新闻</a></div>';	
				$News.='<div id="more" style="display:none;">0</div>';	
			}
			else
				$News.='<div id="more" style="display:none;">1</div>';
			echo $News;
		}
	}
?>
