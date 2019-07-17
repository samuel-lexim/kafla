<?php 
	$current_all = '';
	$current_trash = '';

	// delete
	if(isset($_GET['delete']))
	{
		$id = $_GET['id'];

		if($_GET['delete'] == 'trash') {
			wp_trash_post($_GET['id']);
		} 
		else if($_GET['delete'] == 'permanently') {
			wp_delete_post($_GET['id'], true);
		} 
		else if($_GET['delete'] == 'untrash') {
			wp_untrash_post($_GET['id']);
		}
	}

	// addon
	if(isset($_GET['addon'])) {
		$create_post_type = $_GET['addon']; // single addons
	}
	else
	{
		$sslider_addons = apply_filters('sangar_slider_addons',array());
		$create_post_type = array();
		
		// all addons				
		foreach ($sslider_addons as $key => $value) {
			$create_post_type[] = $key;
		}
	}

	// post_status
	if(isset($_GET['trash']) && $_GET['trash'] == 'yes') 
	{
		$current_trash = 'current';

		// all
		$sslider = new WP_Query(array(
			'post_type' => $create_post_type,
			'post_status' => array('publish','pending','draft'),
			'posts_per_page' => -1
		));

		$all_count = $sslider->found_posts;
		wp_reset_query();

		// trash
		$sslider = new WP_Query(array(
			'post_type' => $create_post_type,
			'post_status' => array('trash'),
			'posts_per_page' => -1
		));

		$trash_count = $sslider->found_posts;		
	} 
	else 
	{
		$current_all = 'current';

		// trash
		$sslider = new WP_Query(array(
			'post_type' => $create_post_type,
			'post_status' => array('trash'),
			'posts_per_page' => -1
		));

		$trash_count = $sslider->found_posts;
		wp_reset_query();

		// all
		$sslider = new WP_Query(array(
			'post_type' => $create_post_type,
			'post_status' => array('publish','pending','draft'),
			'posts_per_page' => -1
		));

		$all_count = $sslider->found_posts;
	}

	// query string
	$query_string = str_replace('page=sangar_slider_admin', '', $_SERVER['QUERY_STRING']);
	$query_string = apply_filters('sangar_slider_delete_query', array('delete', $query_string));
	$query_string = apply_filters('sangar_slider_delete_query', array('id', $query_string));

	$all = str_replace('&trash=yes', '', $query_string);
	$trash = $all . '&trash=yes';

	// generate link	
	$all_link = admin_url('admin.php?page=sangar_slider_admin' . $all);
	$trash_link = admin_url('admin.php?page=sangar_slider_admin' . $trash);
	$current_link = admin_url('admin.php?page=sangar_slider_admin' . $query_string);

	// current count
	$current_count = $sslider->found_posts;

	function delete_query($key, $url) {
        $url = preg_replace('/(.*)(\?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
        $url = substr($url, 0, -1);

        return $url;
    }
?>

<div class="wrap" id="sangar-slider-admin">
	<header class="sslide-header">
		<span class='h1'>Sangar Slider</span>

		<ul class="subsubsub" id="sslide-slide-location">
			<li class="all">
				<a href="<?php echo $all_link ?>" class="<?php echo $current_all ?>">All <span class="count">(<?php echo $all_count ?>)</span></a> |
			</li>
			<li class="trash">
				<a href="<?php echo $trash_link ?>" class="<?php echo $current_trash ?>">Trash <span class="count">(<?php echo $trash_count ?>)</span></a>
			</li>
		</ul>

		<?php
			$sslider_addons = apply_filters('sangar_slider_addons',array());
					
			if(count($sslider_addons) > 1):
		?>

		<div class="tablenav top">
			<select id="sslider-slide-addons-selection">
				<option value=''>All Slideshow</option>

				<?php			
					$selected = isset($_GET['addon']) ? $_GET['addon'] : '';

					foreach($sslider_addons as $key => $value) 
					{
						$attr_selected = $key == $selected ? 'selected' : '';

			    		echo "<option $attr_selected value='$key'>{$value['name']}</option >";
			    	}
				?>
			</select>

			<a id="sslider-slide-addons-selection-button" class="button">Apply</a>
		</div>

		<?php endif; ?>

		<div class="tablenav top button-box">
			<!-- add slide button -->
			<?php if(count($sslider_addons) > 1): ?>
				<a class="button button-primary" href="javascript:;" id="sslider-slideshow-add-dialog-button">Add New Slider</a>
			<?php else: ?>
				<a class="button button-primary" href="<?php echo admin_url('post-new.php?post_type=sangar_slider') ?>">Add Slide</a>
			<?php endif ?>

			<!-- ads for lite version -->
			<?php if(SANGAR_SLIDER_ACTIVATED == 'Lite'): ?>
				<a class="button button-primary button-important" id="sslider-button-promo">Get Sangarslider Pro</a>
			
				<!-- promo modal dialog -->
				<div id='sslider-modal-promo' title="" style="display:none;">
				    <div class="button-box">
				        <a href="http://coba.tonjoostudio.com/wp-admin/" target="_blank" class="button button-blue"><img src="<?php echo SANGAR_SLIDER_DIR_URL ?>/images/icon_btn_demo.png">Live Demo</a>
				        <a href="http://sangarslider.com/wordpress-pro/?utm_source=wp_dashboard&utm_medium=link_update&utm_campaign=ss" target="_blank" class="button button-orange"><img src="<?php echo SANGAR_SLIDER_DIR_URL ?>/images/icon_btn_upgrade.png">Upgrade Now!</a>
				    </div>
				    <img class="banner-bg" src="<?php echo SANGAR_SLIDER_DIR_URL ?>/images/banner_premium_bg.png">
				</div>
			<?php endif ?>
		</div>
	</header>

	<table class="wp-list-table widefat fixed striped posts" style="margin-top:10px;">
		<thead>
			<tr>
				<th class="manage-column column_sslider_thumbnail"><span class="dashicons dashicons-format-image"></span></th>
				<th class="manage-column">Title</th>
				<th class="manage-column hide-mobile">Shortcode</th>
				<th class="manage-column hide-mobile">Slide Count</th>
				<th class="manage-column hide-mobile">Date</th>	
			</tr>
		</thead>

		<tbody id="the-list">

			<?php 
				if($current_count <= 0): 

					if($query_string != '')
					{
						$notif = '<td colspan="5">There is no available data. ';
						$notif.= '<a href="'.admin_url('admin.php?page=sangar_slider_admin').'">Show all data</a></td>';
					}
					else {
						$notif = '<td colspan="5">There is no available data. ';
					}

					echo $notif;
			
				else:

					while($sslider->have_posts()): $sslider->the_post();

					$post = $sslider->post;
					
					$sslider_data = get_post_meta($post->ID, 'sslider_data',true);
	    			$sslider_data = unserialize(base64_decode($sslider_data));
	    			
	    			$thumbnail = sslider_get_slideshow_thumbnail($sslider_data,$post);
	    			$slide_count = is_array($sslider_data) ? count($sslider_data) : 0;
	    			$data = date('Y/m/d',strtotime($post->post_date));

	    			$sslider_addons = apply_filters('sangar_slider_addons',array());
	    			$slideshow_type = $sslider_addons[$post->post_type]['name'];

	    			// slide count on post slider
	    			$slide_count = $slideshow_type == 'Post Slider' ? '-' : $slide_count;

	    			$title = get_the_title() == '' ? '(no title)' : get_the_title();

	    			$edit_link = get_edit_post_link($post->ID);

	    			// button setup
	    			if(isset($_GET['trash']) && $_GET['trash'] == 'yes')
	    			{
	    				$first_btn = array(
	    					'text' => 'Restore', 
	    					'title' => 'Restore this item', 
	    					'link' => $current_link . '&delete=untrash&id=' . $post->ID
	    				);

	    				$second_btn = array(
	    					'text' => 'Permanently Delete', 
	    					'title' => 'Permanently delete this item', 
	    					'link' => $current_link . '&delete=permanently&id=' . $post->ID
	    				);
	    			}
	    			else
	    			{
	    				$first_btn = array(
	    					'text' => 'Edit', 
	    					'title' => 'Edit this item', 
	    					'link' => get_edit_post_link($post->ID)
	    				);

	    				$second_btn = array(
	    					'text' => 'Move To Trash', 
	    					'title' => 'Move to trash this item', 
	    					'link' => $current_link . '&delete=trash&id=' . $post->ID
	    				);
	    			}
			?>

			<tr>
				<td class="column_sslider_thumbnail"><?php echo $thumbnail ?></td>
				<td>
					<strong>
						<a class="row-title" href="<?php echo $edit_link ?>" title="Edit “<?php echo $title ?>”"><?php echo $title ?></a>
						<?php if($post->post_status != 'publish') echo " - " . ucfirst($post->post_status); ?>
					</strong>

					<br><span class="sslider-addon-type <?php echo $post->post_type ?>"><?php echo $slideshow_type ?></span>
					<div class="row-actions">
						<span class="edit"><a title="<?php echo $first_btn['title'] ?>" href="<?php echo $first_btn['link'] ?>"><?php echo $first_btn['text'] ?></a> | </span>
						<span class="trash"><a title="<?php echo $second_btn['title'] ?>" href="<?php echo $second_btn['link'] ?>"><?php echo $second_btn['text'] ?></a>
					</div>
				</td>
				<td class="hide-mobile">
					<code>[sangar-slider id=<?php echo $post->ID ?>]</code>
				</td>
				<td class="hide-mobile"><?php echo $slide_count ?></td>
				<td class="hide-mobile"><abbr><?php echo $data ?></abbr><br><?php echo ucfirst($post->post_status) ?></td>
			</tr>		

			<?php endwhile; endif; wp_reset_query(); ?>
				
		</tbody>

		<tfoot>
			<tr>
				<th class="manage-column column_sslider_thumbnail"><span class="dashicons dashicons-format-image"></span></th>
				<th class="manage-column">Title</th>
				<th class="manage-column hide-mobile">Shortcode</th>
				<th class="manage-column hide-mobile">Slide Count</th>
				<th class="manage-column hide-mobile">Date</th>
			</tr>
		</tfoot>

	</table>
</div>

<!-- add slider modal dialog -->
<div id="sslider-slideshow-add-dialog" title="Add New Slider" style="display:none;">
	<?php
		foreach($sslider_addons as $key => $value)
		{
			$href = admin_url('post-new.php?post_type=' . $key);
			$dir = plugin_dir_url($value['directory']);
			$cover = $dir . 'assets/cover.jpg';
			$description = isset($value['description']) ? $value['description'] : 'Description goes here.';

			echo "<a href='$href'><img src='$cover'><span><strong>{$value['name']}</strong>$description</span></a>";
    	}
	?>
</div>