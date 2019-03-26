<?php

if (!function_exists('radkopeter_setup'))
{
    function radkopeter_setup()
    {
        add_theme_support('post-thumbnails');
        add_post_type_support('post', 'excerpt');
        add_theme_support('html5', ['gallery', 'caption']);
        add_theme_support('editor-styles');
        add_editor_style('style-editor.css');
    }
}
add_action('after_setup_theme', 'radkopeter_setup');

function radkopeter_customize($wp_customize)
{
    // Section

    $wp_customize->add_section('my_info', [
        'title'    => __('My info', 'radkopeter'),
        'priority' => 30
    ]);

    // Settings

    $wp_customize->add_setting('full_name', [
        'default'   => 'Radko Peter'
    ]);

    $wp_customize->add_setting('location', [
        'default'   => 'Russia, Moscow'
    ]);

    $wp_customize->add_setting('location_url', [
        'default' => 'https://www.google.com/maps/place/Москва/'
    ]);

    $wp_customize->add_setting('email', [
        'default'   => 'newpetya@inbox.ru'
    ]);

    $wp_customize->add_setting('bio', [
        'default' => 'My bio'
    ]);

    // Controls

    $wp_customize->add_control('my_info_full_name_control', [
        'label' => __('First and second name', 'radkopeter'),
        'section' => 'my_info',
        'settings' => 'full_name'
    ]);

    $wp_customize->add_control('my_info_location_control', [
        'label' => __('Location', 'radkopeter'),
        'section' => 'my_info',
        'settings' => 'location'
    ]);

    $wp_customize->add_control('my_info_location_url_control', [
        'label' => __('Location URL', 'radkopeter'),
        'section' => 'my_info',
        'settings' => 'location_url'
    ]);

    $wp_customize->add_control('my_info_email_control', [
        'label' => __('Contact email', 'radkopeter'),
        'section' => 'my_info',
        'settings' => 'email'
    ]);

    $wp_customize->add_control('my_info_bio_control', [
        'type' => 'textarea',
        'label' => __('Short about me', 'radkopeter'),
        'section' => 'my_info',
        'settings' => 'bio'
    ]);

    // Removing an ability to set site favicon
    $wp_customize->remove_control('site_icon');
}
add_action('customize_register', 'radkopeter_customize');

function radkopeter_scripts()
{
    wp_enqueue_style('radkopeter-frontend-style', get_template_directory_uri() . '/style-frontend.css');

    // Font Awesome
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.7.1/css/all.css');
}
add_action('wp_enqueue_scripts', 'radkopeter_scripts');

function radkopeter_category_column_display_order($columns)
{
    $columns['radkopeter_display_order'] = __('Display order', 'radkopeter');

    return $columns;
}
add_filter('manage_edit-category_columns','radkopeter_category_column_display_order');

function radkopeter_category_column_display_order_value($deprecated, $column_name, $term_id)
{
    if ($column_name == 'radkopeter_display_order') {
        $category = get_category($term_id);
        echo get_field('display_order', $category);
    }
}
add_filter ('manage_category_custom_column', 'radkopeter_category_column_display_order_value', 10,3);

function radkopeter_the_subheader(array $subheader_data)
{
    set_query_var('data', new RadkoPeter_SubHeader($subheader_data));
    get_template_part('template-parts/sub-header');
}

function radkopeter_the_breadcrumbs(array... $breadcrumbs)
{
    $out = '';

    $add_breadcrumb = function (array $breadcrumb) use (&$out)
    {
        $_out = '';

        if (!array_key_exists('title', $breadcrumb) || !array_key_exists('link', $breadcrumb))
        {
            throw new Exception('Incorrect breadcrumb array structure!');
        }

        if (array_key_exists('icon', $breadcrumb))
        {
            $_out = '<i class="' . $breadcrumb['icon'] . '"></i>';
        }

        $_out .= '<a class="no-style hover-style" href="' . $breadcrumb['link'] . '">' . $breadcrumb['title'] . '</a>';

        $out .= '<div class="breadcrumb">' . $_out . '</div>';
    };

    $add_breadcrumb(['title' => __('Home', 'radkopeter'), 'link' => get_site_url()]);

    foreach ($breadcrumbs as $breadcrumb)
    {
        $add_breadcrumb($breadcrumb);
    }

    $out = '<div class="breadcrumbs">' . $out . '</div>';

    echo $out;
}

function radkopeter_the_icon_link(array $data)
{
    if (
        !array_key_exists('fa_icon', $data) ||
        !array_key_exists('link', $data) ||
        !array_key_exists('link_title', $data)
    )
    {
        throw new Exception('Incorrect icon link array structure!');
    }

    $out = '<i class="' . $data['fa_icon'] .'"></i>';

    $classes = 'icon-link ' . str_replace('fa-', '', explode(' ', $data['fa_icon'])[1]);

    $out = '<a class="no-style ' . $classes . '" href="' . $data['link'] . '" title="' . $data['link_title'] . '" target="_blank">' . $out . '</a>';

    echo $out;
}

function radkopeter_the_info_item(array $data)
{
    if (
        !array_key_exists('fa_icon', $data) ||
        !array_key_exists('code', $data) ||
        !array_key_exists('label', $data) ||
        !array_key_exists('explain', $data)
    )
    {
        throw new Exception('Incorrect info item array structure!');
    }

    $out = '<i class="' . $data['fa_icon'] . '"></i>';

    $out .= '<span class="label">' . $data['label'] . '</span>';

    $out = '<div class="item item-' . $data['code'] . '" title="' . $data['explain'] . '">' . $out . '</div>';

    echo $out;
}

function radkopeter_the_status_label(string $status)
{
    if (get_field('has_custom_label_explain'))
    {
        echo get_field('status_label_explain')['label'];
        return;
    }

    switch ($status)
    {
        case 'green':
            echo __('Working', 'radkopeter');
            break;
        case 'yellow':
            echo __('Paused', 'radkopeter');
            break;
        case 'red':
            echo __('Closed', 'radkopeter');
            break;
        case 'custom':
            echo get_field('status_label_explain')['label'];
            break;
    }
}

function radkopeter_the_status_explain(string $status)
{
    if (get_field('has_custom_label_explain'))
    {
        echo get_field('status_label_explain')['explain'];
        return;
    }

    switch ($status)
    {
        case 'green':
            echo __('The project is working now', 'radkopeter');
            break;
        case 'yellow':
            echo __('The project is paused now', 'radkopeter');
            break;
        case 'red':
            echo __('The project is closed and not supported anymore', 'radkopeter');
            break;
        case 'custom':
            echo get_field('status_label_explain')['explain'];
            break;
    }
}

function radkopeter_deafult_date_explain()
{
    return get_field('default_date_explain') ?: __('Creation date', 'radkopeter');
}

function radkopeter_the_og_tag(string $property, string $content)
{
    echo '<meta property="og:' . $property . '" content="' . $content . '" />';
}

// Classes
require get_template_directory() . '/classes/RadkoPeter_SubHeader.php';