<?php if ($this->_var['promotion_goods']): ?>
<script >
var Tday = new Array();
var daysms = 24 * 60 * 60 * 1000
var hoursms = 60 * 60 * 1000
var Secondms = 60 * 1000
var microsecond = 1000
var DifferHour = -1
var DifferMinute = -1
var DifferSecond = -1
function clock(key)
  {
   var time = new Date()
   var hour = time.getHours()
   var minute = time.getMinutes()
   var second = time.getSeconds()
   var timevalue = ""+((hour > 12) ? hour-12:hour)
   timevalue +=((minute < 10) ? ":0":":")+minute
   timevalue +=((second < 10) ? ":0":":")+second
   timevalue +=((hour >12 ) ? " PM":" AM")
   var convertHour = DifferHour
   var convertMinute = DifferMinute
   var convertSecond = DifferSecond
   var Diffms = Tday[key].getTime() - time.getTime()
   DifferHour = Math.floor(Diffms / daysms)
   Diffms -= DifferHour * daysms
   DifferMinute = Math.floor(Diffms / hoursms)
   Diffms -= DifferMinute * hoursms
   DifferSecond = Math.floor(Diffms / Secondms)
   Diffms -= DifferSecond * Secondms
   var dSecs = Math.floor(Diffms / microsecond)
   
   if(convertHour != DifferHour) a="<font color=red>"+DifferHour+"</font>天";
   if(convertMinute != DifferMinute) b="<font color=red>"+DifferMinute+"</font>时";
   if(convertSecond != DifferSecond) c="<font color=red>"+DifferSecond+"</font>分"
     d="<font color=red>"+dSecs+"</font>秒"
     if (DifferHour>0) {a=a} 
     else {a=''}
   document.getElementById("leftTime"+key).innerHTML = a + b + c + d; //显示倒计时信息
  
  }
</script>



  <div class="promotion-goods">
    <div class="p-time">限时打折</div>
      <div class="promotion-focus">
          <ul>
           <?php $_from = $this->_var['promotion_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods_0_75557100_1495183065');$this->_foreach['promotion_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promotion_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods_0_75557100_1495183065']):
        $this->_foreach['promotion_foreach']['iteration']++;
?>
         <?php if (($this->_foreach['promotion_foreach']['iteration'] - 1) <= 3): ?>
            <li>
            <dd class="time-remain"><font class="f4" id="leftTime<?php echo $this->_var['key']; ?>"><?php echo $this->_var['lang']['please_waiting']; ?></font></dd>
              <a href="<?php echo $this->_var['goods_0_75557100_1495183065']['url']; ?>"><img src="<?php echo $this->_var['goods_0_75557100_1495183065']['thumb']; ?>" border="0" alt="<?php echo htmlspecialchars($this->_var['goods_0_75557100_1495183065']['name']); ?>"/></a>
              </br><?php echo $this->_var['lang']['promote_price']; ?><b><?php echo $this->_var['goods_0_75557100_1495183065']['promote_price']; ?></b>
              <p><a href="<?php echo $this->_var['goods_0_75557100_1495183065']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_75557100_1495183065']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods_0_75557100_1495183065']['short_name']); ?></a></p>
            </li>
          
          <?php endif; ?>
<script>
Tday[<?php echo $this->_var['key']; ?>] = new Date("<?php echo $this->_var['goods_0_75557100_1495183065']['gmt_end_time']; ?>");   
window.setInterval(function()     
{clock(<?php echo $this->_var['key']; ?>);}, 1000);     
</script>
         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </ul>
      </div>  
  </div>
     
<?php endif; ?>
</div>
<div style="clear:both;"></div>