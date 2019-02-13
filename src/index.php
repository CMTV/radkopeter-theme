<?php

get_header();

$categories = get_categories([
    'meta_key' => 'display_order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
]);

foreach ($categories as $category):

    if ($category->term_id === 1) continue;

    radkopeter_the_subheader([
        'id' => $category->term_id,
        'title' => $category->name,
        'color' => get_field('color', $category),
        'link' => get_category_link($category),
        'icon' => get_field('fa-icon', $category),
        'count' => $category->count
    ]);

    $category_posts = get_posts([
        'category' => $category->term_id,
        'meta_key' => 'is_featured',
        'meta_value' => true,
        'numberposts' => -1
    ]);
?>

<div class="projects">
    <?php

    if ($category_posts)
    {
        foreach ($category_posts as $post):
            setup_postdata($post);
            get_template_part('template-parts/project-block');
            wp_reset_postdata();
        endforeach;
    }

    ?>
</div>

<?php endforeach; ?>

<?php get_footer(); ?>