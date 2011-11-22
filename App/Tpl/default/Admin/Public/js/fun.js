$(document).ready(function(){	
	//sidebarÉìËõÐ§¹û
	$('.sb_click').click(function(){
		if($(this).next().is(":hidden")){
			$('.sb_u:visible').slideUp();
			$('.sb_click').prev().css({"background":"url(/cippus/App/Tpl/default/Admin/Public/img/options_default.png) no-repeat scroll  0 -10% transparent"});
			$(this).next().slideDown();
			$(this).prev().css({"background":"url(/cippus/App/Tpl/default/Admin/Public/img/options_default.png) no-repeat scroll  0 110% transparent"});
		}
		else {
			$(this).next().slideUp();	
			$(this).prev().css({"background":"url(/cippus/App/Tpl/default/Admin/Public/img/options_default.png) no-repeat scroll  0 -10% transparent"});
		}
	});	
	
	//È«Ñ¡
	$('.all').click(function(){
		$('.checkb:checkbox').attr('checked',true);
		});
		
	$('.n_all').click(function(){
		$('.checkb:checkbox').attr('checked',false);
		});

	//ÌáÐÑ
	$('.mn').click(function(){
		if($(this).next().is(":hidden")){
			$('.notice:visible').slideUp();
			$(this).next().slideDown();
		}
		else {
			$(this).next().slideUp();	
		}
	});		

	//日期输入
		$( "#datepicker" ).datetimepicker({  
		timeText: '时间',
		hourText: '小时',
		minuteText: '分钟',
		secondText: '秒',
		currentText: '现在',
		closeText: '完成',
		showSecond: true,
		timeFormat: 'hh:mm:ss'
	    });  
});
