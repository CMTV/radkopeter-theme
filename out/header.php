<?php

$title = get_bloginfo('name');

if (is_home()) {}

else if (is_category())
{
    $title = get_queried_object()->name . ' | ' . __('Category', 'radkopeter') . ' | ' . $title;
}

else if (is_tag())
{
    $title = '#' . get_queried_object()->name . ' | ' . __('Tag', 'radkopeter') . ' | ' . $title;
}

else
{
    $title = get_the_title() . ' | ' . __('Project', 'radkopeter') . ' | ' . $title;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/favicon.png' ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <!-- Content -->
        <div class="content">

            <?php get_template_part('template-parts/me'); ?>

            <hr>