<?php get_header(); ?>

<!-- HERO -->
<section class="hero" id="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content">
      <span class="hero-location">Wrocław, Polska</span>
      <h1>Hair Evolution<em>Factory</em></h1>
      <p class="hero-sub">Fabryka przemysłowego farbowania włosów naturalnych.<br>Współpracujemy wyłącznie w modelu B2B.</p>
      <div class="hero-buttons">
        <a href="#calculator" class="btn btn-gold">Oblicz cenę</a>
        <a href="#about" class="btn btn-outline-light">O Fabryce</a>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="container">
    <div class="grid-2">
      <div class="about-text reveal">
        <span class="section-tag">O Fabryce</span>
        <h2 class="section-title">
          Nowoczesna fabryka<br>
          <span class="italic-gold">farbowania włosów</span>
        </h2>
        <p>Hair Evolution Factory to nowoczesna fabryka przemysłowego farbowania włosów naturalnych zlokalizowana we Wrocławiu. Specjalizujemy się w dostarczaniu zabarwionych pasm włosów dla salonów fryzjerskich, marek własnych i dystrybutorów hurtowych.</p>
        <p>Dzięki skali produkcji przemysłowej jesteśmy w stanie oferować stabilną jakość, powtarzalność koloru oraz konkurencyjne ceny nieosiągalne przy produkcji rzemieślniczej.</p>
        <div class="about-stats">
          <div class="about-stat">
            <strong>Własna fabryka</strong>
            <span>Bez pośredników</span>
          </div>
          <div class="about-stat">
            <strong>Eksport</strong>
            <span>Cała Europa</span>
          </div>
          <div class="about-stat">
            <strong>B2B Only</strong>
            <span>Wyłącznie hurtowo</span>
          </div>
        </div>
      </div>

      <div class="about-image-wrap reveal reveal-d2">
        <img
          class="about-image"
          src="https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg"
          alt="Włosy naturalne – Hair Evolution Factory"
          onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
        >
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
      <span class="section-tag">Rodzaje Włosów</span>
      <h2 class="section-title">
        Pochodzenie &amp; <span class="italic-gold">Charakterystyka</span>
      </h2>
      <p class="section-desc">Oferujemy włosy naturalne z 6 regionów świata — każde o unikalnych właściwościach strukturalnych i aplikacyjnych.</p>
    </div>

    <div class="accordion reveal reveal-d2">

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="true">
          <span class="accordion-flag">🇻🇳</span>
          <div class="accordion-label">
            <h3>Wietnam — Silky Straight</h3>
            <span class="hair-badge">Premium Styling Hair</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body open">
          <div class="accordion-desc">
            <p>Włosy wietnamskie wyróżniają się niezwykłą jedwabistością i naturalnym połyskiem. Są idealne do farbowania premium, precyzyjnego dopasowania koloru oraz technik ombre i balayage.</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Jedwabiste</span>
              <span class="accordion-tag">Naturalny połysk</span>
              <span class="accordion-tag">Cienka struktura</span>
              <span class="accordion-tag">Ombre / Balayage</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/wietnam-768x1024.jpg"
            alt="Włosy wietnamskie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇻🇳</div>'">
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="false">
          <span class="accordion-flag">🇮🇳</span>
          <div class="accordion-label">
            <h3>Indie — Fine Texture</h3>
            <span class="hair-badge">Slavic-Type Look</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body">
          <div class="accordion-desc">
            <p>Włosy indyjskie są jednymi z najbardziej miękkich i lekkich dostępnych na rynku. Ich delikatna struktura sprawia, że doskonale imitują włosy europejskie (słowiańskie).</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Najmiększe</span>
              <span class="accordion-tag">Słowiański wygląd</span>
              <span class="accordion-tag">Lekka struktura</span>
              <span class="accordion-tag">Łatwe w stylizacji</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/india-768x1024.jpg"
            alt="Włosy indyjskie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇮🇳</div>'">
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="false">
          <span class="accordion-flag">🇨🇳</span>
          <div class="accordion-label">
            <h3>Chiny — Strong Straight</h3>
            <span class="hair-badge">Smooth Finish</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body">
          <div class="accordion-desc">
            <p>Włosy chińskie są naturalnie proste i posiadają grubszą, bardziej zwartą włosinę. Cechują się bardzo wysoką wytrzymałością mechaniczną i doskonale trzymają kolor po farbowaniu.</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Gruba struktura</span>
              <span class="accordion-tag">Naturalnie proste</span>
              <span class="accordion-tag">Bardzo wytrzymałe</span>
              <span class="accordion-tag">Stabilny kolor</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/chiny-768x1024.jpg"
            alt="Włosy chińskie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇨🇳</div>'">
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="false">
          <span class="accordion-flag">🇮🇷</span>
          <div class="accordion-label">
            <h3>Iran — Power Curl</h3>
            <span class="hair-badge">Maximum Durability</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body">
          <div class="accordion-desc">
            <p>Włosy irańskie to jedne z najbardziej wytrzymałych włosów dostępnych na rynku. Cechuje je naturalna falistość lub kędzierzawość oraz bardzo wysoka gęstość.</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Najwytrzymalsze</span>
              <span class="accordion-tag">Naturalna kędzierzawość</span>
              <span class="accordion-tag">Bardzo gęste</span>
              <span class="accordion-tag">Rynek MENA</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/iran-768x1024.jpg"
            alt="Włosy irańskie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇮🇷</div>'">
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="false">
          <span class="accordion-flag">🇹🇷</span>
          <div class="accordion-label">
            <h3>Turcja — Dense Wave</h3>
            <span class="hair-badge">High Resistance</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body">
          <div class="accordion-desc">
            <p>Włosy tureckie są naturalnie falowane lub kręcone i posiadają bardzo gęstą strukturę. Charakteryzują się wysoką odpornością na zabiegi chemiczne.</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Naturalnie falowane</span>
              <span class="accordion-tag">Bardzo gęste</span>
              <span class="accordion-tag">Odporne chemicznie</span>
              <span class="accordion-tag">Segment premium</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/turcja-768x1024.jpg"
            alt="Włosy tureckie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇹🇷</div>'">
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-trigger" aria-expanded="false">
          <span class="accordion-flag">🇲🇲</span>
          <div class="accordion-label">
            <h3>Birma — Natural Straight</h3>
            <span class="hair-badge">Light Structure</span>
          </div>
          <span class="accordion-arrow">▾</span>
        </button>
        <div class="accordion-body">
          <div class="accordion-desc">
            <p>Włosy birmańskie są zbliżone strukturą do włosów chińskich, jednak zazwyczaj posiadają cieńszą włosinę i delikatniejszy połysk. Doskonale nadają się do produkcji peruk i przedłużeń.</p>
            <div class="accordion-tags">
              <span class="accordion-tag">Cienka włosina</span>
              <span class="accordion-tag">Naturalny wygląd</span>
              <span class="accordion-tag">Peruki / Przedłużenia</span>
              <span class="accordion-tag">Delikatny połysk</span>
            </div>
          </div>
          <img class="accordion-img"
            src="https://hairevolution.pl/wp-content/uploads/2026/03/IMG_9895-768x1024.jpg"
            alt="Włosy birmańskie"
            onerror="this.outerHTML='<div class=\'accordion-img-placeholder\'>🇲🇲</div>'">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- PRICE CALCULATOR -->
<section class="calculator" id="calculator">
  <div class="container">
    <div class="reveal" style="text-align:center; margin-bottom:36px;">
      <span class="section-tag">Kalkulator ceny</span>
      <h2 class="section-title">
        Oblicz <span class="italic-gold">orientacyjną cenę</span>
      </h2>
      <p class="section-desc" style="margin:0 auto;">Podaj parametry zamówienia, aby uzyskać szacunkową wycenę. Minimalne zamówienie: 1 kg.</p>
    </div>

    <div class="calc-box reveal reveal-d2">
      <div class="calc-grid">
        <div class="calc-group">
          <label for="calc-type">Rodzaj włosów</label>
          <div class="select-wrap">
            <select id="calc-type">
              <option value="">— wybierz —</option>
              <option value="wietnam">🇻🇳 Wietnam – Silky Straight</option>
              <option value="indie">🇮🇳 Indie – Fine Texture</option>
              <option value="chiny">🇨🇳 Chiny – Strong Straight</option>
              <option value="iran">🇮🇷 Iran – Power Curl</option>
              <option value="turcja">🇹🇷 Turcja – Dense Wave</option>
              <option value="birma">🇲🇲 Birma – Natural Straight</option>
            </select>
          </div>
        </div>
        <div class="calc-group">
          <label for="calc-length">Długość pasm</label>
          <div class="select-wrap">
            <select id="calc-length">
              <option value="">— wybierz —</option>
              <option value="20">20 cm</option>
              <option value="30">30 cm</option>
              <option value="40">40 cm</option>
              <option value="50">50 cm</option>
              <option value="60">60 cm</option>
              <option value="70">70 cm+</option>
            </select>
          </div>
        </div>
        <div class="calc-group">
          <label for="calc-weight">Waga zamówienia (kg)</label>
          <input type="number" id="calc-weight" min="1" step="0.5" placeholder="np. 5">
        </div>
        <div class="calc-group">
          <label>Minimalne zamówienie</label>
          <input type="text" value="1 kg / pozycja" readonly style="color:var(--text-3); cursor:default;">
        </div>
      </div>

      <div class="calc-result" id="calc-result">
        <p>Szacunkowa cena netto:</p>
        <div class="price" id="calc-price-net">—</div>
        <div class="price-note" id="calc-price-gross"></div>
        <div class="price-note" id="calc-loss" style="margin-top:8px; color:var(--text-2);"></div>
      </div>

      <div class="calc-btn-row">
        <button class="btn btn-gold" id="calc-btn">Oblicz cenę</button>
        <span class="calc-note">* Cena orientacyjna netto. Ostateczna oferta po kontakcie z naszym zespołem.</span>
      </div>

      <p style="margin-top:16px; font-size:12px; color:var(--text-3); font-style:italic;">
        Przemysłowy proces farbowania wiąże się z ubytkiem masy włosów na poziomie ok. 15%.
      </p>
    </div>
  </div>
</section>

<!-- CO WPŁYWA NA WYCENĘ -->
<section class="factors">
  <div class="container">
    <div class="reveal" style="text-align:center;">
      <span class="section-tag">Transparentna wycena</span>
      <h2 class="section-title" style="color:var(--white);">
        Co wpływa <span class="italic-gold">na wycenę</span>
      </h2>
      <p class="section-desc" style="margin:0 auto; color:rgba(255,255,255,0.4);">Każde zamówienie wyceniamy indywidualnie. Oto główne czynniki kształtujące cenę końcową.</p>
    </div>
    <div class="factors-grid reveal reveal-d2">
      <div class="factor-item">
        <span class="factor-icon">🌍</span>
        <h4>Pochodzenie włosów</h4>
        <p>Kraj i region pozyskania surowca</p>
      </div>
      <div class="factor-item">
        <span class="factor-icon">🔬</span>
        <h4>Jakość surowca</h4>
        <p>Grubość włosiny i stopień przetworzenia</p>
      </div>
      <div class="factor-item">
        <span class="factor-icon">📏</span>
        <h4>Długość pasm</h4>
        <p>Im dłuższe pasmo, tym wyższy koszt jednostkowy</p>
      </div>
      <div class="factor-item">
        <span class="factor-icon">⚖️</span>
        <h4>Ilość (waga)</h4>
        <p>Większe zamówienia = niższa cena/kg</p>
      </div>
      <div class="factor-item">
        <span class="factor-icon">🎨</span>
        <h4>Proces farbowania</h4>
        <p>Kolor docelowy, liczba etapów, technika</p>
      </div>
    </div>
  </div>
</section>

<!-- KONKURENCYJNA CENA -->
<section class="pricing">
  <div class="container">
    <div class="reveal" style="text-align:center; margin-bottom:12px;">
      <span class="section-tag">Nasza przewaga</span>
      <h2 class="section-title">
        Konkurencyjna cena <span class="italic-gold">bez kompromisów</span>
      </h2>
    </div>
    <div class="pricing-grid">
      <div class="pricing-card reveal reveal-d1">
        <div class="pricing-card-icon">🏭</div>
        <h4>Przemysłowa skala produkcji</h4>
        <p>Produkcja na skalę fabryczną pozwala nam obniżyć koszt jednostkowy o 30–50% w porównaniu z warsztatami rzemieślniczymi.</p>
      </div>
      <div class="pricing-card reveal reveal-d2">
        <div class="pricing-card-icon">🔗</div>
        <h4>Własna fabryka – brak pośredników</h4>
        <p>Jako właściciel fabryki jesteśmy pierwszym ogniwem łańcucha dostaw. Nie płacisz marży dystrybutora.</p>
      </div>
      <div class="pricing-card reveal reveal-d3">
        <div class="pricing-card-icon">📦</div>
        <h4>Bezpośredni zakup surowca</h4>
        <p>Pozyskujemy włosy bezpośrednio od dostawców w krajach pochodzenia, eliminując pośredników na każdym etapie.</p>
      </div>
      <div class="pricing-card reveal reveal-d1">
        <div class="pricing-card-icon">⚙️</div>
        <h4>Zoptymalizowany proces</h4>
        <p>Lata doświadczeń pozwoliły nam zoptymalizować każdy etap produkcji — od zamawiania surowca po pakowanie gotowych pasm.</p>
      </div>
      <div class="pricing-card reveal reveal-d2">
        <div class="pricing-card-icon">🎯</div>
        <h4>Stabilna powtarzalność koloru</h4>
        <p>Przemysłowe systemy mieszania barwników eliminują kosztowne błędy kolorystyczne.</p>
      </div>
      <div class="pricing-card reveal reveal-d3">
        <div class="pricing-card-icon">🤝</div>
        <h4>Indywidualne warunki B2B</h4>
        <p>Dla stałych partnerów oferujemy negocjowane ceny, wydłużone terminy płatności i priorytety produkcyjne.</p>
      </div>
    </div>
  </div>
</section>

<!-- DLACZEGO MY -->
<section class="why" id="why">
  <div class="container">
    <div class="grid-2" style="gap:56px;">
      <div class="reveal">
        <span class="section-tag">Dlaczego My</span>
        <h2 class="section-title">
          Dlaczego <span class="italic-gold">Hair Evolution Factory?</span>
        </h2>
        <p class="section-desc">Jesteśmy jedyną w Polsce fabryką specjalizującą się wyłącznie w przemysłowym farbowaniu włosów naturalnych na skalę hurtową.</p>
      </div>
      <div class="reveal reveal-d2">
        <div class="why-list">
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4>Doświadczenie i specjalizacja</h4>
              <p>Wieloletnie doświadczenie wyłącznie w segmencie hurtowego farbowania włosów naturalnych.</p>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4>Kontrola jakości na każdym etapie</h4>
              <p>Każda partia przechodzi wieloetapową kontrolę przed wysyłką.</p>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4>Stabilna powtarzalność koloru</h4>
              <p>Przemysłowe systemy dozowania barwników zapewniają identyczny kolor w każdej partii.</p>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4>Indywidualne zamówienia B2B</h4>
              <p>Realizujemy zamówienia szyte na miarę — niestandardowe kolory, własne opakowania (OEM).</p>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="why-text">
              <h4>Różnorodność rodzajów włosów</h4>
              <p>6 różnych origins włosów w jednym miejscu — jeden kontakt, jedno zamówienie.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
  <div class="container">
    <div class="stats-bar-grid">
      <div class="stat-bar-item">
        <span class="stat-bar-num">6</span>
        <span class="stat-bar-label">Rodzaje origins</span>
      </div>
      <div class="stat-bar-item">
        <span class="stat-bar-num">100%</span>
        <span class="stat-bar-label">Kontrola jakości</span>
      </div>
      <div class="stat-bar-item">
        <span class="stat-bar-num">±2</span>
        <span class="stat-bar-label">Tolerancja tonu koloru</span>
      </div>
      <div class="stat-bar-item">
        <span class="stat-bar-num">EU+</span>
        <span class="stat-bar-label">Eksport do Europy</span>
      </div>
    </div>
  </div>
</div>

<!-- CONTACT -->
<section class="contact" id="contact">
  <div class="container">
    <div class="contact-inner">
      <div class="reveal">
        <span class="section-tag">Kontakt</span>
        <h2 class="section-title">
          Formularz <span class="italic-gold">zapytania</span>
        </h2>
        <p>Współpracujemy wyłącznie z firmami w modelu B2B. Wypełnij formularz, a skontaktujemy się z Tobą w ciągu 24 godzin roboczych.</p>
        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-detail-icon">📍</div>
            <span>Wrocław, Polska</span>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">✉️</div>
            <a href="mailto:kontakt@hairevolutionfactory.pl">kontakt@hairevolutionfactory.pl</a>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">📞</div>
            <a href="tel:+48573568410">+48 573 568 410</a>
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
