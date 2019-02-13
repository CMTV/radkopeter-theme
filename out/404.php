<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php echo __('Page not found', 'radkopeter') . ' | ' . get_bloginfo('name'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/favicon.png' ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="error-404">
        <div class="message">
            <i class="far fa-frown-open"></i>
            <div class="label"><?php _e('Page not found!', 'radkopeter'); ?></div>
        </div>
        <a class="return no-style hover-style" href="<?php echo get_site_url(); ?>"><?php _e('Return to home', 'radkopeter'); ?></a>
    </div>
<?php wp_footer() ?>
</body>
</html>