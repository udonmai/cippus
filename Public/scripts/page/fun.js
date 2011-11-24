(function($) {
	$(document).ready(function() {
		//scrollTips.init();
		
		$.localScroll.defaults.axis = 'x';
		$.localScroll(); 
		
		$('#cloud2').pan({fps: 26, speed: 2, dir: 'left', depth: 70});
		$('#cloud1').pan({fps: 26, speed: 3, dir: 'left', depth: 30});
		$('#cloud1, #cloud2').spRelSpeed(8);
		
		$(window).scroll(function () {
			if($(window).scrollLeft() >= 1050)
				{
				$('#rocket a').fadeIn();
				//$('#building a').fadeIn();
				}
			if($(window).scrollLeft() < 1050)
				{
				$('#rocket a').fadeOut();
				//$('#building a').fadeOut();
				}
			});			

	//新闻ajax实现
	$('.J_pop').click(function(e){
		$('#waiting').fadeIn();
		var id = $(this).find('a').attr('name');

		$.ajax({
			type:"GET",
			url:"http://localhost/cippus/index.php/Home/Index/news?id="+id,
			dataType:"html",
			success:function(data, textStatus){
						$('#waiting').fadeOut();					
						$('#news_details_inner').html(data);
						$('#news_details').fadeIn();
						}		
			});
		e.stopPropagation();
		});

	$('#news_details_quit').click(function(){
		$('#news_details').fadeOut();
		});
	
	var more = $('#more').html();
	if(more == 1) $('#xzc').fadeIn();
		else $('#xzc').fadeOut();

	$('#xzc').click(function(e){
	var num = 0;
	var n = $('.media_item').length;
	num = n/10;
	$('#waiting').fadeIn();
		
		$.ajax({
			type:"GET",
			url:"http://localhost/cippus/index.php/Index/page?more="+num,
			dataType:"html",
			success:function(data, textStatus){
						$('#waiting').fadeOut();	
						$('#more').remove();
						var append = data;
						$('#xzc').before(append);
						
						var more = $('#more').html();
						if(more == 1) $('#xzc').fadeIn();
							else $('#xzc').fadeOut();
							
							$('.J_pop').click(function(e){
							$('#waiting').fadeIn();
							var id = $(this).find('a').attr('name');

							$.ajax({
								type:"GET",
								url:"http://locahost/cippus/index.php/Home/Index/news?id="+id,
								dataType:"html",
								success:function(data, textStatus){
									$('#waiting').fadeOut();					
									$('#news_details_inner').html(data);
									$('#news_details').fadeIn();
								}		
							});
							e.stopPropagation();
							});
						}		
						
						
			});
		e.stopPropagation();
		});
		
		change = function(){
			$('.ca-nav-next').click();
			setTimeout('change()',3000);		
		}
		setTimeout('change()',3000);		

	});
})(jQuery);

//滚轮监控
	
	//图片
	$('#ca-container').contentcarousel({
		// speed for the sliding animation
		sliderSpeed		: 500,
		// easing for the sliding animation
		sliderEasing	: 'easeOutExpo',
		// speed for the item animation (open / close)
		itemSpeed		: 500,
		// easing for the item animation (open / close)
		itemEasing		: 'easeOutExpo',
		// number of items to scroll at a time
		scroll			: 1
	});

