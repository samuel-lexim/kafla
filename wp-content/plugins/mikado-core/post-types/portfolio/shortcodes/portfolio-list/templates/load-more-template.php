<?php if($query_results->max_num_pages > 1) { ?>
	<div class="mkdf-ptf-list-paging">
		<span class="mkdf-ptf-list-load-more">
			<?php if(mkd_core_theme_installed()) : ?>
				<?php
				echo sienna_mikado_get_button_html(array(
					'link' => 'javascript: void(0)',
					'text' => esc_html__('Load More', 'mkd_core'),
					'type' => 'solid',
					'size' => 'small',
					'custom_attrs' => array(
						'data-loading-label' => esc_html__('Loading...', 'mkd_core')
					)
				));
				?>
			<?php else: ?>
				<a data-loading-label="<?php esc_html_e('Loading...', 'mkd_core'); ?>" href="javascript: void(0)"><?php esc_html_e('Load More', 'mkd_core'); ?></a>
			<?php endif; ?>
		</span>
	</div>
<?php }