<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线留言</title>
<!-- layout::Inc:top::0 -->
<script type="text/javascript" src="__MOBILE__/js/jquery.form.js"></script>

</head>
<script>

//显示加载器  
function showLoader() {  
			var limg = '<img src="__MOBILE__/images/loaderc.gif" width="32" height="32"><span style="line-height:32px;float:right;">努力加载中,请稍候...</span>';    
		    var theme = 'd' || $.mobile.loader.prototype.options.theme,
			    msgText = '努力加载中...' || $.mobile.loader.prototype.options.text,
			    textVisible = false || $.mobile.loader.prototype.options.textVisible,
			    textonly = false;
			    html = limg;
				$.mobile.loading( "show", {
				             text: msgText,
				             textVisible: textVisible,
				             theme: theme,
				             textonly: textonly,
				             html: html
				});
}  
	  
//隐藏加载器.for jQuery Mobile 1.1.0  
function hideLoader() {  
	//隐藏加载器   
	$.mobile.loading( "hide" );
}

function fleshVerify(type){ 
	
	//重载验证码
	$('#verifymsg').attr('src','__APP__/Mobile/Message/verify');

}

function submessage(){
	if($('#title').val()==''){
		alert('请输入留言标题');
		return false;
	}
	if($('#email').val()==''){
		alert('请输入邮箱地址');
		return false;
	}else if($('#email').val()!=''){
		var emailReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; 
		if(!emailReg.test($('#email').val()) )
		{ 
			alert("邮箱格式不正确");
			$("#email").val('');				
			return false; 
		}
	}
	if($('#content').val()==''){
		alert('请输入留言内容');
		return false;
	}
	if($('#verify').val()==''){
		alert('请输入验证码');
		return false;
	}

	showLoader(); //显示加载器

	$('#msg_form').ajaxForm({
        dataType: 'text',
        url: '__APP__/Mobile/Message/save',
        success: function(data){
			hideLoader(); //隐藏加载器
			var res = eval("("+data+")");
			
            if(res.msg=='-1'){
				alert('验证码错误');
				return false;
				
            }else if(res.msg=='1'){
				
				$('#title').val('');
				$('#email').val('');
				
				$('#content').val('');
				$('#verify').val('');
				alert('留言提交成功');
				return true;
				
            }else if(res.msg=='-2'){
            	alert('留言提交失败');
            	return false;
            }
            
        }
    });

}
</script>
<body>
<div data-role="page" id="wrapper" class="jqm-demos">
<div data-role="header" id="tit">
	<a href="__APP__/Mobile" data-icon="back" class="tit_btn" rel="external">返回</a>
	<h1>在线留言</h1>
	<a href="__APP__/Mobile" data-icon="home" class="tit_btn" rel="external">首页</a>
</div>

<div data-role="content" style="background:#fff; border:none;" >
				<form action="" method="post" id="msg_form" data-ajax="false">
			        <div style="padding:10px 20px;">
			            
		              <label >标题:</label>
		              <input type="text" name="title" id="title"  value="" data-theme="c" data-clear-btn="true">
		              <label >您的电子邮件地址:</label>
			            <input type="email" name="email" id="email" value=""  data-theme="c" data-clear-btn="true">
                        <label >留言:</label>
			            <textarea name="content" id="content" cols="" rows=""data-theme="c" data-clear-btn="true"></textarea>
                        <label >验证码:</label>
			            <input type="text" name="verify" id="verify" value=""  data-theme="c" data-clear-btn="true">
                        <label >输入下图信息:</label>
                        <img id="verifymsg" src="__APP__/Mobile/Message/verify" onClick="fleshVerify('verifymsg')" border="0" width="58"  height="28" style="cursor:pointer" align="absmiddle"> 
                        
                      <input name="sub" type="submit"  class="tj_btn" value="发表留言" data-role="none" onclick="return submessage()"></div>
			    </form>

  
 </div>

<!-- layout::Inc:footer::0 -->



</div><!--page-->
</body>
</html>