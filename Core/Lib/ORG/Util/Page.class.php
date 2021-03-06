<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: Page.class.php 2207 2011-11-30 13:17:26Z liu21st $

class Page extends Think {
    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 默认列表每页显示行数
    protected $listRows = 20;
    // 起始行数
    protected $firstRow	;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页显示定制
    protected $config;

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     +----------------------------------------------------------
     */
    public function __construct($totalRows,$listRows='',$parameter='') {
    	
    	$this->config = array('header'=>L('records'),'prev'=>L('prev'),'next'=>L('next'),'first'=>L('first'),'last'=>L('last'),'theme'=>' %totalRow% %header% %nowPage%/%totalPage% '.L('page').' %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
    	
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        if(!empty($listRows)) {
            $this->listRows = intval($listRows);
        }
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($_GET[C('VAR_PAGE')])?intval($_GET[C('VAR_PAGE')]):1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    /**
     +----------------------------------------------------------
     * 分页显示输出
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        $p = C('VAR_PAGE');
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<a href='".$url."&".$p."=$upRow'>".$this->config['prev']."</a>";
        }else{
            $upPage="";
        }

        if ($downRow <= $this->totalPages){
            $downPage="<a href='".$url."&".$p."=$downRow'>".$this->config['next']."</a>";
        }else{
            $downPage="";
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a href='".$url."&".$p."=$preRow' >".L('front').$this->rollPage.L('page2')."</a>";
            $theFirst = "<a href='".$url."&".$p."=1' >".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='".$url."&".$p."=$nextRow' >".L('back').$this->rollPage.L('page2')."</a>";
            $theEnd = "<a href='".$url."&".$p."=$theEndRow' >".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "&nbsp;<a href='".$url."&".$p."=$page'>".$page."</a>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "&nbsp;<a href='#' class='current'>".$page."</a>";
                }
            }
        }
        $pageStr	 =	 str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

    /**
     +----------------------------------------------------------
     * 手机版--分页显示输出
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function m_show() {
        if(0 == $this->totalRows) return '';
        $p = C('VAR_PAGE');
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<a data-role='button' data-inline='true' href='".$url."&".$p."=$upRow'>".$this->config['prev']."</a>";
        }else{
            $upPage='<a data-role="button"  href="#">'.$this->config['prev'].'</a>';
        }

        if ($downRow <= $this->totalPages){
            $downPage="<a data-role='button' data-inline='true' href='".$url."&".$p."=$downRow'>".$this->config['next']."</a>";
        }else{
            $downPage='<a data-role="button"  href="#">'.$this->config['next'].'</a>';
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a href='".$url."&".$p."=$preRow' >".L('front').$this->rollPage.L('page2')."</a>";
            $theFirst = "<a href='".$url."&".$p."=1' >".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='".$url."&".$p."=$nextRow' >".L('back').$this->rollPage.L('page2')."</a>";
            $theEnd = "<a href='".$url."&".$p."=$theEndRow' >".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $selectPage  = '<label for="select-page" class="ui-hidden-accessible">More</label>';
        $selectPage .= '<select name="select-page" id="select-page">';
        $selectPage .= '<option value="">'.$this->nowPage.'/'.$this->totalPages.'</option>';
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    //$selectPage .= "&nbsp;<a href='".$url."&".$p."=$page'>".$page."</a>";
                    $selectPage .= '<option value="'.$page.'">第'.$page.'页</option>';
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    //$selectPage .= "&nbsp;<a href='#' class='current'>".$page."</a>";
                    $selectPage .= '<option value="'.$page.'">第'.$page.'页</option>';
                }
            }
        }
 
       //	$pageStr .= $upPage;
       // $pageStr .= $selectPage;  
       // $pageStr .= $downPage;
     
        $pageStr ='<fieldset data-role="controlgroup" data-type="horizontal" style="text-align:center;padding-top:10px;" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal" aria-disabled="false" data-disabled="false" data-shadow="false" data-corners="true" data-exclude-invisible="true" data-mini="false" data-init-selector=":jqmData(role=\'controlgroup\')"><div class="ui-controlgroup-controls">';

        $pageStr .='<a data-role="button" href="#" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" class="ui-btn ui-shadow ui-btn-corner-all ui-first-child ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">上一页</span></span></a>';
               
        $pageStr .='<label for="select-page" class="ui-hidden-accessible ui-select">More</label>';
        $pageStr .='<div class="ui-select"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-d" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-btn-icon-right"><span class="ui-btn-inner"><span class="ui-btn-text"><span>Select…</span></span><span class="ui-icon ui-icon-arrow-d ui-icon-shadow">&nbsp;</span></span>';
        $pageStr .='<select name="select-page" id="select-page">';
        $pageStr .='<option value="">Select…</option>';
        $pageStr .='<option value="#">One</option>';
        $pageStr .='    <option value="#">Two</option>';
        $pageStr .='    <option value="#">Three</option>';
        $pageStr .='</select></div></div>';
        $pageStr .='<a data-role="button" href="#" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" class="ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-last-child"><span class="ui-btn-inner"><span class="ui-btn-text">下一页</span></span></a>';
        
    $pageStr .='</div></fieldset>';
           
            
        return $pageStr;
    }
}
?>