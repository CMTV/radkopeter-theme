<?php

get_header();

the_post();

/** @var array $category */
$category = get_the_category();

if (count($category) > 0)
{
    /** @var WP_Term $category */
    $category = $category[0];

    radkopeter_the_breadcrumbs(
        ['icon' => get_field('fa-icon', $category), 'title' => $category->name, 'link' => get_category_link($category)]
    );
}
else
{
    radkopeter_the_breadcrumbs();
}

?>

<div class="project-container">
    <?php

        radkopeter_the_subheader([
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'is_fa_icon' => false,
            'icon' => get_the_post_thumbnail_url(),
            'color' => '#3C3C3C'
        ]);

    ?>

    <div class="project">
        <section class="infobar">
            <div class="info-items">

                <?php if (get_field('has_status')): ?>
                    <div class="item item-status" title="<?php radkopeter_the_status_explain(get_field('status_type')); ?>">

                        <?php if (get_field('status_type') === 'custom'): ?>
                            <style>
                                .infobar .status-circle
                                {
                                    background: <?php echo get_field('status_colors')['background']; ?>;
                                    border-color: <?php echo get_field('status_colors')['border']; ?>;
                                }
                            </style>
                        <?php endif; ?>

                        <div class="icon">
                            <div class="status-circle <?php the_field('status_type'); ?>"></div>
                        </div>
                        <span class="label"><?php radkopeter_the_status_label(get_field('status_type')); ?></span>
                    </div>
                <?php endif; ?>

                <?php

                radkopeter_the_info_item([
                        'fa_icon' => 'far fa-calendar-' . (get_field('has_close_date') ? 'plus' : 'alt'),
                        'code' => 'creation-date',
                        'label' => get_the_date('F Y'),
                        'explain' => radkopeter_deafult_date_explain()
                ]);

                if (get_field('has_close_date'))
                {
                    radkopeter_the_info_item([
                        'fa_icon' => 'far fa-calendar-minus',
                        'code' => 'close-date',
                        'label' => get_field('close_date'),
                        'explain' => get_field('close_date_explain') ?: __('Close date', 'radkopeter')
                    ]);
                }

                if ($info_items = get_field('info_items'))
                {
                    foreach ($info_items as $info_item)
                    {
                        radkopeter_the_info_item($info_item);
                    }
                }

                ?>

            </div>

            <div class="icon-links">
                <?php

                if (get_field('project_link'))
                {
                    radkopeter_the_icon_link([
                        'fa_icon' => 'fas fa-globe',
                        'link' => get_field('project_link'),
                        'link_title' => get_field('project_link_title') ?: __('Project site', 'radkopeter')
                    ]);
                }

                if ($icon_links = get_field('icon_links'))
                {
                    foreach ($icon_links as $icon_link)
                    {
                        radkopeter_the_icon_link($icon_link);
                    }
                }

                ?>
            </div>
        </section>

        <article>
            <div class="excerpt"><?php the_excerpt(); ?></div>
            <?php the_content(); ?>
        </article>

        <section class="footer">
            <div class="tags">
                <?php

                $tags = get_the_tags();

                ?>

                <?php if ($tags): ?>
                    <i title="<?php echo __('Tags', 'radkopeter'); ?>" class="fas fa-hashtag"></i>

                    <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo get_tag_link($tag); ?>" class="tag no-style"><?php echo $tag->name; ?></a>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>

            <div class="last-modified">
                <?php echo __('Page last update: ', 'radkopeter') . get_the_modified_date('d M Y'); ?>
            </div>
        </section>
    </div>
</div>

<?php
    get_footer();
?>
