<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<?php sienna_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<?php sienna_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<div class="mkdf-post-info">
					<?php sienna_mikado_post_info(array(
						'date'     => 'yes',
						'category' => 'yes',
						'comments' => 'yes',
						'like'     => 'yes'
					)) ?>
				</div>
				<?php sienna_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php
				sienna_mikado_excerpt($excerpt_length);
				$args_pages = array(
					'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '%'
				);

				wp_link_pages($args_pages);
				?>
			</div>
			<div class="mkdf-author-desc clearfix">
				<div class="mkdf-image-name">
					<div class="mkdf-author-image">
						<?php echo sienna_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
					</div>
					<div class="mkdf-author-name-holder">
						<h5 class="mkdf-author-name">
							<?php
							if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
								echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
							} else {
								echo esc_attr(get_the_author_meta('display_name'));
							}
							?>
						</h5>
					</div>
				</div>
				<div class="mkdf-share-icons">
					<?php $post_info_array['share'] = sienna_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
					<?php if($post_info_array['share'] == 'yes'): ?>
						<span class="mkdf-share-label"><?php esc_html_e('Share', 'sienna'); ?></span>
					<?php endif; ?>
					<?php echo sienna_mikado_get_social_share_html(array(
						'type'      => 'list',
						'icon_type' => 'normal'
					)); ?>
				</div>
			</div>
		</div>
	</div>
</article>