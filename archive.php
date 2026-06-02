<?php get_header(); ?>

<section class="news-hero">
  <div class="container">
    <span class="section-tag">Blog</span>
    <h1 class="section-title">Aktualności</h1>
    <p class="news-hero-sub">Najnowsze informacje z Hair Evolution Factory</p>
  </div>
</section>

<section class="news-list">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <div class="news-grid">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="news-card reveal">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" class="news-card-thumb">
                <?php the_post_thumbnail('medium_large', ['alt' => get_the_title()]); ?>
              </a>
            <?php endif; ?>
            <div class="news-card-body">
              <time class="news-card-date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                <?php echo get_the_date('d.m.Y'); ?>
              </time>
              <h2 class="news-card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <p class="news-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '…'); ?></p>
              <a href="<?php the_permalink(); ?>" class="news-card-link">Czytaj więcej →</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="news-pagination">
        <?php
        the_posts_pagination([
          'prev_text' => '← Nowsze',
          'next_text' => 'Starsze →',
          'mid_size'  => 2,
        ]);
        ?>
      </div>

    <?php else : ?>
      <div class="news-empty">
        <p>Brak aktualności. Wróć wkrótce.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-gold">← Powrót do strony głównej</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
