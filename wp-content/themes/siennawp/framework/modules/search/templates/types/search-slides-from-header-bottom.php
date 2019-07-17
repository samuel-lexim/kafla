<form action="<?php echo esc_url(home_url('/')); ?>" class="mkdf-search-slide-header-bottom" method="get">
	<?php if($search_in_grid) { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
			<?php } ?>
			<div class="mkdf-form-holder-outer">
				<div class="mkdf-form-holder">
					<input type="text" placeholder="<?php esc_html_e('Search', 'sienna'); ?>" name="s" class="mkdf-search-field" autocomplete="off"/>
					<a class="mkdf-search-submit" href="javascript:void(0)">
						<?php print $search_icon ?>
					</a>
				</div>
			</div>
			<?php if($search_in_grid) { ?>
		</div>
	</div>
<?php } ?>
</form>