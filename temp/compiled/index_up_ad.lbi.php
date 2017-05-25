<?php if (! $_SESSION['user_id'] > 0): ?>
<script type="text/javascript" src="themes/yunyigou/js/jquery.leanModal.min.js" charset="utf-8"></script>
<script type="text/javascript" src="themes/yunyigou/js/jquery.cookie.js" charset="utf-8"></script>
<script type="text/javascript">
$(window).load(function (){ 
	if($.cookie("isClose") != 'yes'){
		$("#modaltrigger").click();
		$("#loginmodal .close").click(function(){
			$.cookie("isClose",'yes',{expires:1/24});
		});
	}
})
$(function(){ 
  　$('a[rel*=leanModal]').leanModal({top: 50, closeButton: ".modal_close"});
}) 
</script>

<a href="#loginmodal" class="qhdidian" id="modaltrigger" rel="leanModal"></a>
<div id="loginmodal" style="display:none;">
	<a class="close modal_close"></a>	
	<img src="themes/yunyigou/images1/index_ad.jpg" />
</div>
<style>
#lean_overlay{
	position:fixed;
	z-index:999;
	top:0px;
	left:0px;
	height:100%;
	width:100%;
	display:none;
	background-color:#000;
}
#loginmodal{
	width:1162px;
	height: 648px;
	padding:0px;
	background:#f3f6fa;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius:6px;
	-webkit-box-shadow:0 1px 5px rgba(0, 0, 0, 0.5);
	-moz-box-shadow:0 1px 5px rgba(0, 0, 0, 0.5);
	box-shadow:0 1px 5px rgba(0, 0, 0, 0.5);
}
.modal_close {background: url("themes/yunyigou/images1/ad_close.png") repeat scroll 0 0 transparent; display: block; height: 25px; position: absolute; right: 12px; top: 12px; width: 25px; z-index: 2;cursor:pointer;}
</style>
<?php endif; ?>