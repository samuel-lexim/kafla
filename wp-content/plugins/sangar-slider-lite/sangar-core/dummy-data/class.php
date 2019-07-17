<?php

Class ssliderDummyPost 
{
	function __construct($post_type, $taxonomy)
	{
		$this->post_type = $post_type;
		$this->taxonomy = $taxonomy;
		$this->default_term_id = 0;
	}

	public function insert()
	{
		$posts = get_option('sslider_dummy_posts_' . $this->post_type);

		if(! $posts) {
			$this->insert_terms();
			$this->insert_posts();
			$this->create_new_slider();
		}
	}

	private function insert_terms()
	{
		$terms = array(
			'post' => array('Sangar Slider','Business','Music','Racing','Sport','Travel'),
			'product' => array('Sangar Slider','Adidas T-Shirt','Apple Watch',
				'Camera','Casio Watch','Furniture','Motorola Smartphone','Nike Shoe')
		);

		$inserted_pid = array();

		foreach ($terms[$this->post_type] as $key => $value) {
			$pid = wp_insert_term($value, $this->taxonomy);
			$inserted_pid[] = isset($pid['term_id']) ? $pid['term_id'] : false;

			// get default term id
			if($value == 'Sangar Slider') {
				$this->default_term_id = $pid['term_id'];
			}
		}

		// save to option
		update_option('sslider_dummy_terms_' . $this->post_type, serialize($inserted_pid));
	}

	private function insert_posts()
	{
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		// add action to set post thumbnail
		add_action('add_attachment', array($this, 'action_set_post_thumbnail'));

		$data_function = "sslider_dummy_data_{$this->post_type}";
		$data = $data_function();
		$inserted_pid = array();

		foreach ($data as $key => $value)
		{
			$value['post']['post_category'] = array($this->default_term_id); // set default term
			$pid = wp_insert_post($value['post']); // add new post
	        wp_set_object_terms($pid, $value['category'], $this->taxonomy, true); // set category
	        media_sideload_image($value['image'], $pid); // import image
	        $inserted_pid[] = $pid;
		}

		// save to option
		update_option('sslider_dummy_posts_' . $this->post_type, serialize($inserted_pid));
		
		// remove action to set post thumbnail
	    remove_action('add_attachment', array($this, 'action_set_post_thumbnail'));
	}

	public function action_set_post_thumbnail($att_id)
	{
	    $p = get_post($att_id);
	    set_post_thumbnail($p->post_parent, $att_id);
	}

	public function delete()
	{
		// delete datas
		$this->delete_terms();
		$this->delete_attachments();
		$this->delete_posts();

		// delete options
		delete_option('sslider_dummy_terms_' . $this->post_type);
		delete_option('sslider_dummy_posts_' . $this->post_type);

		// delete dummy slider
		$dummy_slider_id = get_option('sslider_dummy_slider_id');		
		wp_delete_post($dummy_slider_id[$this->post_type], true);
	}

	private function delete_terms()
	{
		$inserted_pid = get_option('sslider_dummy_terms_' . $this->post_type);

		if(! $inserted_pid) return;

		foreach (unserialize($inserted_pid) as $key => $value) {
			wp_delete_term($value, $this->taxonomy);
		}
	}

	private function delete_attachments()
	{
		$inserted_pid = get_option('sslider_dummy_posts_' . $this->post_type);
		
		if(! $inserted_pid) return;
		
		foreach (unserialize($inserted_pid) as $key => $value) {
			wp_delete_attachment(get_post_thumbnail_id($value), true);
		}		
	}

	private function delete_posts()
	{
		$inserted_pid = get_option('sslider_dummy_posts_' . $this->post_type);

		if(! $inserted_pid) return;

		foreach (unserialize($inserted_pid) as $key => $value) {
			wp_delete_post($value, true);
		}
	}

	private function create_new_slider()
	{
		switch($this->post_type) 
		{
			case 'post':
				$title = "Post Slider With Dummy Data";
				$post_type = "sangar_slider_post";
				$filename = "new-slider-post.txt";
				break;

			case 'product':
				$title = "Product Slider With Dummy Data";
				$post_type = "sangar_slider_shop";
				$filename = "new-slider-shop.txt";
				break;

			default:
				$title = "Lorem Ipsum";
				$post_type = "post";
				$filename = "nofile.txt";
				break;
		}

		$post = array(
            'post_title'     => $title,
            'post_status'    => "publish",
            'post_type'      => $post_type
        );

        $pid = wp_insert_post($post); // add new post
        $sslider_data_url = plugin_dir_path( __FILE__ ) . $filename;

        $this->save_dummy_slider_id($pid); // save id for view link

        if(file_exists($sslider_data_url)) 
        {
            $sslider_data = file_get_contents($sslider_data_url, FILE_USE_INCLUDE_PATH);
        	
            // update dummy category selection
        	$arrData = unserialize(base64_decode($sslider_data));
        	$dummy_category_selection = $this->taxonomy . '::' . $this->default_term_id;
        	$arrData['post-slider']['sangar_query_terms'][0][0] = $dummy_category_selection;

        	// save to post meta
        	$sslider_data = base64_encode(serialize($arrData));
        	update_post_meta($pid,'sslider_data',$sslider_data);
        }

        // slider config, save to post meta
        $config = ssliderDefault::config(array(),$post_type);
        update_post_meta($pid,'sslider_config',base64_encode(serialize($config)));
	}

	private function save_dummy_slider_id($pid)
	{
		// dummy slider id
        $dummy_slider_id = get_option('sslider_dummy_slider_id');

        if($dummy_slider_id && is_array($dummy_slider_id)) {
        	$dummy_slider_id[$this->post_type] = $pid;
        }
        else {
        	$dummy_slider_id = array();
        	$dummy_slider_id[$this->post_type] = $pid;
        }

        update_option('sslider_dummy_slider_id',$dummy_slider_id);
	}

	static function status()
	{
		$post_data = get_option('sslider_dummy_posts_post');
		$product_data = get_option('sslider_dummy_posts_product');

		// post
		if($post_data) 
		{
			$count = count(unserialize($post_data));
			echo '<p><b>Post Dummy Data</b> data has been imported, total <code>' . $count . '</code> datas.</p>';
		}

		// product
		if($product_data)
		{
			$count = count(unserialize($product_data));
			echo '<p><b>Product Dummy Data</b> data has been imported, total <code>' . $count . '</code> datas.</p>';
		}

		// there is or not
		if(!$post_data && !$product_data) {
			echo "<p>No data has been imported.</p>";
		}
		else {
			echo "<p>To re-import data, you must delete the data first by access the <code>Delete</code> button.</p>";
		}
	}

	static function get_dummy_slider_link($post_type)
	{
		$dummy_slider_id = get_option('sslider_dummy_slider_id');
		
		if($dummy_slider_id && (isset($dummy_slider_id[$post_type]) && $dummy_slider_id[$post_type] != '')) {
			echo get_edit_post_link($dummy_slider_id[$post_type]);
		}
		else {
			echo "javascript:;";
		}
	}
}