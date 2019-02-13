<div class="project-block">
    <a href="<?php the_permalink(); ?>" class="icon no-style">
        <img alt="<?php echo __('Project icon', 'radkopeter'); ?>" src="<?php the_post_thumbnail_url(); ?>">
    </a>

    <div class="block">
        <div class="header">
            <a href="<?php the_permalink(); ?>" class="icon-mini no-style">
                <img alt="<?php echo __('Project icon', 'radkopeter'); ?>" src="<?php the_post_thumbnail_url(); ?>">
            </a>

            <div class="info">
                <h3><a class="no-style hover-style" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <div title="<?php echo radkopeter_deafult_date_explain(); ?>" class="date">
                    <i class="far fa-calendar-alt"></i>
                    <span><?php echo get_the_date('F Y'); ?></span>
                </div>
            </div>
        </div>

        <div class="body"><?php the_excerpt(); ?></div>

        <div class="footer">
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

            <a href="<?php the_permalink(); ?>" class="more-info no-style">
                <span><?php echo __('More info', 'radkopeter'); ?></span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>