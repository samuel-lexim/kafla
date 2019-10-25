<div class="mkdf-fullscreen-search-holder">
	<div class="mkdf-fullscreen-search-close-container">
		<div class="mkdf-search-close-holder">
			<a class="mkdf-fullscreen-search-close" href="javascript:void(0)">
				<?php print $search_icon_close; ?>
			</a>
		</div>
	</div>
	<div class="mkdf-fullscreen-search-table">
		<div class="mkdf-fullscreen-search-cell">
			<div class="mkdf-fullscreen-search-inner">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="mkdf-fullscreen-search-form" method="get">
					<div class="mkdf-form-holder">
						<div class="mkdf-field-holder">
							<input type="text" name="s" placeholder="<?php esc_html_e('Search on site...', 'sienna'); ?>" class="mkdf-search-field" autocomplete="off"/>

							<div class="mkdf-line"></div>
							<input type="submit" class="mkdf-search-submit" value="&#xf002;"/>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>