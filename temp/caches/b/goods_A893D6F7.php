<?php exit;?>a:3:{s:8:"template";a:11:{i:0;s:44:"/data/web/yunyigou/themes/yunyigou/goods.dwt";i:1;s:58:"/data/web/yunyigou/themes/yunyigou/library/page_header.lbi";i:2;s:56:"/data/web/yunyigou/themes/yunyigou/library/left_menu.lbi";i:3;s:54:"/data/web/yunyigou/themes/yunyigou/library/ur_here.lbi";i:4;s:60:"/data/web/yunyigou/themes/yunyigou/library/goods_gallery.lbi";i:5;s:60:"/data/web/yunyigou/themes/yunyigou/library/goods_related.lbi";i:6;s:54:"/data/web/yunyigou/themes/yunyigou/library/history.lbi";i:7;s:55:"/data/web/yunyigou/themes/yunyigou/library/comments.lbi";i:8;s:64:"/data/web/yunyigou/themes/yunyigou/library/bought_note_guide.lbi";i:9;s:59:"/data/web/yunyigou/themes/yunyigou/library/bought_goods.lbi";i:10;s:58:"/data/web/yunyigou/themes/yunyigou/library/page_footer.lbi";}s:7:"expires";i:1495591116;s:8:"maketime";i:1495587516;}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<title>茅台纪念酒_酒水茶叶_云易购商城</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/yunyigou/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/common.js"></script><script type="text/javascript" src="js/transportGoods.js"></script><script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("h2");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"h2bg");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}
</script>
</head>
<body>
<link href="themes/yunyigou/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/transport.js"></script><script type="text/javascript" src="js/utils.js"></script><script language='javascript' src='themes/yunyigou/js/jquery.min.js' type='text/javascript' charset='utf-8'></script>
<script language='javascript' src='themes/yunyigou/js/index.js' type='text/javascript' charset='utf-8'></script>
<script type="text/javascript">
var process_request = "正在处理您的请求...";
</script>
<div class="top1">
  <div class="content">
    <div class="left">554fcae493e564ee0dc75bdf2ebf94camember_info|a:1:{s:4:"name";s:11:"member_info";}554fcae493e564ee0dc75bdf2ebf94ca</div>
    <div class="right"></div>
  </div>  
</div>
<div style="clear:both"></div>
<div class="top2">
  <div class="content">
    <div class="left">
      <a href="index.php" alt="众方医药"><img src="themes/yunyigou/images1/index_4_03.png" style="margin-top:8px;"/></a>
    </div> 
    <div class="left">
      <div class="seach">
        <div class="seach_border">
        <form name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
            <input name="keywords" id="keyword" type="text" class="input-text" value="" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" placeholder="请输入您要搜索的商品关键字" x-webkit-grammar="builtin:search" _hover-ignore="1">
            <input name="imageField" type="submit" id="button" value="搜索" class="input-submit" style="cursor:pointer;"/>
            <a href="search.php?act=advanced_search" class="submit_a" >高级搜索</a>
        </form>
        </div>  
        <div class="hot_seach">热门搜索：<a href="search.php?keywords=%E7%94%B5%E5%99%A8">电器</a><a href="search.php?keywords=%E7%89%B9%E4%BA%A7">特产</a><a href="search.php?keywords=%E6%89%8B%E6%9C%BA">手机</a></div>      </div>
    </div> 
    <div class="right">
    	<div class="top-cart" onClick="location.href='flow.php'">
            554fcae493e564ee0dc75bdf2ebf94cacart_info|a:1:{s:4:"name";s:9:"cart_info";}554fcae493e564ee0dc75bdf2ebf94ca        </div>
      <img src="themes/yunyigou/images1/index_4_06.png" style="margin-top:12px;">
    </div>
  </div>  
</div>
<div style="clear:both"></div>
<div class="nav-wrap">
  <div class="nav">
    
    <ul class="nav-list cf">
      <li class="nav-all">所有商品分类</li>
      <li> <a href="index.php" class="on">首页</a> </li>
          </ul>
  </div>
</div>
<div style="clear:both"></div>
<script type="text/javascript">
    
    <!--
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
             alert("请输入搜索关键词！");
            return false;
        }
    }
    -->
    
</script>
<div id="left_menu" style="display:none; width:1200px; margin:0 auto;">
<div class="left-menu">
  <div class="menu">
  
      <div class="item">
      <div class="product">
        <h3><a style="background:url() no-repeat;" href="category.php?id=10">国内外特产</a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
                            <a href="category.php?id=11" target="_blank">建昌特产</a>
                            </li>
            </ul>
        </div>
      </div>
    </div>
      <div class="item">
      <div class="product">
        <h3><a style="background:url() no-repeat;" href="category.php?id=3">家用电器</a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
                            <a href="category.php?id=8" target="_blank">厨房电器</a>
                            <a href="category.php?id=9" target="_blank">清洁电器</a>
                            <a href="category.php?id=15" target="_blank">大家电</a>
                            </li>
            </ul>
        </div>
      </div>
    </div>
      <div class="item">
      <div class="product">
        <h3><a style="background:url() no-repeat;" href="category.php?id=12">手机数码</a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
                            </li>
            </ul>
        </div>
      </div>
    </div>
      <div class="item">
      <div class="product">
        <h3><a style="background:url() no-repeat;" href="category.php?id=13">酒水茶叶</a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
                            </li>
            </ul>
        </div>
      </div>
    </div>
      <div class="item">
      <div class="product">
        <h3><a style="background:url() no-repeat;" href="category.php?id=14">食品、酒类、茗茶</a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
                            </li>
            </ul>
        </div>
      </div>
    </div>
   
  
  </div>
</div>
</div>
<script type="text/javascript"> 
$(function(){
    $(".nav-all").hover(
	function(){
		$('#left_menu').show();
	},
	function(){
		$('#left_menu').hide();
	})
	$("#left_menu").hover(
	function(){
		$('#left_menu').show();
	},
	function(){
		$('#left_menu').hide();
	})
})
</script><div class="block box">
<div class="blank"></div>
 <div id="ur_here">
当前位置: <a href=".">首页</a> <code>&gt;</code> <a href="category.php?id=13">酒水茶叶</a> <code>&gt;</code> 茅台纪念酒 
</div>
</div>
<div class="blank"></div>
<div class="block clearfix">
  
   
   <div id="goodsInfo" class="clearfix">
   
     
     <div class="imgInfo">
     <a href="images/201705/goods_img/48_P_1495558460637.jpg" title="茅台纪念酒">
      <img src="images/201705/goods_img/48_G_1495558460659.jpg" id="big_img" alt="茅台纪念酒" width="363px;" height="363px"/>
     </a>
     <div class="blank5"></div>
           
      <div class="picture">
		<ul>
                           <li> 
                       
           <a href="javascript:void(0);">
        <img src="images/201705/goods_img/48_P_1495558460637.jpg" alt="茅台纪念酒" /></a>
                     </li>
                    </ul>   
</div>
 
<script type="text/javascript">
$(function(){
	$('.picture').find('a').mouseover(function(){
		
		var _src = $(this).find('img').attr('src');
		$('.imgInfo').find('#big_img').attr('src', _src);
        //$(this).parents('li:first').addClass('selected').siblings().removeClass('selected');
        
    });
});
</script>     
         
     
     </div>
     
     <div class="textInfo">
     <form action="javascript:addToCartGoods(48)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
      <li class="title">茅台纪念酒</li>
      <ul>
             
      <li class="clearfix">
       <dd>
              <strong>市场价格：</strong><font class="market">￥14.28元</font>
              </dd>
       </li>
       
              <li class="clearfix">
       <dd>
       <strong>商品总价：</strong><font id="ECS_GOODS_AMOUNT" class="shop"></font>
       </dd>
       </li>
            
            
      
      <li class="clearfix">
       <dd>
       <strong>用户评价：</strong>
      <img src="themes/yunyigou/images/stars5.gif" alt="comment rank 5" />
       </dd>
      </li>
      
      <li class="clearfix">
       <dd>
       <strong>累计售出：</strong>554fcae493e564ee0dc75bdf2ebf94cagoods_sells|a:2:{s:4:"name";s:11:"goods_sells";s:8:"goods_id";i:48;}554fcae493e564ee0dc75bdf2ebf94ca       </dd>
      </li>
      
      
            
      
             <li class="clearfix">
       <dd><strong>商品货号：</strong>YYG000048</dd>
       </li> 
               
                      <li class="clearfix">
       <dd>
       
       <strong>商品重量：</strong>1.000千克       
       </dd>
      </li>
        
             <li class="clearfix">
       <dd>
    
      <strong>上架时间：</strong>2017-05-24      
       </dd>
       </li>
              
            
                   <li class="clearfix">
       <dd>
       <strong>购买数量：</strong>
        <input name="number" type="text" id="number" value="1" size="4" onblur="changePrice()" style="border:1px solid #ccc; "/>
                         （当前库存40 ）
                      </dd>
       </li>
      
            
      <li class="padd">
      <a href="javascript:addToCartGoods(48)" style="float:left;"><img src="themes/yunyigou/images/add_cart.png" /></a>
      	<div class="collect">
        	<ul>
        	<li>              &nbsp;&nbsp;<a href="user.php?act=affiliate&goodsid=48">分享</a>
                           </li>
            <li><a href="javascript:collect(48)">收藏商品</a>554fcae493e564ee0dc75bdf2ebf94cagoods_collect|a:2:{s:4:"name";s:13:"goods_collect";s:8:"goods_id";i:48;}554fcae493e564ee0dc75bdf2ebf94ca</li>
            </ul>
        </div>
      </li>
     
      </ul>
      </form>
     </div>
   </div>
   <div class="blank"></div>
   
   
   <div style="margin-top:20px;">
		<div class="left-box">
        	<div class="box-public">
            	<ul class="box-pub-title">
                	<li>相关商品</li>
                </ul>
                            </div>
            
            <div class="box-public" style="margin-top:10px;">
            	<ul class="box-pub-title">
                	<li>浏览历史<a onclick="clear_history()">[清空]&nbsp;</a></li>
                </ul>
                	<div id='history_div'>
  <div class="boxCenterList clearfix" id='history_list'>
    554fcae493e564ee0dc75bdf2ebf94cahistory|a:1:{s:4:"name";s:7:"history";}554fcae493e564ee0dc75bdf2ebf94ca  </div>
 </div>
<div class="blank5"></div>
<script type="text/javascript">
if (document.getElementById('history_list').innerHTML.replace(/\s/g,'').length<1)
{
    document.getElementById('history_div').style.display='none';
}
else
{
    document.getElementById('history_div').style.display='block';
}
function clear_history()
{
Ajax.call('user.php', 'act=clear_history',clear_history_Response, 'GET', 'TEXT',1,1);
}
function clear_history_Response(res)
{
document.getElementById('history_list').innerHTML = '您已清空最近浏览过的商品';
}
</script>            </div>
        </div>
   	
   
     <div class="box">
     <div class="box_1">
      <h3 style="border-bottom:1px solid #e2e2e2">
        <div id="com_b" class="history clearfix">
        <h2>商品详情</h2>
        <h2 class="h2bg">商品评价</h2>
        <h2 class="h2bg">销售记录</h2>
        <h2 class="h2bg">购买咨询</h2>
                </div>
      </h3>
      <div id="com_v" class="boxCenterList RelaArticle"></div>
      <div id="com_h">
       <blockquote>
       <div class="box" style="margin:10px;">
        <p>&nbsp;<img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/3605e8ffd4d3481b9ac2d3dea54b3371.jpg" title="未标题-1.jpg" _src="/Storage/Shop/1/Products/790/Details/3605e8ffd4d3481b9ac2d3dea54b3371.jpg" style="font-family: 'microsoft yahei';" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/ed5ac963f35b4c2db9073b625cf2cd2e.JPG" title="DSC03126.JPG" _src="/Storage/Shop/1/Products/790/Details/ed5ac963f35b4c2db9073b625cf2cd2e.JPG" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/97fa582876ee458a9e4a710abae84f0a.png" title="1111.png" _src="/Storage/Shop/1/Products/790/Details/97fa582876ee458a9e4a710abae84f0a.png" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/363b070928aa45a8bfc5151808ce441a.JPG" title="DSC03118.JPG" _src="/Storage/Shop/1/Products/790/Details/363b070928aa45a8bfc5151808ce441a.JPG" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/37915ebc56d447fd8db854ac7eaa2efe.JPG" title="DSC03121.JPG" _src="/Storage/Shop/1/Products/790/Details/37915ebc56d447fd8db854ac7eaa2efe.JPG" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/bfa40f6d5f484e1e9576a842056da964.JPG" title="DSC03124.JPG" _src="/Storage/Shop/1/Products/790/Details/bfa40f6d5f484e1e9576a842056da964.JPG" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/f951a6d77a2b4c39b92aba09662544ba.JPG" title="DSC03128.JPG" _src="/Storage/Shop/1/Products/790/Details/f951a6d77a2b4c39b92aba09662544ba.JPG" alt="" /></p>
<p style="margin: 5px 0px; font-family: 'microsoft yahei';"><img src="http://www.yunyigou.com/Storage/Shop/1/Products/790/Details/6ad69c4f904b455cadc078f8547cb213.JPG" title="DSC03129.JPG" _src="/Storage/Shop/1/Products/790/Details/6ad69c4f904b455cadc078f8547cb213.JPG" alt="" /></p>
<div>&nbsp;</div>        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
              </table>
      </div>
       </blockquote>
     <blockquote>
     <div id="ECS_COMMENT"> 554fcae493e564ee0dc75bdf2ebf94cacomments|a:3:{s:4:"name";s:8:"comments";s:4:"type";i:0;s:2:"id";i:48;}554fcae493e564ee0dc75bdf2ebf94ca</div>
      
     </blockquote>
     
     <blockquote>
     <div id="ECS_BOUGHT">554fcae493e564ee0dc75bdf2ebf94cabought_notes|a:2:{s:4:"name";s:12:"bought_notes";s:2:"id";i:48;}554fcae493e564ee0dc75bdf2ebf94ca</div>     </blockquote>
     
     <blockquote>
     </blockquote>
     
      </div>
    </div>
    <script type="text/javascript">
    <!--
    reg("com");
    //-->
    </script>
  <div class="blank"></div>
  
  
 
  </div>
  
     </div>
  
</div>
<div style="background-color:#fff;">
 
<div id="bottomNav" class="box">
  <div class="bNavList clearfix">
              <a href="http://www.ehaier.com/?utm_source=baidu&utm_medium=shangchengbrand&utm_content=shangchengbrandzone&utm_campaign=wenzibiaoti&fc=u100051.c0.g0.k0.pb&utm_adgroup=pzoom"  target="_blank" >海尔官网</a>
                   |
                      <a href="http://www.konka.com/"  target="_blank" >康佳官网</a>
                   |
                      <a href="http://www.vivo.com.cn/"  target="_blank" >VIVO官网</a>
                   |
                      <a href="http://www.skyworth.com/"  target="_blank" >创维官网</a>
                   |
                      <a href="http://www.gionee.com/"  target="_blank" >金立官网</a>
                   
  </div>
 </div>
 <div class="blank"></div>
 <div class="block" style=" text-align:center">
<img src="themes/yunyigou/images/shuomin.gif"></div>
<div class="blank"></div>
<div id="footer" >
 <div class="text">
 &copy; 2014-2017 YUNYIGOU.COM 版权所有，并保留所有权利。 辽ICP备15003998号-1<br />
         Tel: 0429-7765555               <a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=3452252706（&amp;Site=云易购商城&amp;Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:3452252706（:4" height="16" border="0" alt="QQ" /> 3452252706（</a>
                        <a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=）1473158297&amp;Site=云易购商城&amp;Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:）1473158297:4" height="16" border="0" alt="QQ" /> ）1473158297</a>
                                                                                <br />
             
    <div class="blank"></div>
    
 </div>
</div>
</div>
<div class="side">
  <ul>
    <!--li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=403305367&amp;site=qq&amp;menu=yes"><img src="themes/yunyigou/images1/kefu.png"></a></li-->
    <li><a class="sidetop"><img src="themes/yunyigou/images1/index_4_162.png"></a></li>
  </ul>
</div>
<script type="text/javascript" charset="UTF-8" src="service/welive.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".menu .item:odd").addClass("itemF4");
}); 
</script>
<script src="themes/yunyigou/js/jquery.scrollToTop.min.js"></script>
<script type="text/javascript">
	$(function() {
		$(".sidetop").scrollToTop(1000);
	});		
</script></body>
<script type="text/javascript">
$(function() {
window.__Object_toJSONString = Object.prototype.toJSONString;
delete Object.prototype.toJSONString;
});
</script>
<script type="text/javascript">
var goods_id = 48;
var goodsattr_style = 1;
var gmt_end_time = 0;
var day = "天";
var hour = "小时";
var minute = "分钟";
var second = "秒";
var end = "结束";
var goodsId = 48;
var now_time = 1495558716;
onload = function(){
  changePrice();
  fixpng();
  try {onload_leftTime();}
  catch (e) {}
}
/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;
  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}
/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;
    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
	  
	if (document.getElementById('goods_promote_price'))
      document.getElementById('goods_promote_price').innerHTML = res.result;
  }
}
</script>
</html>
