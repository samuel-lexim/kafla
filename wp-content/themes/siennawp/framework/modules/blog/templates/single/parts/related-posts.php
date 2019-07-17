<div class="col-md-4">
	<div class="box-sidebar1">
	    <div class="related-articles">
	    	<?php if($related_posts && $related_posts->have_posts()) : ?>
	        <span class="title-related">Related Articles</span>
	        <ul class="sidebar-related">
	        	<?php while($related_posts->have_posts()) :
					$related_posts->the_post();?>
	            <li class="list-related"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('<h4>', '</h4>'); ?></a></li>
	            <?php
				endwhile; ?>
	        </ul>
	        <?php endif;
		wp_reset_postdata();
		?>
	    </div>
	</div>
</div>