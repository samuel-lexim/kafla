<?php if(sienna_mikado_options()->getOptionValue('portfolio_single_hide_author') !== 'yes') : ?>
    <div class="mkdf-portfolio-author-holder clearfix">
        <div class="mkdf-image-author-holder clearfix">
            <div class="mkdf-author-description-image">
                <?php echo sienna_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
            </div>
            <div class="mkdf-author-name-position">
                <h5 class="mkdf-author-name">
                    <?php
                    if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
                        echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
                    } else {
                        echo esc_attr(get_the_author_meta('display_name'));
                    }
                    ?>
                </h5>
                <?php if(get_the_author_meta('position') !== '') : ?>
                    <div class="mkdf-author-position-holder">
                        <h6 class="mkdf-author-position"><?php echo esc_html(get_the_author_meta('position')); ?></h6>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mkdf-author-description-text-holder">
            <?php if(get_the_author_meta('description') !== '') { ?>
                <div class="mkdf-author-text">
                    <p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>