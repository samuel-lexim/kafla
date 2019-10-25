	<div class="mkdf-team-slider-holder">
		<div class="mkdf-team-slider-holder-inner">
			<div class="mkdf-team-slider-content" >
				<div class="mkdf-team-slider-content-inner">			

					<?php if(!empty($title)) : ?>
						<h2 class="mkdf-team-slider-title"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>

					<?php if(!empty($description)) : ?>
						<div class="mkdf-team-slider-description">
							<p><?php echo esc_html($description); ?></p>
						</div>
					<?php endif; ?>
					<!-- Cuto above -->
					<!-- End cut to -->

				</div>
			</div>
			<div class="mkdf-team-slider-navigation-holder">
				<a href="javascript: void(0)" class="mkdf-team-slider-prev">
					<?php echo sienna_mikado_icon_collections()->renderIcon('arrow_carrot-left', 'font_elegant'); ?>
				</a>
				<a href="javascript: void(0)" class="mkdf-team-slider-next">
					<?php echo sienna_mikado_icon_collections()->renderIcon('arrow_carrot-right', 'font_elegant'); ?>
				</a>
			</div>		
			<div class="mkdf-team-slider" >
				<?php echo do_shortcode($content); ?>
			</div>
		</div>
	</div>

