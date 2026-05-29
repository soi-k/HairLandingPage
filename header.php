<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <div class="nav-logo-icon">H</div>
          <div class="nav-logo-text"><?php bloginfo('name'); ?></div>
        <?php endif; ?>
      </a>

      <ul class="nav-menu" id="navMenu">
        <li><a href="#about">Giới thiệu</a></li>
        <li><a href="#hair-types">Sản phẩm</a></li>
        <li><a href="#why-us">Tại sao chọn chúng tôi</a></li>
        <li><a href="#contact" class="nav-cta">Liên hệ ngay</a></li>
      </ul>

      <button class="hamburger" id="hamburger" aria-label="Mở menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
</nav>
