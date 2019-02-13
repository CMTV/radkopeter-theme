<?php

/** @var RadkoPeter_SubHeader $data */

?>
<div class="sub-header">
    <?php

        $data->the_color_css();
        $data->the_icon(true);

    ?>

    <div class="info">
        <?php $data->the_title(); ?>

        <?php if ($data->has_count()): ?>
            <span class="count <?php $data->the_css_class('color'); ?>" title="<?php $data->the_count_text(); ?>"><?php $data->the_count(); ?></span>
        <?php endif; ?>
    </div>

    <?php if ($data->is_link()): ?>
        <a <?php $data->the_href(); $data->the_link_type(); ?> class="link no-style <?php $data->the_css_class('h-color', 'h-border'); ?>">
            <span class="label"><?php $data->the_link_text(); ?></span>
            <i class="fas fa-arrow-right"></i>
        </a>
    <?php endif; ?>
</div>