<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="single-post">

  <div class="single-post-hero">
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="single-post-thumb">
        <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
        <div class="single-post-thumb-overlay"></div>
      </div>
    <?php endif; ?>
    <div class="container">
      <div class="single-post-header">
        <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="single-back">← Aktualności</a>
        <time class="news-card-date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
          <?php echo get_the_date('d.m.Y'); ?>
        </time>
        <h1 class="single-post-title"><?php the_title(); ?></h1>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="single-post-content">
      <div class="post-content">
        <?php the_content(); ?>
      </div>

      <div class="single-post-footer">
        <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="btn btn-gold">← Powrót do aktualności</a>
      </div>
    </div>
  </div>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>
