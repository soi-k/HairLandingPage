<?php
function hair_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('customize-selective-refresh-widgets');

    register_nav_menus([
        'primary' => __('Menu główne', 'hair-landing'),
    ]);
}
add_action('after_setup_theme', 'hair_theme_setup');

function hair_enqueue_assets() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,700;1,400;1,700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'hair-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['google-fonts'],
        '1.2.7'
    );

    wp_enqueue_script(
        'hair-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.2.7',
        true
    );
    wp_localize_script('hair-main', 'hairConfig', [
        'sheetWebhook' => get_theme_mod('hair_sheet_webhook', ''),
    ]);
}
add_action('wp_enqueue_scripts', 'hair_enqueue_assets');

// =============================================
// WORDPRESS CUSTOMIZER
// Appearance → Customize → ustawienia strony
// =============================================

function hair_sanitize_gallery( $value ) {
    $ids = array_filter( array_map( 'absint', explode( ',', $value ) ) );
    return implode( ',', $ids );
}

function hair_customizer_register( $wp_customize ) {

    if ( ! class_exists( 'Hair_Media_Gallery_Control' ) ) {
        class Hair_Media_Gallery_Control extends WP_Customize_Control {
            public $type = 'hair_media_gallery';

            public function enqueue() {
                wp_enqueue_media();
                wp_enqueue_script(
                    'hair-gallery-ctrl',
                    get_template_directory_uri() . '/assets/js/customize-controls.js',
                    ['jquery', 'customize-controls', 'media-views'],
                    '1.1.0',
                    true
                );
                wp_add_inline_style( 'customize-controls', '
                    .hgc-thumbs{display:flex;flex-wrap:wrap;gap:4px;margin-bottom:8px;min-height:16px}
                    .hgc-thumb{width:52px;height:52px;border-radius:4px;overflow:hidden;border:1px solid #ddd;background:#f0f0f0}
                    .hgc-thumb img{width:100%;height:100%;object-fit:cover;display:block}
                    .hgc-thumb-video{display:flex;align-items:center;justify-content:center;font-size:18px;color:#555}
                    .hgc-actions{display:flex;gap:6px;margin-top:4px}
                    .hgc-clear{color:#d63638!important}
                ' );
            }

            public function render_content() {
                $value = $this->value();
                $ids   = array_filter( array_map( 'absint', explode( ',', $value ) ) );
                ?>
                <label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>
                <div class="hgc-wrap">
                    <div class="hgc-thumbs">
                        <?php foreach ( $ids as $id ) :
                            $mime = get_post_mime_type( $id );
                            if ( $mime && strpos( $mime, 'video' ) === 0 ) : ?>
                                <div class="hgc-thumb hgc-thumb-video" title="Video"><span>&#9654;</span></div>
                            <?php else :
                                $src = wp_get_attachment_image_src( $id, [ 52, 52 ] );
                                if ( $src ) : ?>
                                    <div class="hgc-thumb"><img src="<?php echo esc_url( $src[0] ); ?>" alt=""></div>
                                <?php endif;
                            endif;
                        endforeach; ?>
                    </div>
                    <div class="hgc-actions">
                        <button type="button" class="button hgc-select">
                            <?php echo empty( $ids ) ? '+ Dodaj zdjęcia / filmy' : '&#9998; Zmień wybór (' . count( $ids ) . ')'; ?>
                        </button>
                        <?php if ( ! empty( $ids ) ) : ?>
                        <button type="button" class="button hgc-clear">&#10005;</button>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" class="hgc-input" <?php $this->link(); ?> value="<?php echo esc_attr( $value ); ?>">
                </div>
                <?php
            }
        }
    }

    // ── PANEL chính ────────────────────────────
    $wp_customize->add_panel('hair_panel', [
        'title'    => '🎨 Cài đặt trang web',
        'priority' => 30,
    ]);

    // ── SECTION: Logo & Thương hiệu ─────────────
    $wp_customize->add_section('hair_general', [
        'title' => '🏷️ Logo & Thương hiệu',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'logo_name'   => ['Tên logo - dòng 1',              'Hair Evolution'],
        'logo_italic' => ['Tên logo - dòng 2 (in nghiêng)', 'Factory'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[0], 'section' => 'hair_general', 'type' => 'text']);
    }

    // ── SECTION: Hình ảnh ───────────────────────
    $wp_customize->add_section('hair_images', [
        'title' => '🖼️ Hình ảnh',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'hero_bg' => ['Ảnh nền Hero (ảnh tối)', 'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[1], 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hair_{$key}", ['label' => $data[0], 'section' => 'hair_images']));
    }

    $wp_customize->add_setting('hair_about_img', [
        'default'           => 'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'hair_about_img', [
        'label'       => 'Ảnh / Video section Giới thiệu',
        'description' => 'Chọn ảnh hoặc video. Nếu là video: tự động phát, tắt tiếng, bấm vào để tạm dừng/phát tiếp.',
        'section'     => 'hair_images',
    ]));

    $wp_customize->add_setting('hair_about_youtube', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hair_about_youtube', [
        'label'       => 'Link YouTube section Giới thiệu (ưu tiên nếu điền)',
        'description' => 'Dán link YouTube (vd: https://youtu.be/xxxx hoặc https://www.youtube.com/watch?v=xxxx). Nếu điền, sẽ hiển thị video YouTube thay cho ảnh/video ở trên.',
        'section'     => 'hair_images',
        'type'        => 'url',
    ]);

    // ── SECTION: Hero ───────────────────────────
    $wp_customize->add_section('hair_hero', [
        'title' => '🦸 Hero - Banner đầu trang',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'hero_location' => ['Địa điểm hiển thị',             'Wrocław, Polska'],
        'hero_title'    => ['Tiêu đề dòng 1',                 'Hair Evolution'],
        'hero_subtitle' => ['Tiêu đề dòng 2 (vàng nghiêng)', 'Factory'],
        'hero_desc'     => ['Mô tả',                          'Fabryka przemysłowego farbowania włosów naturalnych. Współpracujemy wyłącznie w modelu B2B.'],
        'hero_btn1'     => ['Nút 1 - chữ',                   'Aktualności'],
        'hero_btn2'     => ['Nút 2 - chữ',                   'O Fabryce'],
    ] as $key => $data) {
        $type = ($key === 'hero_desc') ? 'textarea' : 'text';
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[1], 'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[0], 'section' => 'hair_hero', 'type' => $type]);
    }
    $wp_customize->add_setting('hair_hero_btn1_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hair_hero_btn1_url', ['label' => 'Nút 1 - đường dẫn URL (để trống = cuộn xuống #about)', 'section' => 'hair_hero', 'type' => 'url']);

    // ── SECTION: Giới thiệu ─────────────────────
    $wp_customize->add_section('hair_about', [
        'title' => '🏭 Giới thiệu - About',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'about_tag'        => ['text', 'Tag nhỏ phía trên',                    'O Fabryce'],
        'about_title'      => ['text', 'Tiêu đề dòng 1',                       'Nowoczesna fabryka'],
        'about_gold'       => ['text', 'Tiêu đề dòng 2 (vàng nghiêng)',        'farbowania włosów'],
        'about_p1'         => ['textarea', 'Đoạn văn 1',                       'Hair Evolution Factory to nowoczesna fabryka przemysłowego farbowania włosów naturalnych zlokalizowana we Wrocławiu.'],
        'about_p2'         => ['textarea', 'Đoạn văn 2',                       'Dzięki skali produkcji przemysłowej jesteśmy w stanie oferować stabilną jakość, powtarzalność koloru oraz konkurencyjne ceny.'],
        'about_stat1_title'=> ['text', 'Thống kê 1 - tiêu đề',                 'Własna fabryka'],
        'about_stat1_sub'  => ['text', 'Thống kê 1 - phụ đề',                  'Bez pośredników'],
        'about_stat2_title'=> ['text', 'Thống kê 2 - tiêu đề',                 'Eksport'],
        'about_stat2_sub'  => ['text', 'Thống kê 2 - phụ đề',                  'Cała Europa'],
        'about_stat3_title'=> ['text', 'Thống kê 3 - tiêu đề',                 'B2B Only'],
        'about_stat3_sub'  => ['text', 'Thống kê 3 - phụ đề',                  'Wyłącznie hurtowo'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_about', 'type' => $data[0]]);
    }

    // ── SECTION: Section Promo ─────────────────
    $wp_customize->add_section('hair_promo', [
        'title' => '🎯 Section Promo (dưới Loại tóc)',
        'panel' => 'hair_panel',
    ]);

    $wp_customize->add_setting('hair_promo_enabled', ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hair_promo_enabled', [
        'label'   => 'Hiển thị section này',
        'section' => 'hair_promo',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('hair_promo_nav', ['default' => 'Nasz Produkt', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hair_promo_nav', ['label' => 'Tên menu item', 'section' => 'hair_promo', 'type' => 'text']);

    foreach ([
        'promo_tag'         => ['text',     'Tag nhỏ phía trên',              'Nasza Oferta'],
        'promo_title'       => ['text',     'Tiêu đề dòng 1',                 'Włosy'],
        'promo_gold'        => ['text',     'Tiêu đề dòng 2 (vàng nghiêng)', 'z Wietnamu'],
        'promo_p1'          => ['textarea', 'Đoạn văn 1',                     'Opisz swój produkt lub ofertę tutaj.'],
        'promo_p2'          => ['textarea', 'Đoạn văn 2 (để trống để ẩn)',    ''],
        'promo_stat1_title' => ['text',     'Thống kê 1 - tiêu đề',           ''],
        'promo_stat1_sub'   => ['text',     'Thống kê 1 - phụ đề',            ''],
        'promo_stat2_title' => ['text',     'Thống kê 2 - tiêu đề',           ''],
        'promo_stat2_sub'   => ['text',     'Thống kê 2 - phụ đề',            ''],
        'promo_stat3_title' => ['text',     'Thống kê 3 - tiêu đề',           ''],
        'promo_stat3_sub'   => ['text',     'Thống kê 3 - phụ đề',            ''],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_promo', 'type' => $data[0]]);
    }

    $wp_customize->add_setting('hair_promo_media', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'hair_promo_media', [
        'label'       => 'Ảnh / Video',
        'description' => 'Chọn ảnh hoặc video. Video: tự động phát, tắt tiếng, bấm để pause/play.',
        'section'     => 'hair_promo',
    ]));

    $wp_customize->add_setting('hair_promo_youtube', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hair_promo_youtube', [
        'label'       => 'Link YouTube (ưu tiên nếu điền)',
        'description' => 'Dán link YouTube (vd: https://youtu.be/xxxx hoặc https://www.youtube.com/watch?v=xxxx). Nếu điền, sẽ hiển thị video YouTube thay cho ảnh/video ở trên.',
        'section'     => 'hair_promo',
        'type'        => 'url',
    ]);

    // ── SECTION: Loại tóc ──────────────────────
    $wp_customize->add_section('hair_types', [
        'title' => '💇 Loại tóc - Hair Types',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'types_tag'   => ['Tag nhỏ phía trên',              'Rodzaje Włosów'],
        'types_title' => ['Tiêu đề (phần thường)',           'Typy &'],
        'types_gold'  => ['Tiêu đề (phần vàng nghiêng)',    'Charakterystyka'],
        'types_desc'  => ['Mô tả section',                  'Oferujemy włosy naturalne w 4 głównych typach struktury — każdy o unikalnych właściwościach i zastosowaniach.'],
    ] as $key => $data) {
        $type = ($key === 'types_desc') ? 'textarea' : 'text';
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[1], 'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[0], 'section' => 'hair_types', 'type' => $type]);
    }
    $box_defaults = [
        1 => ['Włosy Proste',  'Silky & Strong Straight', 'Naturalne włosy proste dostępne w kilku wariantach grubości włosiny. Idealne do farbowania i tworzenia gładkich, lśniących przedłużeń.'],
        2 => ['Lekka Fala',    'Fine & Natural Wave',     'Delikatna, naturalna fala nadająca fryzurze objętości. Doskonała do technik ombre, balayage oraz lekkich stylizacji.'],
        3 => ['Gęsta Fala',    'Dense Wave & Volume',     'Gęste, falowane pasma o bogatej strukturze. Popularne na rynkach europejskich i premium, idealne do objętościowych stylizacji.'],
        4 => ['Włosy Kręcone', 'Power Curl & Afro',       'Naturalne loki o wyjątkowej wytrzymałości i gęstości. Przeznaczone dla klientów poszukujących mocnych, trwałych fryzerek.'],
    ];
    foreach ($box_defaults as $n => $defaults) {
        $wp_customize->add_setting("hair_box{$n}_title",    ['default' => $defaults[0], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_box{$n}_title",    ['label' => "Loại {$n} - Tiêu đề", 'section' => 'hair_types', 'type' => 'text']);
        $wp_customize->add_setting("hair_box{$n}_subtitle", ['default' => $defaults[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_box{$n}_subtitle", ['label' => "Loại {$n} - Phụ đề (vàng nghiêng)", 'section' => 'hair_types', 'type' => 'text']);
        $wp_customize->add_setting("hair_box{$n}_desc",     ['default' => $defaults[2], 'sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_control("hair_box{$n}_desc",     ['label' => "Loại {$n} - Mô tả", 'section' => 'hair_types', 'type' => 'textarea']);
        $wp_customize->add_setting("hair_box{$n}_gallery",  ['default' => '', 'sanitize_callback' => 'hair_sanitize_gallery']);
        $wp_customize->add_control(new Hair_Media_Gallery_Control($wp_customize, "hair_box{$n}_gallery", ['label' => "Loại {$n} - Ảnh & Video", 'section' => 'hair_types']));
    }

    // ── SECTION: Yếu tố định giá ───────────────
    $wp_customize->add_section('hair_factors', [
        'title' => '💰 Yếu tố định giá',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'factors_tag'   => ['text',     'Tag nhỏ phía trên',             'Transparentna wycena'],
        'factors_title' => ['text',     'Tiêu đề (phần thường)',          'Co wpływa'],
        'factors_gold'  => ['text',     'Tiêu đề (phần vàng nghiêng)',   'na wycenę'],
        'factors_desc'  => ['textarea', 'Mô tả section',                  'Każde zamówienie wyceniamy indywidualnie. Oto główne czynniki kształtujące cenę końcową.'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_factors', 'type' => $data[0]]);
    }
    $factor_defaults = [
        1 => ['🌍', 'Pochodzenie włosów',  'Kraj i region pozyskania surowca'],
        2 => ['🔬', 'Jakość surowca',       'Grubość włosiny i stopień przetworzenia'],
        3 => ['📏', 'Długość pasm',          'Im dłuższe pasmo, tym wyższy koszt jednostkowy'],
        4 => ['⚖️', 'Ilość (waga)',          'Większe zamówienia = niższa cena/kg'],
        5 => ['🎨', 'Proces farbowania',    'Kolor docelowy, liczba etapów, technika'],
    ];
    foreach ($factor_defaults as $n => $d) {
        $wp_customize->add_setting("hair_factor{$n}_icon",  ['default' => $d[0], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_factor{$n}_icon",  ['label' => "Yếu tố {$n} - icon (emoji)", 'section' => 'hair_factors', 'type' => 'text']);
        $wp_customize->add_setting("hair_factor{$n}_title", ['default' => $d[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_factor{$n}_title", ['label' => "Yếu tố {$n} - tiêu đề", 'section' => 'hair_factors', 'type' => 'text']);
        $wp_customize->add_setting("hair_factor{$n}_desc",  ['default' => $d[2], 'sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_control("hair_factor{$n}_desc",  ['label' => "Yếu tố {$n} - mô tả", 'section' => 'hair_factors', 'type' => 'textarea']);
    }

    // ── SECTION: Giá cả cạnh tranh ─────────────
    $wp_customize->add_section('hair_pricing', [
        'title' => '🏷️ Giá cả cạnh tranh',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'pricing_tag'   => ['Tag nhỏ phía trên',           'Nasza przewaga'],
        'pricing_title' => ['Tiêu đề (phần thường)',        'Konkurencyjna cena'],
        'pricing_gold'  => ['Tiêu đề (phần vàng nghiêng)', 'bez kompromisów'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[0], 'section' => 'hair_pricing', 'type' => 'text']);
    }
    $card_defaults = [
        1 => ['🏭', 'Przemysłowa skala produkcji',       'Produkcja na skalę fabryczną pozwala nam obniżyć koszt jednostkowy o 30–50% w porównaniu z warsztatami rzemieślniczymi.'],
        2 => ['🔗', 'Własna fabryka – brak pośredników', 'Jako właściciel fabryki jesteśmy pierwszym ogniwem łańcucha dostaw. Nie płacisz marży dystrybutora.'],
        3 => ['📦', 'Bezpośredni zakup surowca',         'Pozyskujemy włosy bezpośrednio od dostawców w krajach pochodzenia, eliminując pośredników na każdym etapie.'],
        4 => ['⚙️', 'Zoptymalizowany proces',            'Lata doświadczeń pozwoliły nam zoptymalizować każdy etap produkcji — od zamawiania surowca po pakowanie gotowych pasm.'],
        5 => ['🎯', 'Stabilna powtarzalność koloru',     'Przemysłowe systemy mieszania barwników eliminują kosztowne błędy kolorystyczne.'],
        6 => ['🤝', 'Indywidualne warunki B2B',          'Dla stałych partnerów oferujemy negocjowane ceny, wydłużone terminy płatności i priorytety produkcyjne.'],
    ];
    foreach ($card_defaults as $n => $d) {
        $wp_customize->add_setting("hair_card{$n}_icon",  ['default' => $d[0], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_card{$n}_icon",  ['label' => "Thẻ {$n} - icon", 'section' => 'hair_pricing', 'type' => 'text']);
        $wp_customize->add_setting("hair_card{$n}_title", ['default' => $d[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_card{$n}_title", ['label' => "Thẻ {$n} - tiêu đề", 'section' => 'hair_pricing', 'type' => 'text']);
        $wp_customize->add_setting("hair_card{$n}_desc",  ['default' => $d[2], 'sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_control("hair_card{$n}_desc",  ['label' => "Thẻ {$n} - mô tả", 'section' => 'hair_pricing', 'type' => 'textarea']);
    }

    // ── SECTION: Tại sao chọn chúng tôi ────────
    $wp_customize->add_section('hair_why', [
        'title' => '✅ Tại sao chọn chúng tôi',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'why_tag'   => ['text',     'Tag nhỏ phía trên',             'Dlaczego My'],
        'why_title' => ['text',     'Tiêu đề (phần thường)',          'Dlaczego'],
        'why_gold'  => ['text',     'Tiêu đề (phần vàng nghiêng)',   'Hair Evolution Factory?'],
        'why_desc'  => ['textarea', 'Mô tả',                          'Jesteśmy jedyną w Polsce fabryką specjalizującą się wyłącznie w przemysłowym farbowaniu włosów naturalnych na skalę hurtową.'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_why', 'type' => $data[0]]);
    }
    $why_defaults = [
        1 => ['Doświadczenie i specjalizacja',      'Wieloletnie doświadczenie wyłącznie w segmencie hurtowego farbowania włosów naturalnych.'],
        2 => ['Kontrola jakości na każdym etapie',  'Każda partia przechodzi wieloetapową kontrolę przed wysyłką.'],
        3 => ['Stabilna powtarzalność koloru',       'Przemysłowe systemy dozowania barwników zapewniają identyczny kolor w każdej partii.'],
        4 => ['Indywidualne zamówienia B2B',         'Realizujemy zamówienia szyte na miarę — niestandardowe kolory, własne opakowania (OEM).'],
        5 => ['Różnorodność rodzajów włosów',        '6 różnych origins włosów w jednym miejscu — jeden kontakt, jedno zamówienie.'],
    ];
    foreach ($why_defaults as $n => $d) {
        $wp_customize->add_setting("hair_why{$n}_title", ['default' => $d[0], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_why{$n}_title", ['label' => "Điểm mạnh {$n} - tiêu đề", 'section' => 'hair_why', 'type' => 'text']);
        $wp_customize->add_setting("hair_why{$n}_desc",  ['default' => $d[1], 'sanitize_callback' => 'sanitize_textarea_field']);
        $wp_customize->add_control("hair_why{$n}_desc",  ['label' => "Điểm mạnh {$n} - mô tả", 'section' => 'hair_why', 'type' => 'textarea']);
    }

    // ── SECTION: Thống kê số liệu ───────────────
    $wp_customize->add_section('hair_stats', [
        'title' => '📊 Thống kê số liệu',
        'panel' => 'hair_panel',
    ]);
    $stat_defaults = [
        1 => ['6',    'Rodzaje origins'],
        2 => ['100%', 'Kontrola jakości'],
        3 => ['±2',   'Tolerancja tonu koloru'],
        4 => ['EU+',  'Eksport do Europy'],
    ];
    foreach ($stat_defaults as $n => $d) {
        $wp_customize->add_setting("hair_stat{$n}_num",   ['default' => $d[0], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_stat{$n}_num",   ['label' => "Chỉ số {$n} - con số", 'section' => 'hair_stats', 'type' => 'text']);
        $wp_customize->add_setting("hair_stat{$n}_label", ['default' => $d[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control("hair_stat{$n}_label", ['label' => "Chỉ số {$n} - nhãn", 'section' => 'hair_stats', 'type' => 'text']);
    }

    // ── SECTION: Liên hệ ───────────────────────
    $wp_customize->add_section('hair_contact', [
        'title' => '📞 Liên hệ - Contact',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'contact_tag'   => ['text',     'Tag nhỏ phía trên',             'Kontakt'],
        'contact_title' => ['text',     'Tiêu đề (phần thường)',          'Formularz'],
        'contact_gold'  => ['text',     'Tiêu đề (phần vàng nghiêng)',   'zapytania'],
        'contact_desc'  => ['textarea', 'Mô tả',                          'Współpracujemy wyłącznie z firmami w modelu B2B. Wypełnij formularz, a skontaktujemy się z Tobą w ciągu 24 godzin roboczych.'],
        'contact_city'  => ['text',     'Thành phố / Quốc gia',          'Wrocław, Polska'],
        'contact_email' => ['text',     'Địa chỉ email',                  'kontakt@hairevolutionfactory.pl'],
        'contact_phone' => ['text',     'Số điện thoại',                  '+48 573 568 410'],
        'contact_hours' => ['text',     'Giờ làm việc',                   'Pn–Pt: 8:00–17:00'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_contact', 'type' => $data[0]]);
    }
    foreach ([
        'contact_instagram' => 'URL Instagram (để trống để ẩn nút)',
        'contact_whatsapp'  => 'URL WhatsApp (vd: https://wa.me/48573568410)',
    ] as $key => $label) {
        $wp_customize->add_setting("hair_{$key}", ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_control("hair_{$key}", ['label' => $label, 'section' => 'hair_contact', 'type' => 'url']);
    }

    $wp_customize->add_setting('hair_sheet_webhook', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hair_sheet_webhook', [
        'label'       => 'Google Sheets Webhook URL',
        'description' => 'URL từ Google Apps Script (Deploy → Web app). Để trống = form vẫn hoạt động nhưng không ghi vào Sheet.',
        'section'     => 'hair_contact',
        'type'        => 'url',
    ]);

    // ── SECTION: Footer ────────────────────────
    $wp_customize->add_section('hair_footer', [
        'title' => '🦶 Footer',
        'panel' => 'hair_panel',
    ]);
    foreach ([
        'footer_brand'        => ['text',     'Tên thương hiệu dòng 1',            'Hair Evolution'],
        'footer_brand_italic' => ['text',     'Tên thương hiệu dòng 2 (in nghiêng)', 'Factory'],
        'footer_desc'         => ['textarea', 'Mô tả footer',                       'Nowoczesna fabryka przemysłowego farbowania włosów naturalnych. Wrocław, Polska. Wyłącznie model B2B.'],
    ] as $key => $data) {
        $wp_customize->add_setting("hair_{$key}", ['default' => $data[2], 'sanitize_callback' => $data[0] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field']);
        $wp_customize->add_control("hair_{$key}", ['label' => $data[1], 'section' => 'hair_footer', 'type' => $data[0]]);
    }

}
add_action('customize_register', 'hair_customizer_register');

// Helper: get Customizer setting with fallback default
function hair_mod( $key, $default = '' ) {
    return get_theme_mod( "hair_{$key}", $default );
}

// Extract YouTube video ID from a URL (supports youtu.be, watch?v=, embed/, shorts/)
function hair_youtube_id( $url ) {
    if ( ! $url ) return '';
    if ( preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $m ) ) {
        return $m[1];
    }
    return '';
}

// Render carousel slides from a gallery Customizer setting (outputs HTML)
function hair_render_gallery( $setting_key ) {
    $raw = get_theme_mod( "hair_{$setting_key}", '' );
    $ids = array_filter( array_map( 'absint', explode( ',', $raw ) ) );
    if ( empty( $ids ) ) {
        for ( $i = 1; $i <= 5; $i++ ) {
            echo '<div class="car-slide"><div class="car-slide-placeholder">Zdjęcie ' . $i . '</div></div>';
        }
        return;
    }
    foreach ( $ids as $id ) {
        $mime = get_post_mime_type( $id );
        if ( $mime && strpos( $mime, 'video' ) === 0 ) {
            $url = wp_get_attachment_url( $id );
            if ( ! $url ) continue;
            echo '<div class="car-slide car-slide-video" data-video="' . esc_url( $url ) . '">';
            echo '<video src="' . esc_url( $url ) . '" muted playsinline loop autoplay preload="metadata"></video>';
            echo '</div>';
        } else {
            $src  = wp_get_attachment_image_src( $id, 'medium_large' );
            $full = wp_get_attachment_image_src( $id, 'full' );
            if ( ! $src ) continue;
            echo '<div class="car-slide" data-full="' . esc_url( $full[0] ) . '">';
            echo '<img src="' . esc_url( $src[0] ) . '" alt="" loading="lazy">';
            echo '</div>';
        }
    }
}

// Allow SVG uploads
function hair_allow_svg( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'hair_allow_svg');

// Clean up wp_head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
