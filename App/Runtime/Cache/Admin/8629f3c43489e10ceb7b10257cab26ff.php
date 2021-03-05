<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>网站信息设置</title>

<link rel="stylesheet" type="text/css" href="__ADMIN__/Public/css/base.css" />
<script src="__ADMIN__/Public/js/jquery-1.7.1.min.js"></script>
<script src="__ADMIN__/Public/js/base.js"></script>

<script>

</script>

</head>
<body>
<div class="nav-site"><?php getNavSite($c_root,$_GET['cid']);?></div>
<form action="__APP__/Admin/System/saveSetting" method="post" class="form">   
  <input type="hidden" name="id" value="<?php echo ($system["id"]); ?>">     
   <fieldset>
       <ul class="align-list">
       	
           <li>
               <label>公司名称</label>
               <input type="text" id="company" name="company" value="<?php echo ($system["company"]); ?>" class="type-text">
           </li>
            <li>
               <label>联系人</label>
               <input type="text" id="linkman" name="linkman" value="<?php echo ($system["linkman"]); ?>" class="type-text">
           </li>
           <li>
               <label>联系电话</label>
               <input type="text" id="telephone" name="telephone" value="<?php echo ($system["telephone"]); ?>" class="type-text">
           </li>
           <li>
               <label>传真</label>
               <input type="text" id="fax" name="fax" value="<?php echo ($system["fax"]); ?>" class="type-text">
           </li>
           <li>
               <label>联系地址</label>
               <input type="text" id="address" name="address" value="<?php echo ($system["address"]); ?>" class="type-text">
           </li>
           <li>
               <label>邮政编码</label>
               <input type="text" id="postcode" name="postcode" value="<?php echo ($system["postcode"]); ?>" class="type-text">
           </li>
           <li>
               <label>邮箱地址</label>
               <input type="text" id="email" name="email" value="<?php echo ($system["email"]); ?>" class="type-text">
           </li>
           <li>
               <label>网站名称</label>
               <input type="text" id="website" name="website" value="<?php echo ($system["website"]); ?>" class="type-text">
           </li>
           <li>
               <label>网站域名</label>
               <input type="text" id="domain" name="domain" value="<?php echo ($system["domain"]); ?>" class="type-text">
           </li>
           <li>
               <label>ICP备案号</label>
               <input type="text" id="icpnumber" name="icpnumber" value="<?php echo ($system["icpnumber"]); ?>" class="type-text">
           </li>
           <li>
               <label>网站版权</label>
               <input type="text" id="copyright" name="copyright" value="<?php echo ($system["copyright"]); ?>" class="type-text">
           </li>
		   
           <li>
               <label></label>
               <input type="submit" value="确定并保存" class="button button-green" />
               <input type="reset" value="重置" class="button button-red" />
            </li>
        </ul>
    </fieldset>
</form>

</body>
</html>