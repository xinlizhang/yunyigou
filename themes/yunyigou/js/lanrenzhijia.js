
$(function(){
	var $left=$(".all-goods").hide();
	
	//$(".goods div h2 a").hover(function(){
		$left.show();
	//});
	//$(".all-goods").mouseleave(function() {
    //    $(".all-goods").hide();
    //});
	
	//商品分类
	$('.menu .item').hover(function(){
		$(this).addClass('active').find('s').hide();
		$(this).find('.product-wrap').show();
	},function(){
		$(this).removeClass('active').find('s').show();
		$(this).find('.product-wrap').hide();
	});
	});

