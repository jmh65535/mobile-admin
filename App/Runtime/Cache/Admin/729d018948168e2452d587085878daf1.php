<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__ADMIN__/Public/css/base.css" />
<script src="__ADMIN__/Public/js/jquery-1.7.1.min.js"></script>
<script src="__ADMIN__/Public/js/base.js"></script>
<script src="__ADMIN__/Public/js/97Date/WdatePicker.js"></script>
<script>
function Data(){
	this._APP_ = "__APP__";
	this.c_root = "<?php echo $c_root;?>";
	this.category_id = "<?php echo $obj['category_id'];?>";
	this.get_cid = "<?php echo $_GET['cid'];?>";
	this.get_id = "<?php echo $_GET['id'];?>";
	this.is_comment = "<?php echo $obj['is_comment'];?>";
	this.is_publish = "<?php echo $obj['is_publish'];?>";
	this.actionName = "<?php echo $actionName;?>";
}



</script>
 
<script src="__ADMIN__/Public/js/edit.js"></script>