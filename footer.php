  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
            <div class="nav-logo-icon">H</div>
            <div class="nav-logo-text"><?php bloginfo('name'); ?></div>
          </a>
          <p><?php bloginfo('description'); ?></p>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="Facebook">f</a>
            <a href="#" class="social-link" aria-label="Instagram">in</a>
            <a href="#" class="social-link" aria-label="WhatsApp">w</a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Điều hướng</h4>
          <ul class="footer-links">
            <li><a href="#about">Giới thiệu</a></li>
            <li><a href="#hair-types">Sản phẩm</a></li>
            <li><a href="#why-us">Tại sao chọn chúng tôi</a></li>
            <li><a href="#contact">Liên hệ</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Sản phẩm</h4>
          <ul class="footer-links">
            <li><a href="#hair-types">Tóc Việt Nam</a></li>
            <li><a href="#hair-types">Tóc Ấn Độ</a></li>
            <li><a href="#hair-types">Tóc Trung Quốc</a></li>
            <li><a href="#hair-types">Tóc Iran</a></li>
            <li><a href="#hair-types">Tóc Thổ Nhĩ Kỳ</a></li>
            <li><a href="#hair-types">Tóc Miến Điện</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Liên hệ</h4>
          <ul class="footer-links">
            <li><a href="mailto:<?php echo antispambot(get_option('admin_email')); ?>">📧 Email</a></li>
            <li><a href="#">📞 Điện thoại</a></li>
            <li><a href="#">📍 Địa chỉ</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        <p>WordPress Theme</p>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
