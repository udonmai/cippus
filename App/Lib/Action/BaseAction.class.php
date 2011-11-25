<?php
	class BaseAction extends Action{
		protected $list=array();
		public function _initialize(){
			$list = include(DATA_PATH.'~menu.php');
			$this->assign('list',$list);
		}
		public function get_content($method){
			$content = M('others');
		}
		protected function _404($message = '',$jumpUrl = '',$waitSecond = 3){
			$this->assign('message','坑爹啊！访问的页面不存在！');
			if(!empty($jumpUrl)){
				$this->assign('jumpUrl',$jumpUrl);
				$this->assign('waitSecond',$waitSecond);
			}
			$this->display('/Public:success');
		}
	}
	/*	public function _empty(){
			$this->assign('message','非法操作!');
			$this->display('/Public:success');
		}*/
?>
