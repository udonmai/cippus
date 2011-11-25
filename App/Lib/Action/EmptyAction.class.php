<?php
	class EmptyAction extends Action{
		public function _empty(){
			echo "坑爹啊!您访问的也页面不存在!";
			echo "阿德斯";
		//	$this->assign('message','坑爹啊!您访问的页面不存在!');
		//	$this->assign('jumpUrl','Home/Index/index');
		//	$this->assign('waitSecond','3');
		//	$this->display('/public:success');
		}
	}
?>
