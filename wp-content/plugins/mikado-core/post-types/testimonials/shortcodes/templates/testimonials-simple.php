<div id="mkdf-testimonials<?php echo esc_attr($current_id) ?>" class="mkdf-testimonial-content <?php echo esc_attr($testimonial_type); ?>">
    <div class="mkdf-testimonial-content-inner">
        <div class="mkdf-testimonial-text-holder">
            <div class="mkdf-testimonial-text-inner">
                <h2 class="mkdf-testimonial-text <?php echo esc_attr($light_class); ?>"><?php echo trim($text) ?></h2>
                <?php if($show_author == "yes") { ?>
                    <div class="mkdf-testimonial-author">
                        <h6 class="mkdf-testimonial-author-text <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($author) ?></h6>
                        <?php if($show_position == "yes" && $job !== '') { ?>
                            <span class="mkdf-testimonials-job <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($job) ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
