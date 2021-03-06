<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>编辑内容</title>
        <link rel="stylesheet" type="text/css" href="__ADMIN__/Public/css/base.css" />
        <script src="__ADMIN__/Public/js/jquery-1.7.1.min.js">
        </script>
        <script src="__ADMIN__/Public/js/base.js">
        </script>
        <script src="__ADMIN__/Public/js/97Date/WdatePicker.js">
        </script>
        <!-- layout::Inc:ueditor::0 -->
        <script>
            $(function(){
            
                if ("<?php echo $obj['id'];?>" == '') {
                    $("input[name=is_publish]").attr("checked", true);
                }
                else {
                    $("input[name=is_comment][value=<?php echo $obj['is_comment'];?>]").attr("checked", true);
                    $("input[name=is_publish][value=<?php echo $obj['is_publish'];?>]").attr("checked", true);
                }
                
                $("input[name=lang][value=<?php echo $_GET['lang'];?>]").attr("checked", true);
				$("input[name=mode][value=<?php echo $_GET['lang'];?>]").attr("checked", true);
                
                $("input[name=lang]").click(function(){
                    window.location.href = '__APP__/Admin/<?php echo $actionName;?>/index/lang/' + $(this).val() + '/cid/<?php echo $_GET["cid"];?>';
                });
                
                //展开表单元素
                $('#more_home').change(function(){
                    if ($(this).is(':checked')) {
                        $('#more_options_box').show();
                    }
                    else {
                        $('#more_options_box').hide();
                    }
                });
                
                $('#more_seo').change(function(){
                    if ($(this).is(':checked')) {
                        $('#more_seo_box').show();
                    }
                    else {
                        $('#more_seo_box').hide();
                    }
                });
                
                if ($('#summary').val() != '' || $('#imagefile').val()!= '') {
                    $('#more_home').attr('checked', true);
                    $('#more_home').trigger('change');
                }
                
                if ($('#seo_title').val() != '' || $('#seo_keywords').val() != '' || $('#seo_description').val() != '') {
                    $('#more_seo').attr('checked', true);
                    $('#more_seo').trigger('change');
                }
                
                $('#delete_image').click(function(){
                    if (confirm('确定要删除封面吗？')) {
                        $.get('__APP__/Admin/News/deleteImage', {
                            'id': "<?php echo $obj['id']; ?>"
                        }, function(bool){
                            if (bool == 1) {
                                $('#span_image').css('display', 'none');
                            }
                        });
                    }
                });
				
				$('input[name=mode]').click(function(){
					window.location.href = '__APP__/Admin/<?php echo $actionName;?>/index/lang/' + $(this).val() + '/cid/<?php echo $_GET["cid"];?>';
				});
                
            });
            
            //手机同步
            function synchMobile(id){
                if (confirm('同步后会覆盖手机数据，确定吗？')) 
                    window.location.href = '__APP__/Admin/News/synchMobile/id/' + id;
            }
        </script>
    </head>
    <body>
        <div class="nav-site">
            <?php getNavSite($c_root,$_GET['cid']);?> > 编辑内容
        </div>
        <form action="__APP__/Admin/<?php echo $actionName;?>/saveOne/cid/<?php echo ($_GET['cid']); ?>" method="post" enctype="multipart/form-data" class="form">
            <input type="hidden" name="id" value="<?php echo ($obj["id"]); ?>">
			
			<input type="hidden" name="category_id" value="<?php echo ($obj["category_id"]); ?>">
            <fieldset>
                <ul class="align-list">
                    
                    <li>
                        <label>
                            标题
                        </label>
                        <input type="text" id="title" name="title" value="<?php echo ($obj["title"]); ?>" class="type-text">
                    </li>
                    <li>
                        <label>
                            内容详细
                        </label>
                        <textarea id="content" name="content" style="margin-left:200px;margin-left:140px;margin-top:-25px;margin-bottom:10px;width:890px;"><?php echo (htmlspecialchars_decode($obj["content"])); ?></textarea>
						<br/>		     
						<script type="text/javascript">
							var editor_a = new baidu.editor.ui.Editor();		
							//渲染编辑器		        
							editor_a.render('content');		        
						</script>
                    </li>
                    <li>
                        <hr>
                        <div class="more-title">
                            <input type="checkbox" id="more_home">首页设置
                        </div>
                    </li>
                    <div id="more_options_box" class="more-box hide">
                        <li>
                            <label>
                                内容摘要
                            </label>
                            <textarea id="summary" name="summary" cols="100" rows="3"><?php echo ($obj["summary"]); ?></textarea>
                        </li>
                        <li>
                            <label>
                                封面
                            </label>
                            <?php if( !empty($obj['image']) ) { ?>
                            <span id="span_image"><img alt="" align="middle" height="80" vspace="5" src="<?php echo __PUBLIC__.'/data/upload/images/news/s_'.$obj['image']; ?>"><a href="javascript:void(0)" id="delete_image" style="color:red;text-decoration:underline;">删除封面</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <?php } ?>
							<input id="imagefile" type="hidden" value="<?=$obj['image']?>">
                            <input type="file" name="image">宽：<input name="imgwidth" value="300" style="width:50px;">&nbsp;&nbsp;
                            高：<input name="imgheight" value="300" style="width:50px;"><span style="color:#999;">(列表显示尺寸)</span>
                        </li>
                    </div>
                     <?php if(!empty($obj['seo_title']) || !empty($obj['seo_keywords']) || !empty($obj['seo_description'])){ $seo_loop= true; }else{ $seo_loop=false; } ?>
                    <li>
                        <div class="more-title">
                            <input type="checkbox" id="more_seo" <?php if($seo_loop==true){ echo 'checked'; } ?> >推广信息(SEO)
                        </div>
                    </li>
                    <div id="more_seo_box" <?php if($seo_loop==true){ echo 'class="more-box"'; }else{ echo 'class="more-box hide"'; } ?>>
                        <li>
                            <label>
                                页面标题
                                <br>
                                (Title)
                            </label>
                            <input type="text" id="seo_title" name="seo_title" value="<?php echo ($obj["seo_title"]); ?>" class="type-text">
                        </li>
                        <li>
                            <label>
                                页面关键字
                                <br>
                                (Keywords)
                            </label>
                            <input type="text" id="seo_keywords" name="seo_keywords" value="<?php echo ($obj["seo_keywords"]); ?>" class="type-text">
                        </li>
                        <li>
                            <label>
                                页面描述
                                <br>
                                (Description)
                            </label>
                            <input type="text" id="seo_description" name="seo_description" value="<?php echo ($obj["seo_description"]); ?>" class="type-text">
                        </li>
                    </div>
					
					
                    <li>
                        <label>
                            现在发布<a href="#" class="issue" title="在网站前台显示">?</a>
                        </label>
                        <input type="checkbox" id="is_publish" name="is_publish" value="1">
                    </li>
                    <li>
                        <label>
                        </label>
                        <input type="submit" value="确定并保存" class="button button-green" /><input type="reset" value="重置" class="button button-red" />
                    </li>
                </ul>
            </fieldset>
        </form>
    </body>
</html>