<!-- Me -->
<section class="me">
    <a href="<?php echo get_site_url(); ?>" class="photo no-style">
        <img alt="My photo" src="<?php echo get_template_directory_uri() . '/images/me.png'; ?>">
    </a>

    <div class="info">
        <div class="header">
            <a href="<?php echo get_site_url(); ?>" class="photo-smaller no-style">
                <img alt="My photo" src="<?php echo get_template_directory_uri() . '/images/me-smaller.png'; ?>">
            </a>
            <div class="header-info">
                <h1 class="full-name">
                    <a href="<?php echo get_site_url(); ?>" class="no-style"><?php echo mb_strtoupper(get_theme_mod('full_name')); ?></a>
                    <span class="nick" title="<?php echo __('Nickname', 'radkopeter'); ?>">CMTV</span>
                </h1>

                <div class="facts">
                    <div class="fact fact-age">
                        <span class="label"><?php echo __('Age', 'radkopeter'); ?></span>
                        <?php echo date_diff(date_create('1998-04-22'), date_create('today'))->y; ?>
                    </div>

                    <div class="fact fact-from">
                        <span class="label"><?php echo __('From', 'radkopeter'); ?></span>
                        <?php echo __('Russia', 'radkopeter'); ?>
                    </div>

                    <div class="fact fact-location">
                        <span class="label"><?php echo __('Location', 'radkopeter'); ?></span>
                        <a href="<?php echo get_theme_mod('location_url'); ?>" target="_blank">
                            <?php echo get_theme_mod('location'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bio"><?php echo get_theme_mod('bio'); ?></div>

        <div class="contact-block">
            <a href="mailto:<?php echo get_theme_mod('email'); ?>" class="contact no-style">
                <i class="fas fa-envelope"></i>
                <span class="label"><?php echo __('Contact me', 'radkopeter'); ?></span>
            </a>
        </div>
    </div>
</section>
<!-- Me [END] -->