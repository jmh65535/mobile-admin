<?php
/**
 *
 * 控制器
 * @author uclnn
 *
 */
class MessageAction extends HomeAction {

	function _initialize() {
		parent::_initialize ();
		/*if( $this->is_mobile==true ) {
			$maction = A("Home.Mobile");
			if( ACTION_NAME=='index' ) {
				$this->assign('headTitle','在线留言');
				$this->m_index();exit;
			} else if( ACTION_NAME=='show' ) {
				$this->m_show();exit;
			}
		}*/

		if (! method_exists ( $this, ACTION_NAME )) { // 没有定制方法
			$this->display ( 'index' );
			exit ();
		}
	}

	function m_index() {
		$this->display($this->mobile_theme.':Message:index');
	}
	
	function m_show() {
		$this->display($this->mobile_theme.':Message:show');
	}

}
?>