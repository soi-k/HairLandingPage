<?php get_header(); ?>

<!-- HERO -->
<?php $hero_bg = hair_mod('hero_bg', 'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'); ?>
<section class="hero" id="hero">
  <div class="hero-bg" style="background-image:url('<?php echo esc_url($hero_bg); ?>');"></div>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content">
      <span class="hero-location"><?php echo esc_html(hair_mod('hero_location','Wrocław, Polska')); ?></span>
      <h1><?php echo esc_html(hair_mod('hero_title','Hair Evolution')); ?><em><?php echo esc_html(hair_mod('hero_subtitle','Factory')); ?></em></h1>
      <p class="hero-sub"><?php echo esc_html(hair_mod('hero_desc','Fabryka przemysłowego farbowania włosów naturalnych. Współpracujemy wyłącznie w modelu B2B.')); ?></p>
      <div class="hero-buttons">
        <?php $btn1_url = hair_mod('hero_btn1_url','') ?: '#about'; ?>
        <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-gold"><?php echo esc_html(hair_mod('hero_btn1','Aktualności')); ?></a>
        <a href="#about" class="btn btn-outline-light"><?php echo esc_html(hair_mod('hero_btn2','O Fabryce')); ?></a>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="container">
    <div class="grid-2">
      <div class="about-text reveal">
        <span class="section-tag"><?php echo esc_html(hair_mod('about_tag','O Fabryce')); ?></span>
        <h2 class="section-title">
          <?php echo esc_html(hair_mod('about_title','Nowoczesna fabryka')); ?><br>
          <span class="italic-gold"><?php echo esc_html(hair_mod('about_gold','farbowania włosów')); ?></span>
        </h2>
        <div class="mobile-collapsible">
          <p><?php echo esc_html(hair_mod('about_p1','Hair Evolution Factory to nowoczesna fabryka przemysłowego farbowania włosów naturalnych zlokalizowana we Wrocławiu.')); ?></p>
          <p><?php echo esc_html(hair_mod('about_p2','Dzięki skali produkcji przemysłowej jesteśmy w stanie oferować stabilną jakość, powtarzalność koloru oraz konkurencyjne ceny.')); ?></p>
        </div>
        <div class="about-stats">
          <div class="about-stat">
            <strong><?php echo esc_html(hair_mod('about_stat1_title','Własna fabryka')); ?></strong>
            <span><?php echo esc_html(hair_mod('about_stat1_sub','Bez pośredników')); ?></span>
          </div>
          <div class="about-stat">
            <strong><?php echo esc_html(hair_mod('about_stat2_title','Eksport')); ?></strong>
            <span><?php echo esc_html(hair_mod('about_stat2_sub','Cała Europa')); ?></span>
          </div>
          <div class="about-stat">
            <strong><?php echo esc_html(hair_mod('about_stat3_title','B2B Only')); ?></strong>
            <span><?php echo esc_html(hair_mod('about_stat3_sub','Wyłącznie hurtowo')); ?></span>
          </div>
        </div>
      </div>

      <div class="about-image-wrap reveal reveal-d2">
        <?php
        $about_img = hair_mod('about_img','https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg');
        $is_video  = (bool) preg_match('/\.(mp4|webm|ogg|mov|m4v)(\?.*)?$/i', $about_img);
        ?>
        <?php if ($is_video) : ?>
        <video
          class="about-image about-media-video"
          src="<?php echo esc_url($about_img); ?>"
          muted autoplay loop playsinline preload="metadata"
        ></video>
        <?php else : ?>
        <img
          class="about-image"
          src="<?php echo esc_url($about_img); ?>"
          alt="Włosy naturalne – Hair Evolution Factory"
          onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
        >
        <?php endif; ?>
        <div class="about-image-placeholder" style="display:none;">
          <span>Zdjęcie fabryki / włosów</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HAIR TYPES -->
<section class="hair-types" id="hair-types">
  <div class="container">
    <div class="reveal" style="max-width:640px; margin-bottom:40px;">
      <span class="section-tag"><?php echo esc_html(hair_mod('types_tag','Rodzaje Włosów')); ?></span>
      <h2 class="section-title">
        <?php echo esc_html(hair_mod('types_title','Typy &')); ?> <span class="italic-gold"><?php echo esc_html(hair_mod('types_gold','Charakterystyka')); ?></span>
      </h2>
      <p class="section-desc"><?php echo esc_html(hair_mod('types_desc','Oferujemy włosy naturalne w 4 głównych typach struktury — każdy o unikalnych właściwościach i zastosowaniach.')); ?></p>
    </div>

    <div class="hair-boxes">
      <?php
      $boxes = [
        1 => ['Włosy Proste',  'Silky & Strong Straight', 'Naturalne włosy proste dostępne w kilku wariantach grubości włosiny. Idealne do farbowania i tworzenia gładkich, lśniących przedłużeń.'],
        2 => ['Lekka Fala',    'Fine & Natural Wave',     'Delikatna, naturalna fala nadająca fryzurze objętości. Doskonała do technik ombre, balayage oraz lekkich stylizacji.'],
        3 => ['Gęsta Fala',    'Dense Wave & Volume',     'Gęste, falowane pasma o bogatej strukturze. Popularne na rynkach europejskich i premium, idealne do objętościowych stylizacji.'],
      ];
      foreach ($boxes as $n => $defaults) :
        $title    = hair_mod("box{$n}_title",    $defaults[0]);
        $subtitle = hair_mod("box{$n}_subtitle", $defaults[1]);
        $desc     = hair_mod("box{$n}_desc",     $defaults[2]);
      ?>
      <div class="hair-box reveal">
        <div class="hair-box-header">
          <div>
            <h3><?php echo esc_html($title); ?></h3>
            <span class="hair-badge"><?php echo esc_html($subtitle); ?></span>
          </div>
        </div>
        <p class="hair-box-desc"><?php echo esc_html($desc); ?></p>
        <div class="hair-carousel" data-carousel>
          <button class="car-btn car-prev" aria-label="Poprzednie">
            <span class="car-btn-icon">
              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7l6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </button>
          <div class="car-window">
            <div class="car-track">
              <?php hair_render_gallery("box{$n}_gallery"); ?>
            </div>
          </div>
          <button class="car-btn car-next" aria-label="Następne">
            <span class="car-btn-icon">
              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if (hair_mod('promo_enabled', '')) : ?>
<!-- PROMO SECTION -->
<section class="about promo-section" id="promo">
  <div class="container">
    <div class="grid-2">
      <div class="about-text reveal">
        <span class="section-tag"><?php echo esc_html(hair_mod('promo_tag', 'Nasza Oferta')); ?></span>
        <h2 class="section-title">
          <?php echo esc_html(hair_mod('promo_title', 'Włosy')); ?><br>
          <span class="italic-gold"><?php echo esc_html(hair_mod('promo_gold', 'z Wietnamu')); ?></span>
        </h2>
        <div class="mobile-collapsible">
          <p><?php echo esc_html(hair_mod('promo_p1', '')); ?></p>
          <?php $p2 = hair_mod('promo_p2', ''); if ($p2) : ?>
          <p><?php echo esc_html($p2); ?></p>
          <?php endif; ?>
        </div>
        <?php if (hair_mod('promo_stat1_title', '') || hair_mod('promo_stat2_title', '') || hair_mod('promo_stat3_title', '')) : ?>
        <div class="about-stats">
          <?php foreach ([1, 2, 3] as $i) :
            $t = hair_mod("promo_stat{$i}_title", '');
            $s = hair_mod("promo_stat{$i}_sub", '');
            if (!$t && !$s) continue; ?>
          <div class="about-stat">
            <strong><?php echo esc_html($t); ?></strong>
            <span><?php echo esc_html($s); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="about-image-wrap reveal reveal-d2">
        <?php
        $promo_media = hair_mod('promo_media', '');
        $is_promo_video = $promo_media && (bool) preg_match('/\.(mp4|webm|ogg|mov|m4v)(\?.*)?$/i', $promo_media);
        ?>
        <?php if ($is_promo_video) : ?>
        <video
          class="about-image about-media-video"
          src="<?php echo esc_url($promo_media); ?>"
          muted autoplay loop playsinline preload="metadata"
        ></video>
        <?php elseif ($promo_media) : ?>
        <img class="about-image" src="<?php echo esc_url($promo_media); ?>" alt="">
        <?php else : ?>
        <div class="about-image-placeholder"><span>Chọn ảnh / video trong Customizer</span></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CO WPŁYWA NA WYCENĘ -->
<section class="factors">
  <div class="container">
    <div class="reveal" style="text-align:center;">
      <span class="section-tag"><?php echo esc_html(hair_mod('factors_tag','Transparentna wycena')); ?></span>
      <h2 class="section-title" style="color:var(--white);">
        <?php echo esc_html(hair_mod('factors_title','Co wpływa')); ?> <span class="italic-gold"><?php echo esc_html(hair_mod('factors_gold','na wycenę')); ?></span>
      </h2>
      <p class="section-desc" style="margin:0 auto; color:rgba(255,255,255,0.4);"><?php echo esc_html(hair_mod('factors_desc','Każde zamówienie wyceniamy indywidualnie. Oto główne czynniki kształtujące cenę końcową.')); ?></p>
    </div>
    <div class="factors-grid reveal reveal-d2">
      <?php for ($i = 1; $i <= 5; $i++) : ?>
      <div class="factor-item">
        <span class="factor-icon"><?php echo esc_html(hair_mod("factor{$i}_icon", ['🌍','🔬','📏','⚖️','🎨'][$i-1])); ?></span>
        <h4><?php echo esc_html(hair_mod("factor{$i}_title", ['Pochodzenie włosów','Jakość surowca','Długość pasm','Ilość (waga)','Proces farbowania'][$i-1])); ?></h4>
        <p><?php echo esc_html(hair_mod("factor{$i}_desc", ['Kraj i region pozyskania surowca','Grubość włosiny i stopień przetworzenia','Im dłuższe pasmo, tym wyższy koszt jednostkowy','Większe zamówienia = niższa cena/kg','Kolor docelowy, liczba etapów, technika'][$i-1])); ?></p>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- KONKURENCYJNA CENA -->
<section class="pricing">
  <div class="container">
    <div class="reveal" style="text-align:center; margin-bottom:12px;">
      <span class="section-tag"><?php echo esc_html(hair_mod('pricing_tag','Nasza przewaga')); ?></span>
      <h2 class="section-title">
        <?php echo esc_html(hair_mod('pricing_title','Konkurencyjna cena')); ?> <span class="italic-gold"><?php echo esc_html(hair_mod('pricing_gold','bez kompromisów')); ?></span>
      </h2>
    </div>
    <div class="pricing-grid">
      <?php
      $card_defaults = [
        1 => ['🏭','Przemysłowa skala produkcji','Produkcja na skalę fabryczną pozwala nam obniżyć koszt jednostkowy o 30–50% w porównaniu z warsztatami rzemieślniczymi.'],
        2 => ['🔗','Własna fabryka – brak pośredników','Jako właściciel fabryki jesteśmy pierwszym ogniwem łańcucha dostaw. Nie płacisz marży dystrybutora.'],
        3 => ['📦','Bezpośredni zakup surowca','Pozyskujemy włosy bezpośrednio od dostawców w krajach pochodzenia, eliminując pośredników na każdym etapie.'],
        4 => ['⚙️','Zoptymalizowany proces','Lata doświadczeń pozwoliły nam zoptymalizować każdy etap produkcji — od zamawiania surowca po pakowanie gotowych pasm.'],
        5 => ['🎯','Stabilna powtarzalność koloru','Przemysłowe systemy mieszania barwników eliminują kosztowne błędy kolorystyczne.'],
        6 => ['🤝','Indywidualne warunki B2B','Dla stałych partnerów oferujemy negocjowane ceny, wydłużone terminy płatności i priorytety produkcyjne.'],
      ];
      $delays = ['reveal-d1','reveal-d2','reveal-d3','reveal-d1','reveal-d2','reveal-d3'];
      foreach ($card_defaults as $n => $d) : ?>
      <div class="pricing-card reveal <?php echo $delays[$n-1]; ?>">
        <div class="pricing-card-icon"><?php echo esc_html(hair_mod("card{$n}_icon", $d[0])); ?></div>
        <h4><?php echo esc_html(hair_mod("card{$n}_title", $d[1])); ?></h4>
        <p><?php echo esc_html(hair_mod("card{$n}_desc", $d[2])); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- DLACZEGO MY -->
<section class="why" id="why">
  <div class="container">
    <div class="grid-2" style="gap:56px;">
      <div class="reveal">
        <span class="section-tag"><?php echo esc_html(hair_mod('why_tag','Dlaczego My')); ?></span>
        <h2 class="section-title">
          <?php echo esc_html(hair_mod('why_title','Dlaczego')); ?> <span class="italic-gold"><?php echo esc_html(hair_mod('why_gold','Hair Evolution Factory?')); ?></span>
        </h2>
        <p class="section-desc"><?php echo esc_html(hair_mod('why_desc','Jesteśmy jedyną w Polsce fabryką specjalizującą się wyłącznie w przemysłowym farbowaniu włosów naturalnych na skalę hurtową.')); ?></p>
      </div>
      <div class="reveal reveal-d2">
        <div class="why-list">
          <?php
          $why_defaults = [
            1 => ['Doświadczenie i specjalizacja','Wieloletnie doświadczenie wyłącznie w segmencie hurtowego farbowania włosów naturalnych.'],
            2 => ['Kontrola jakości na każdym etapie','Każda partia przechodzi wieloetapową kontrolę przed wysyłką.'],
            3 => ['Stabilna powtarzalność koloru','Przemysłowe systemy dozowania barwników zapewniają identyczny kolor w każdej partii.'],
            4 => ['Indywidualne zamówienia B2B','Realizujemy zamówienia szyte na miarę — niestandardowe kolory, własne opakowania (OEM).'],
            5 => ['Różnorodność rodzajów włosów','6 różnych origins włosów w jednym miejscu — jeden kontakt, jedno zamówienie.'],
          ];
          foreach ($why_defaults as $n => $d) : ?>
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4><?php echo esc_html(hair_mod("why{$n}_title", $d[0])); ?></h4>
              <p><?php echo esc_html(hair_mod("why{$n}_desc", $d[1])); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<?php
$stat_defaults = [
  1 => ['6',    'Rodzaje origins'],
  2 => ['100%', 'Kontrola jakości'],
  3 => ['±2',   'Tolerancja tonu koloru'],
  4 => ['EU+',  'Eksport do Europy'],
];
?>
<div class="stats-bar">
  <div class="container">
    <div class="stats-bar-grid">
      <?php foreach ($stat_defaults as $n => $d) : ?>
      <div class="stat-bar-item">
        <span class="stat-bar-num"><?php echo esc_html(hair_mod("stat{$n}_num", $d[0])); ?></span>
        <span class="stat-bar-label"><?php echo esc_html(hair_mod("stat{$n}_label", $d[1])); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- CONTACT -->
<section class="contact" id="contact">
  <div class="container">
    <div class="contact-inner">
      <div class="reveal">
        <span class="section-tag"><?php echo esc_html(hair_mod('contact_tag','Kontakt')); ?></span>
        <h2 class="section-title">
          <?php echo esc_html(hair_mod('contact_title','Formularz')); ?> <span class="italic-gold"><?php echo esc_html(hair_mod('contact_gold','zapytania')); ?></span>
        </h2>
        <p><?php echo esc_html(hair_mod('contact_desc','Współpracujemy wyłącznie z firmami w modelu B2B. Wypełnij formularz, a skontaktujemy się z Tobą w ciągu 24 godzin roboczych.')); ?></p>
        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-detail-icon">📍</div>
            <span><?php echo esc_html(hair_mod('contact_city','Wrocław, Polska')); ?></span>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">✉️</div>
            <a href="mailto:<?php echo esc_attr(hair_mod('contact_email','kontakt@hairevolutionfactory.pl')); ?>"><?php echo esc_html(hair_mod('contact_email','kontakt@hairevolutionfactory.pl')); ?></a>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">📞</div>
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/','',(string)hair_mod('contact_phone','+48 573 568 410'))); ?>"><?php echo esc_html(hair_mod('contact_phone','+48 573 568 410')); ?></a>
          </div>
        </div>
      </div>

      <div class="reveal reveal-d2">
        <form class="contact-form" id="contactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <?php wp_nonce_field('hair_contact_form', 'hair_nonce'); ?>
          <input type="hidden" name="action" value="hair_contact">
          <div class="form-row">
            <div class="form-group">
              <label for="f-name">Imię / Firma *</label>
              <input type="text" id="f-name" name="name" placeholder="Nazwa firmy lub imię" required>
            </div>
            <div class="form-group">
              <label for="f-email">E-mail *</label>
              <input type="email" id="f-email" name="email" placeholder="twoj@email.pl" required>
            </div>
          </div>
          <div class="form-group">
            <label for="f-phone">Telefon</label>
            <input type="tel" id="f-phone" name="phone" placeholder="+48 xxx xxx xxx">
          </div>
          <div class="form-group">
            <label for="f-msg">Wiadomość *</label>
            <textarea id="f-msg" name="message" placeholder="Opisz swoje zapotrzebowanie: rodzaj włosów, ilość, długość, kolor docelowy..." required></textarea>
          </div>
          <label class="form-check">
            <input type="checkbox" required>
            <span>Akceptuję <a href="#">politykę prywatności</a> i wyrażam zgodę na kontakt w sprawie oferty.</span>
          </label>
          <button type="submit" class="btn btn-gold form-submit">Wyślij zapytanie</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
