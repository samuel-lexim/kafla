<div class="mkdf-process-holder">

	<h2 class="mkdf-process-digit">
		<?php echo esc_html($digit); ?>
	</h2>

	<div class="mkdf-text-holder">
		<h5 class="mkdf-process-title">
			<?php echo esc_html($title); ?>
		</h5>

		<?php if($text != "") { ?>
			<p class="mkdf-process-text"><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>