<?php

get_header();

/** @var WP_Term $term */
$term = get_queried_object();

radkopeter_the_breadcrumbs();
?>

<div class="projects-container">

    <?php
    radkopeter_the_subheader([
        'id' =>     $term->term_id,
        'title' =>  $term->name,
        'color' =>  is_category() ? get_field('color', $term) : '#6c6c6c',
        'icon' =>   is_category() ? get_field('fa-icon', $term) : 'fas fa-hashtag',
        'count' =>  $term->count
    ]);

    $term_posts = get_posts([
        is_category() ? 'category' : 'tag' => is_category() ? $term->term_id : $term->slug,
        'numberposts' => -1
    ]);
    ?>

    <div class="projects">
        <?php

        if ($term_posts)
        {
            foreach ($term_posts as $post)
            {
                setup_postdata($post);
                get_template_part('template-parts/project-block');
                wp_reset_postdata();
            }
        }

        ?>
    </div>
</div>

<?php
    get_footer();
?>