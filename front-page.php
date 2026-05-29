<?php get_header(); ?>

<!-- HERO -->
<section class="hero" id="hero">
  <div class="container">
    <div class="hero-content">
      <span class="hero-badge">Nhà cung cấp B2B chính thống</span>
      <h1>Tóc Thật Nguyên Liệu<br><span class="gold">Trực Tiếp Từ Nhà Máy</span></h1>
      <p>Chúng tôi chuyên cung cấp tóc thật chất lượng cao cho salon, thương hiệu và nhà phân phối toàn cầu. Không qua trung gian – giá tốt nhất, chất lượng ổn định, nguồn gốc rõ ràng.</p>
      <div class="hero-buttons">
        <a href="#contact" class="btn btn-gold">Nhận báo giá ngay</a>
        <a href="#hair-types" class="btn btn-outline">Xem sản phẩm</a>
      </div>
    </div>
  </div>
  <div class="hero-scroll">Cuộn xuống</div>
</section>

<!-- STATS -->
<section class="stats">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <span class="stat-number">10+</span>
        <span class="stat-label">Năm kinh nghiệm</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">500+</span>
        <span class="stat-label">Đối tác B2B</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">50+</span>
        <span class="stat-label">Quốc gia xuất khẩu</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">100%</span>
        <span class="stat-label">Tóc thật tự nhiên</span>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="container">
    <div class="grid-2">
      <div class="about-image-wrap reveal">
        <div class="about-image">
          <div class="about-image-icon">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('large'); ?>
            <?php else : ?>
              <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#c9a55a" stroke-width="1.5">
                <path d="M32 8 C20 8 12 18 12 28 C12 40 20 50 32 56 C44 50 52 40 52 28 C52 18 44 8 32 8Z" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24 28 Q28 20 32 28 Q36 36 40 28" stroke-linecap="round"/>
                <path d="M20 34 Q26 26 32 34 Q38 42 44 34" stroke-linecap="round"/>
                <circle cx="32" cy="20" r="4"/>
              </svg>
              <p>Ảnh nhà máy của bạn</p>
            <?php endif; ?>
          </div>
        </div>
        <div class="about-badge">
          <strong>10+</strong>
          <span>Năm<br>kinh nghiệm</span>
        </div>
      </div>

      <div class="about-content reveal reveal-delay-2">
        <span class="section-label">Về chúng tôi</span>
        <h2 class="section-title">Nhà Máy Sản Xuất<br><span>Tóc Chuyên Nghiệp</span></h2>
        <p class="section-desc">Chúng tôi là nhà máy sản xuất và cung cấp tóc thật hàng đầu, chuyên phục vụ mô hình B2B. Với dây chuyền sản xuất hiện đại, chúng tôi đảm bảo chất lượng ổn định, màu sắc nhất quán trên từng lô hàng.</p>
        <div class="about-features">
          <div class="about-feature">
            <div class="about-feature-icon">🏭</div>
            <div class="about-feature-text">
              <h4>Sở hữu nhà máy riêng</h4>
              <p>Không qua trung gian, giá thành thấp hơn 30-40% so với thị trường.</p>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">🎨</div>
            <div class="about-feature-text">
              <h4>Màu sắc ổn định, tái lặp được</h4>
              <p>Công nghệ nhuộm tóc công nghiệp đảm bảo đồng đều màu sắc trên mỗi lô.</p>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">✈️</div>
            <div class="about-feature-text">
              <h4>Giao hàng toàn cầu</h4>
              <p>Xuất khẩu sang hơn 50 quốc gia, đóng gói chuyên nghiệp, giao đúng hạn.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HAIR TYPES -->
<section class="hair-types" id="hair-types">
  <div class="container">
    <div class="section-header center reveal">
      <span class="section-label">Danh mục sản phẩm</span>
      <h2 class="section-title">Các Loại Tóc<br><span>Chúng Tôi Cung Cấp</span></h2>
      <p class="section-desc">Chúng tôi cung cấp đa dạng các loại tóc từ nhiều nguồn gốc khác nhau, phù hợp với mọi nhu cầu sản xuất và kinh doanh.</p>
    </div>
    <div class="hair-grid">
      <?php
      $hair_types = [
        ['flag'=>'🇻🇳 Việt Nam','name'=>'Tóc Việt Nam','type'=>'Silky Straight','badge'=>'Bán chạy #1','desc'=>'Tóc mềm mại, óng ả, độ bền cao. Phù hợp với các sản phẩm cao cấp.','tags'=>['Thẳng tự nhiên','Mềm mịn','Độ bóng cao','Bền màu']],
        ['flag'=>'🇮🇳 Ấn Độ','name'=>'Tóc Ấn Độ','type'=>'Fine Texture','badge'=>'','desc'=>'Kết cấu mảnh, nhẹ, phù hợp làm tóc giả và extension cao cấp.','tags'=>['Sóng nhẹ','Kết cấu mịn','Dễ tạo kiểu','Phổ biến']],
        ['flag'=>'🇨🇳 Trung Quốc','name'=>'Tóc Trung Quốc','type'=>'Strong Straight','badge'=>'','desc'=>'Sợi tóc dày, cứng, rất bền. Lý tưởng cho sản phẩm cần độ chịu lực cao.','tags'=>['Thẳng cứng','Sợi dày','Siêu bền','Đen tự nhiên']],
        ['flag'=>'🇮🇷 Iran','name'=>'Tóc Iran','type'=>'Power Curl','badge'=>'','desc'=>'Xoăn mạnh tự nhiên, đặc và dày. Rất được ưa chuộng tại thị trường châu Phi.','tags'=>['Xoăn tự nhiên','Dày dặn','Afro style','Giữ kiểu tốt']],
        ['flag'=>'🇹🇷 Thổ Nhĩ Kỳ','name'=>'Tóc Thổ Nhĩ Kỳ','type'=>'Dense Wave','badge'=>'','desc'=>'Sóng dày, phong phú, kết cấu đặc biệt. Lý tưởng cho sản phẩm cao cấp.','tags'=>['Sóng dày','Bồng bềnh','Cao cấp','Thị trường EU']],
        ['flag'=>'🇲🇲 Miến Điện','name'=>'Tóc Miến Điện','type'=>'Natural Straight','badge'=>'','desc'=>'Thẳng tự nhiên hoàn toàn, mềm như lụa, chưa qua xử lý hóa học.','tags'=>['Virgin hair','Chưa xử lý','Mềm như lụa','Thuần khiết']],
      ];
      $icons = ['💆','🌊','⚡','🌀','〰️','🍃'];
      foreach ($hair_types as $i => $h) : $delay = ($i % 3) + 1; ?>
      <div class="hair-card reveal reveal-delay-<?php echo $delay; ?>">
        <div class="hair-card-image">
          <span class="origin-flag"><?php echo esc_html($h['flag']); ?></span>
          <div class="hair-card-image-icon"><?php echo $icons[$i]; ?></div>
          <?php if ($h['badge']) : ?><span class="origin-label"><?php echo esc_html($h['badge']); ?></span><?php endif; ?>
        </div>
        <div class="hair-card-body">
          <h3><?php echo esc_html($h['name']); ?></h3>
          <span class="hair-type-badge"><?php echo esc_html($h['type']); ?></span>
          <p><?php echo esc_html($h['desc']); ?></p>
          <div class="hair-card-tags">
            <?php foreach ($h['tags'] as $tag) : ?>
            <span class="hair-tag"><?php echo esc_html($tag); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="why-us" id="why-us">
  <div class="container">
    <div class="section-header center reveal">
      <span class="section-label">Lý do hợp tác</span>
      <h2 class="section-title">Tại Sao Chọn<br><span>Chúng Tôi?</span></h2>
      <p class="section-desc">Chúng tôi không chỉ là nhà cung cấp – chúng tôi là đối tác chiến lược.</p>
    </div>
    <div class="why-grid">
      <?php
      $reasons = [
        ['icon'=>'🏭','title'=>'Sở hữu nhà máy riêng','desc'=>'Không qua trung gian, giá thành thấp hơn 30-40% so với thị trường.'],
        ['icon'=>'🎯','title'=>'Chất lượng ổn định','desc'=>'Quy trình kiểm soát chất lượng nghiêm ngặt trước khi xuất xưởng.'],
        ['icon'=>'🎨','title'=>'Màu sắc tái lặp được','desc'=>'Công nghệ nhuộm công nghiệp cho phép tái lặp chính xác màu sắc.'],
        ['icon'=>'📦','title'=>'Đơn hàng MOQ linh hoạt','desc'=>'Hỗ trợ từ đơn hàng mẫu nhỏ đến sản xuất lớn theo yêu cầu.'],
        ['icon'=>'✈️','title'=>'Giao hàng toàn cầu','desc'=>'Hợp tác với vận chuyển quốc tế uy tín, tracking real-time.'],
        ['icon'=>'🤝','title'=>'Hỗ trợ tận tâm','desc'=>'Đội ngũ tư vấn chuyên nghiệp, hỗ trợ OEM/ODM, phản hồi nhanh.'],
      ];
      foreach ($reasons as $r_idx => $r) : $delay = ($r_idx % 3) + 1; ?>
      <div class="why-card reveal reveal-delay-<?php echo $delay; ?>">
        <div class="why-icon"><?php echo $r['icon']; ?></div>
        <h3><?php echo esc_html($r['title']); ?></h3>
        <p><?php echo esc_html($r['desc']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="contact" id="contact">
  <div class="container">
    <div class="contact-inner">
      <div class="reveal">
        <span class="section-label">Liên hệ</span>
        <h2 class="section-title">Bắt Đầu Hợp Tác<br><span>Cùng Chúng Tôi</span></h2>
        <p>Hãy để lại thông tin, chúng tôi sẽ liên hệ lại trong vòng 24 giờ với bảng báo giá chi tiết và mẫu sản phẩm miễn phí.</p>
        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-detail-icon">📍</div>
            <div class="contact-detail-text"><span>Địa chỉ</span><p>123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">📞</div>
            <div class="contact-detail-text"><span>Điện thoại / WhatsApp</span><p>+84 xxx xxx xxxx</p></div>
          </div>
          <div class="contact-detail">
            <div class="contact-detail-icon">✉️</div>
            <div class="contact-detail-text"><span>Email</span><p><?php echo antispambot(get_option('admin_email')); ?></p></div>
          </div>
        </div>
      </div>

      <div class="reveal reveal-delay-2">
        <form class="contact-form" id="contactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <?php wp_nonce_field('hair_contact_form', 'hair_nonce'); ?>
          <input type="hidden" name="action" value="hair_contact">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Họ và tên *</label>
              <input type="text" id="name" name="name" placeholder="Nguyễn Văn A" required>
            </div>
            <div class="form-group">
              <label for="company">Công ty</label>
              <input type="text" id="company" name="company" placeholder="Tên công ty">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" id="email" name="email" placeholder="email@congty.com" required>
            </div>
            <div class="form-group">
              <label for="phone">Điện thoại</label>
              <input type="tel" id="phone" name="phone" placeholder="+84 xxx xxx xxxx">
            </div>
          </div>
          <div class="form-group">
            <label for="product">Loại sản phẩm quan tâm</label>
            <select id="product" name="product" style="background:#1a1a1a">
              <option value="">-- Chọn loại tóc --</option>
              <option value="vietnam">Tóc Việt Nam</option>
              <option value="india">Tóc Ấn Độ</option>
              <option value="china">Tóc Trung Quốc</option>
              <option value="iran">Tóc Iran</option>
              <option value="turkey">Tóc Thổ Nhĩ Kỳ</option>
              <option value="myanmar">Tóc Miến Điện</option>
              <option value="other">Khác / Cần tư vấn</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Nội dung yêu cầu *</label>
            <textarea id="message" name="message" placeholder="Mô tả nhu cầu: số lượng, màu sắc, thời gian cần hàng..." required></textarea>
          </div>
          <button type="submit" class="btn btn-gold form-submit">Gửi yêu cầu báo giá</button>
          <p class="form-note">Chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc</p>
        </form>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
