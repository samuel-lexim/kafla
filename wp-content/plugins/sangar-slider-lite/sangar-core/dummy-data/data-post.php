<?php

/**
 * Set dummy data
 */
function sslider_dummy_data_post()
{
	$data = array();
	$post_type = 'post';

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/racing_gp3.jpg',
		'category' => array('Sangar Slider','Racing'),
		'post' => array(
            'post_title'     => "Donec finibus tellus convallis",
            'post_content'   => "Suspendisse sodales lobortis dui sit amet rutrum. Duis eget fringilla justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum aliquam est eu erat pulvinar, sit amet facilisis quam gravida. Vestibulum nulla magna, tempus sit amet rutrum bibendum, efficitur a est. Cras mi risus, fringilla vel sodales id, malesuada id erat. Duis eleifend vestibulum sapien sit amet consequat.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Suspendisse sodales lobortis dui sit amet rutrum. Duis eget fringilla justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas"
        )
	);

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/business_1.jpg',
		'category' => array('Sangar Slider','Business'),
		'post' => array(
            'post_title'     => "Nullam placerat pulvinar felis",
            'post_content'   => "Suspendisse mollis massa at lacus suscipit, non fringilla arcu aliquam. Pellentesque quis interdum augue. Suspendisse consectetur ex in aliquam tincidunt. Vestibulum sed mi eu libero porttitor placerat. Nulla quis porta elit. Integer cursus eget arcu a dapibus. In lobortis ac leo nec placerat. Duis ut auctor quam, eu iaculis erat. Duis dapibus vestibulum pharetra.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Suspendisse mollis massa at lacus suscipit, non fringilla arcu aliquam. Pellentesque quis interdum augue. Suspendisse consectetur ex in aliquam tincidunt"
        )
	);

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/motorbike_road.jpg',
		'category' => array('Sangar Slider','Travel'),
		'post' => array(
            'post_title'     => "Praesent sodales orci facilisis",
            'post_content'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus. Cras porttitor eleifend tincidunt. In hac habitasse platea dictumst. Etiam orci erat, congue malesuada metus quis, pharetra pretium ante. Nullam rutrum, sem eget efficitur porta, velit sem pretium diam, in auctor purus magna eu metus. Integer leo ante, commodo nec nulla pellentesque, luctus vestibulum nisl.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus"
        )
	);

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/man_and_guitar_2.jpg',
		'category' => array('Sangar Slider','Music'),
		'post' => array(
            'post_title'     => "Vivamus id neque sit amet ipsum",
            'post_content'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor. Vivamus id neque sit amet ipsum viverra euismod sit amet rutrum felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed fermentum orci et ligula eleifend congue. Donec malesuada risus ut orci iaculis ornare. Suspendisse lacus nibh, feugiat ac quam aliquam, vehicula faucibus ante. Cras id lacus a ligula placerat dignissim vitae non purus. Mauris ut erat magna.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor"
        )
	);

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/road_bike.jpg',
		'category' => array('Sangar Slider','Sport'),
		'post' => array(
            'post_title'     => "Donec porta arcu eu mi venenatis",
            'post_content'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lacinia, nulla sed sodales dictum, odio felis mattis mauris, at dictum metus turpis et lacus. Donec porta arcu eu mi venenatis, et ultricies metus tincidunt. Maecenas mollis fringilla leo sit amet ultricies. Fusce volutpat sagittis mattis. Cras in condimentum turpis, in rhoncus nulla. Sed quis porta felis, id convallis quam. Sed porta cursus metus ultrices aliquam. Mauris imperdiet, justo at mollis malesuada, quam nibh volutpat urna, nec pharetra dui dolor non risus.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lacinia, nulla sed sodales dictum, odio felis mattis mauris, at dictum metus turpis et lacus"
        )
	);

	$data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/racing_legend.jpg',
		'category' => array('Sangar Slider','Racing'),
		'post' => array(
            'post_title'     => "Pellentesque habitant tristique",
            'post_content'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor. Vivamus id neque sit amet ipsum viverra euismod sit amet rutrum felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed fermentum orci et ligula eleifend congue. Donec malesuada risus ut orci iaculis ornare. Suspendisse lacus nibh, feugiat ac quam aliquam, vehicula faucibus ante. Cras id lacus a ligula placerat dignissim vitae non purus. Mauris ut erat magna. ",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor"
        )
	);

	$data[] = array(
        'image' => 'http://sangarslider.com/remote-dummy-data/post-images/music_concert.jpg',
        'category' => array('Sangar Slider','Music'),
        'post' => array(
            'post_title'     => "Mauris fermentum ultrices eget",
            'post_content'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus. Cras porttitor eleifend tincidunt. In hac habitasse platea dictumst. Etiam orci erat, congue malesuada metus quis, pharetra pretium ante. Nullam rutrum, sem eget efficitur porta, velit sem pretium diam, in auctor purus magna eu metus. Integer leo ante, commodo nec nulla pellentesque, luctus vestibulum nisl. Praesent condimentum, libero et eleifend sodales, mauris ligula commodo tortor, lacinia pharetra ex mi ut eros. Phasellus in nunc ac sapien porta placerat quis eget risus. Vivamus scelerisque mi at nisl facilisis tempor. Aenean ut risus massa. Sed porta id nulla eget accumsan. Praesent sodales orci facilisis, cursus sapien consequat, tincidunt purus. Donec in neque enim. Nam id est consectetur, fermentum magna ac, dapibus nunc.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus"
        )
    );

    $data[] = array(
        'image' => 'http://sangarslider.com/remote-dummy-data/post-images/travel_prepare.jpg',
        'category' => array('Sangar Slider','Travel'),
        'post' => array(
            'post_title'     => "Mauris placerat sem vel vehicula",
            'post_content'   => "Aenean sagittis orci sed libero rhoncus egestas. Etiam quis ullamcorper nibh. Mauris placerat sem vel turpis vehicula aliquet id nec dolor. Vivamus id convallis tortor, vel rutrum urna. Vivamus venenatis ex nec ante auctor, sit amet venenatis massa viverra. Sed dolor metus, porttitor ac massa eget, mattis molestie justo. Proin aliquam sem ac neque ultrices, in tristique neque pellentesque. Donec commodo, augue scelerisque aliquam suscipit, elit eros tristique ligula, vel venenatis lectus erat ac augue. Curabitur accumsan feugiat urna sed sollicitudin.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Aenean sagittis orci sed libero rhoncus egestas. Etiam quis ullamcorper nibh. Mauris placerat sem vel turpis vehicula aliquet id nec dolor vivamus id convallis tortor"
        )
    );

    $data[] = array(
		'image' => 'http://sangarslider.com/remote-dummy-data/post-images/nbl_sport.jpg',
		'category' => array('Sangar Slider','Sport'),
		'post' => array(
            'post_title'     => "Curabitur blandit consectetur elit",
            'post_content'   => "Suspendisse ultricies et quam viverra pretium. Sed non tristique turpis, eu placerat massa. Curabitur blandit consectetur elit, non aliquet ante cursus sit amet. Nam at risus sed ipsum rhoncus rhoncus quis vel leo. Nullam imperdiet, arcu convallis laoreet tincidunt, augue erat faucibus odio, ut venenatis ligula turpis vel lectus. Curabitur ullamcorper mollis dolor, ut dignissim neque finibus vitae. Nulla et tellus in ipsum pretium porta nec eu dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque efficitur mi a nulla posuere, eget condimentum urna blandit.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Suspendisse ultricies et quam viverra pretium. Sed non tristique turpis, eu placerat massa. Curabitur blandit consectetur elit, non aliquet ante cursus sit amet"
        )
	);

	return $data;
}