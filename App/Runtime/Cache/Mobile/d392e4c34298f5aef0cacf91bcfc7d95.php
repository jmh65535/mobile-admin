<?php if (!defined('THINK_PATH')) exit();?><div data-role="footer" data-theme="c" data-position="fixed">
  <div id="swt_bottom">
    <ul class="swt_bm">
      <li>
        <a href="tel:<?php echo ($system["telephone"]); ?>" rel="external"
          ><img
            src="__MOBILE__/images/icon3.png"
            width="30"
            height="30"
            alt=""
          />
          <p>打电话</p></a
        >
      </li>
      <li>
        <a href="__APP__/Mobile/About" rel="external"
          ><img
            src="__MOBILE__/images/icon4.png"
            width="30"
            height="30"
            alt=""
          />
          <p>关于我们</p></a
        >
      </li>
      <li>
        <a href="__APP__/Mobile/Contact" rel="external"
          ><img
            src="__MOBILE__/images/icon5.png"
            width="30"
            height="30"
            alt=""
          />
          <p>联系我们</p></a
        >
      </li>
      <li>
        <a href="__APP__/Mobile/Message" rel="external"
          ><img
            src="__MOBILE__/images/icon6.png"
            width="30"
            height="30"
            alt=""
          />
          <p>在线留言</p></a
        >
      </li>
    </ul>
  </div>
  <div id="foot">
    <p>
      <?php echo ($system["copyright"]); ?> 保留所有权利.技术支持-<a
        href="http://m.5izh.com"
        rel="external"
        style="color: #fff; text-decoration: none"
        target="_blank"
        >jmh</a
      >
    </p>
  </div>
</div>

<script src="__MOBILE__/jquery.mobile/jquery.mobile-1.3.2.js"></script>