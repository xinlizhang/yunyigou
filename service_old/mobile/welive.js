
var welive_auto=0.001,welive_ttt=0;

function $_$(id)
{
    return document.getElementById(id)
}

var welive_url=document.getElementsByTagName("script");
welive_url=welive_url[welive_url.length-1].src;
welive_url=welive_url.substring(0,welive_url.indexOf("mobile/welive.js"));

var welive_css=document.createElement("link");
welive_css.setAttribute("rel","stylesheet");
welive_css.setAttribute("href",welive_url+"mobile/welive.css");
document.getElementsByTagName("head")[0].appendChild(welive_css);

if(navigator.userAgent.toLowerCase().indexOf("msie")!=-1)
{
    var welive_lang=navigator.browserLanguage.toLowerCase()
}
else
{
    var welive_lang=navigator.language.toLowerCase()
}

var welive_chinese=(welive_lang=='zh-cn'||welive_lang=='zh-tw')?1:0;
var welive_c=
    '<div id="welive_online">'+
    '<div id="welive_info">'+(welive_chinese?'在线客服':'Online Support')+'</div>'+
    '<div id="welive_tg" title="'+(welive_chinese?'收拢':'Minimize')+'"></div>'+
    '<div id="welive_tg2" title="'+(welive_chinese?'点击在线咨询':'Chat with us')+'"><img src="'+welive_url+'public/img/ooo.gif"></div>'+'' +
    '</div>'+
    '<div id="welive_wrap">'+
        //'<div id="welive_drag"></div>'+
    '<div id="welive_mouse_tracker"></div>'+
    '<div id="welive_close"></div>'+
    '<div id="welive_close_btn"></div>'+
    '<div id="welive_iwrap">'+
    '<div id="welive_iholder">' +
    '<iframe id="welive_iframe" src="" frameborder="0" scrolling="no" allowTransparency="true"></iframe>' +
    '</div>'+
    '</div>'+
    '</div>';
document.write(welive_c);

var welive_opened=0,
    welive_loaded=0,
    welive_wrap=$_$("welive_wrap"),
    welive_close_btn=$_$("welive_close_btn"),
    welive_tg=$_$("welive_tg"),
    welive_tg2=$_$("welive_tg2"),
    welive_online=$_$("welive_online");

welive_wrap.onmouseover=function(){welive_close_btn.style.display="block"};
welive_wrap.onmouseout=function(){welive_close_btn.style.display="none"};
welive_tg.onmouseover=function(){this.className="welive_tghv"};
welive_tg.onmouseout=function(){this.className=""};
welive_tg.onclick=function()
{
    welive_online.className="welive_min"
};
welive_tg2.onmouseover=function()
{
    this.className="welive_tghv2"
};
welive_tg2.onmouseout=function()
{
    this.className=""
};
welive_tg2.onclick=function()
{
    if(welive_ttt)clearTimeout(welive_ttt);
    welive_opened=1;
    if(!welive_loaded)
    {
        welive_loaded=1;
        var url=window.location.href;
        $_$("welive_iframe").src=welive_url+"mobile/welive1618.php?a=321456978&r="+Math.random()+"&url="+url.replace(/&/g,"||4||")
    }
    welive_wrap.style.display="block";
    welive_online.style.display="none"
};

$_$("welive_info").onclick=function()
{
    welive_tg2.click()
};

welive_close_btn.onclick=function()
{
    welive_opened=0;
    welive_wrap.style.display="none";
    if(welive_online.className=="welive_min")
    {
        welive_online.className=''
    }
    welive_online.style.display="block"
};

if(welive_auto)welive_ttt=setTimeout(function(){welive_tg2.click()},welive_auto*1000);
