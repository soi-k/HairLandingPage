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
        '1.0.3'
    );

    wp_enqueue_script(
        'hair-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.3',
        true
    );
}
add_action('wp_enqueue_scripts', 'hair_enqueue_assets');

// =============================================
// WORDPRESS CUSTOMIZER
// Appearance → Customize → ustawienia strony
// =============================================
function hair_customizer_register( $wp_customize ) {

    // ── PANEL główny ──────────────────────────
    $wp_customize->add_panel('hair_panel', [
        'title'    => '🎨 Ustawienia strony',
        'priority' => 30,
    ]);

    // ── SEKCJA: Obrazy ────────────────────────
    $wp_customize->add_section('hair_images', [
        'title' => '📷 Obrazy',
        'panel' => 'hair_panel',
    ]);

    $images = [
        'hero_bg'    => ['Tło sekcji Hero (ciemne zdjęcie)',  'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'],
        'about_img'  => ['Zdjęcie w sekcji "O Fabryce"',      'https://hairevolution.pl/wp-content/uploads/2026/03/przedluzgym-20-of-215-scaled.jpg'],
        'img_wietnam'=> ['Zdjęcie – Wietnam',                  'https://hairevolution.pl/wp-content/uploads/2026/03/wietnam-768x1024.jpg'],
        'img_indie'  => ['Zdjęcie – Indie',                    'https://hairevolution.pl/wp-content/uploads/2026/03/india-768x1024.jpg'],
        'img_chiny'  => ['Zdjęcie – Chiny',                    'https://hairevolution.pl/wp-content/uploads/2026/03/chiny-768x1024.jpg'],
        'img_iran'   => ['Zdjęcie – Iran',                     'https://hairevolution.pl/wp-content/uploads/2026/03/iran-768x1024.jpg'],
        'img_turcja' => ['Zdjęcie – Turcja',                   'https://hairevolution.pl/wp-content/uploads/2026/03/turcja-768x1024.jpg'],
        'img_birma'  => ['Zdjęcie – Birma',                    'https://hairevolution.pl/wp-content/uploads/2026/03/IMG_9895-768x1024.jpg'],
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

    // ── SEKCJA: Hero ──────────────────────────
    $wp_customize->add_section('hair_hero', [
        'title' => '🦸 Sekcja Hero',
        'panel' => 'hair_panel',
    ]);

    $hero_fields = [
        'hero_title'    => ['Tytuł (linia 1)',   'Hair Evolution'],
        'hero_subtitle' => ['Tytuł (linia 2 – złoty kursyw)', 'Factory'],
        'hero_desc'     => ['Opis pod tytułem',  'Fabryka przemysłowego farbowania włosów naturalnych. Współpracujemy wyłącznie w modelu B2B.'],
        'hero_btn1'     => ['Tekst przycisku 1', 'Oblicz cenę'],
        'hero_btn2'     => ['Tekst przycisku 2', 'O Fabryce'],
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

    // ── SEKCJA: O Fabryce ─────────────────────
    $wp_customize->add_section('hair_about', [
        'title' => '🏭 O Fabryce',
        'panel' => 'hair_panel',
    ]);

    $about_fields = [
        'about_title' => ['Tytuł sekcji',    'Nowoczesna fabryka'],
        'about_gold'  => ['Złoty podtytuł',  'farbowania włosów'],
        'about_p1'    => ['Akapit 1',         'Hair Evolution Factory to nowoczesna fabryka przemysłowego farbowania włosów naturalnych zlokalizowana we Wrocławiu.'],
        'about_p2'    => ['Akapit 2',         'Dzięki skali produkcji przemysłowej jesteśmy w stanie oferować stabilną jakość, powtarzalność koloru oraz konkurencyjne ceny.'],
        'about_years' => ['Liczba lat doświadczenia', '10+'],
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

    // ── SEKCJA: Kontakt ───────────────────────
    $wp_customize->add_section('hair_contact', [
        'title' => '📞 Dane kontaktowe',
        'panel' => 'hair_panel',
    ]);

    $contact_fields = [
        'contact_city'  => ['Miasto / kraj',   'Wrocław, Polska'],
        'contact_email' => ['E-mail',           'kontakt@hairevolutionfactory.pl'],
        'contact_phone' => ['Telefon',          '+48 573 568 410'],
        'contact_hours' => ['Godziny pracy',    'Pn–Pt: 8:00–17:00'],
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

    // ── SEKCJA: Footer ────────────────────────
    $wp_customize->add_section('hair_footer', [
        'title' => '🦶 Stopka',
        'panel' => 'hair_panel',
    ]);

    $wp_customize->add_setting('hair_footer_desc', [
        'default'           => 'Nowoczesna fabryka przemysłowego farbowania włosów naturalnych. Wrocław, Polska. Wyłącznie model B2B.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('hair_footer_desc', [
        'label'   => 'Opis w stopce',
        'section' => 'hair_footer',
        'type'    => 'textarea',
    ]);
}
add_action('customize_register', 'hair_customizer_register');

// Helper: pobierz ustawienie z Customizera (z wartością domyślną)
function hair_mod( $key, $default = '' ) {
    return get_theme_mod( "hair_{$key}", $default );
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
