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
        '1.0.6'
    );

    wp_enqueue_script(
        'hair-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.6',
        true
    );
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
                    '1.0.6',
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

    // ── PANEL główny ──────────────────────────
    $wp_customize->add_panel('hair_panel', [
        'title'    => '🎨 Ustawienia strony',
        'priority' => 30,
    ]);

    // ── SECTION: Images ───────────────────────
    $wp_customize->add_section('hair_images', [
        'title' => '📷 Images',
        'panel' => 'hair_panel',
    ]);

    $images = [
        'hero_bg'    => ['Hero background image (dark photo)',  'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'],
        'about_img'  => ['About section photo',                 'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'],
    ];

    foreach ( $images as $key => $data ) {
        $wp_customize->add_setting( "hair_{$key}", [
            'default'           => $data[1],
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "hair_{$key}", [
            'label'   => $data[0],
            'section' => 'hair_images',
        ]));
    }

    // ── SECTION: Hero ─────────────────────────
    $wp_customize->add_section('hair_hero', [
        'title' => '🦸 Hero Section',
        'panel' => 'hair_panel',
    ]);

    $hero_fields = [
        'hero_title'    => ['Title (line 1)',             'Hair Evolution'],
        'hero_subtitle' => ['Title (line 2 – gold italic)', 'Factory'],
        'hero_desc'     => ['Description text',           'Fabryka przemysłowego farbowania włosów naturalnych. Współpracujemy wyłącznie w modelu B2B.'],
        'hero_btn1'     => ['Button 1 label',             'Oblicz cenę'],
        'hero_btn2'     => ['Button 2 label',             'O Fabryce'],
    ];

    foreach ( $hero_fields as $key => $data ) {
        $wp_customize->add_setting( "hair_{$key}", [
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control( "hair_{$key}", [
            'label'   => $data[0],
            'section' => 'hair_hero',
            'type'    => 'text',
        ]);
    }

    // ── SECTION: About ────────────────────────
    $wp_customize->add_section('hair_about', [
        'title' => '🏭 About Section',
        'panel' => 'hair_panel',
    ]);

    $about_fields = [
        'about_title' => ['Section heading',       'Nowoczesna fabryka'],
        'about_gold'  => ['Gold italic subheading', 'farbowania włosów'],
        'about_p1'    => ['Paragraph 1',            'Hair Evolution Factory to nowoczesna fabryka przemysłowego farbowania włosów naturalnych zlokalizowana we Wrocławiu.'],
        'about_p2'    => ['Paragraph 2',            'Dzięki skali produkcji przemysłowej jesteśmy w stanie oferować stabilną jakość, powtarzalność koloru oraz konkurencyjne ceny.'],
        'about_years' => ['Years of experience',    '10+'],
    ];

    foreach ( $about_fields as $key => $data ) {
        $type = in_array( $key, ['about_p1', 'about_p2'] ) ? 'textarea' : 'text';
        $wp_customize->add_setting( "hair_{$key}", [
            'default'           => $data[1],
            'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field',
        ]);
        $wp_customize->add_control( "hair_{$key}", [
            'label'   => $data[0],
            'section' => 'hair_about',
            'type'    => $type,
        ]);
    }

    // ── SECTION: Contact ──────────────────────
    $wp_customize->add_section('hair_contact', [
        'title' => '📞 Contact Details',
        'panel' => 'hair_panel',
    ]);

    $contact_fields = [
        'contact_city'  => ['City / Country',  'Wrocław, Polska'],
        'contact_email' => ['Email address',   'kontakt@hairevolutionfactory.pl'],
        'contact_phone' => ['Phone number',    '+48 573 568 410'],
        'contact_hours' => ['Working hours',   'Pn–Pt: 8:00–17:00'],
    ];

    foreach ( $contact_fields as $key => $data ) {
        $wp_customize->add_setting( "hair_{$key}", [
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control( "hair_{$key}", [
            'label'   => $data[0],
            'section' => 'hair_contact',
            'type'    => 'text',
        ]);
    }

    foreach ( [
        'contact_instagram' => 'Instagram URL (zostaw puste, aby ukryć)',
        'contact_whatsapp'  => 'WhatsApp URL (np. https://wa.me/48573568410)',
    ] as $key => $label ) {
        $wp_customize->add_setting( "hair_{$key}", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control( "hair_{$key}", [
            'label'   => $label,
            'section' => 'hair_contact',
            'type'    => 'url',
        ]);
    }

    // ── SECTION: Hair Types ───────────────────
    $wp_customize->add_section('hair_types', [
        'title' => '💇 Hair Types',
        'panel' => 'hair_panel',
    ]);

    $box_defaults = [
        1 => ['Włosy Proste',  'Silky & Strong Straight', 'Naturalne włosy proste dostępne w kilku wariantach grubości włosiny. Idealne do farbowania i tworzenia gładkich, lśniących przedłużeń.'],
        2 => ['Lekka Fala',    'Fine & Natural Wave',     'Delikatna, naturalna fala nadająca fryzurze objętości. Doskonała do technik ombre, balayage oraz lekkich stylizacji.'],
        3 => ['Gęsta Fala',    'Dense Wave & Volume',     'Gęste, falowane pasma o bogatej strukturze. Popularne na rynkach europejskich i premium, idealne do objętościowych stylizacji.'],
        4 => ['Włosy Kręcone', 'Power Curl & Afro',       'Naturalne loki o wyjątkowej wytrzymałości i gęstości. Przeznaczone dla klientów poszukujących mocnych, trwałych fryzerek.'],
    ];

    foreach ( $box_defaults as $n => $defaults ) {
        $wp_customize->add_setting( "hair_box{$n}_title", [
            'default'           => $defaults[0],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control( "hair_box{$n}_title", [
            'label'   => "Box {$n} – Title",
            'section' => 'hair_types',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting( "hair_box{$n}_subtitle", [
            'default'           => $defaults[1],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control( "hair_box{$n}_subtitle", [
            'label'   => "Box {$n} – Subtitle (gold italic)",
            'section' => 'hair_types',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting( "hair_box{$n}_desc", [
            'default'           => $defaults[2],
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control( "hair_box{$n}_desc", [
            'label'   => "Box {$n} – Description",
            'section' => 'hair_types',
            'type'    => 'textarea',
        ]);

        $wp_customize->add_setting( "hair_box{$n}_gallery", [
            'default'           => '',
            'sanitize_callback' => 'hair_sanitize_gallery',
        ]);
        $wp_customize->add_control(
            new Hair_Media_Gallery_Control( $wp_customize, "hair_box{$n}_gallery", [
                'label'   => "Box {$n} – Photos & Videos",
                'section' => 'hair_types',
            ])
        );
    }

    // ── SECTION: Footer ───────────────────────
    $wp_customize->add_section('hair_footer', [
        'title' => '🦶 Footer',
        'panel' => 'hair_panel',
    ]);

    $wp_customize->add_setting('hair_footer_desc', [
        'default'           => 'Nowoczesna fabryka przemysłowego farbowania włosów naturalnych. Wrocław, Polska. Wyłącznie model B2B.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('hair_footer_desc', [
        'label'   => 'Footer description text',
        'section' => 'hair_footer',
        'type'    => 'textarea',
    ]);
}
add_action('customize_register', 'hair_customizer_register');

// Helper: get Customizer setting with fallback default
function hair_mod( $key, $default = '' ) {
    return get_theme_mod( "hair_{$key}", $default );
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
            echo '<div class="car-slide car-slide-video">';
            echo '<video src="' . esc_url( $url ) . '" muted playsinline loop preload="none"></video>';
            echo '<div class="car-play-icon">&#9654;</div>';
            echo '</div>';
        } else {
            $src = wp_get_attachment_image_src( $id, 'medium_large' );
            if ( ! $src ) continue;
            echo '<div class="car-slide"><img src="' . esc_url( $src[0] ) . '" alt="" loading="lazy"></div>';
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
