<?php

/**
 * Set dummy data
 */
function sslider_dummy_data_product()
{
	$data = array();
	$post_type = 'sslider-dummy';
	$images_url = 'http://sangarslider.com/wp-content/uploads/2015/10/';

	$data[] = array(
		'image' => $images_url . 'Q16XY4FN0F-compressor.jpg',
		'category' => 'News',
		'post' => array(
            'post_title'     => "What is Lorem Ipsum?",
            'post_content'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
        )
	);

	$data[] = array(
		'image' => $images_url . 'office_desk_comp.jpg',
		'category' => 'News',
		'post' => array(
            'post_title'     => "Why do we use it?",
            'post_content'   => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters"
        )
	);

	$data[] = array(
		'image' => $images_url . 'my_life_is_comp.jpg',
		'category' => 'News',
		'post' => array(
            'post_title'     => "Where does it come form?",
            'post_content'   => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from 'de Finibus Bonorum et Malorum' by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old"
        )
	);

	$data[] = array(
		'image' => $images_url . 'how_to_get_comp.jpg',
		'category' => 'News',
		'post' => array(
            'post_title'     => "Where can i get some?",
            'post_content'   => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable"
        )
	);

	$data[] = array(
		'image' => $images_url . 'art_is_comp.jpg',
		'category' => 'Sports',
		'post' => array(
            'post_title'     => "Lorem ipsum dolor sit amet",
            'post_content'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lacinia, nulla sed sodales dictum, odio felis mattis mauris, at dictum metus turpis et lacus. Donec porta arcu eu mi venenatis, et ultricies metus tincidunt. Maecenas mollis fringilla leo sit amet ultricies. Fusce volutpat sagittis mattis. Cras in condimentum turpis, in rhoncus nulla. Sed quis porta felis, id convallis quam. Sed porta cursus metus ultrices aliquam. Mauris imperdiet, justo at mollis malesuada, quam nibh volutpat urna, nec pharetra dui dolor non risus. Nulla ac semper libero. Donec at feugiat felis. Morbi a feugiat lacus. Vestibulum at iaculis eros. Nulla rhoncus lobortis eros. Vestibulum pretium, tellus id hendrerit sollicitudin, sapien mi finibus sapien, a varius sapien metus ut ex. Phasellus placerat feugiat metus eget molestie. ",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lacinia, nulla sed sodales dictum, odio felis mattis mauris, at dictum metus turpis et lacus"
        )
	);

	$data[] = array(
		'image' => $images_url . 'picture_is_poem_comp.jpg',
		'category' => 'Sports',
		'post' => array(
            'post_title'     => "Integer pellentesque",
            'post_content'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor. Vivamus id neque sit amet ipsum viverra euismod sit amet rutrum felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed fermentum orci et ligula eleifend congue. Donec malesuada risus ut orci iaculis ornare. Suspendisse lacus nibh, feugiat ac quam aliquam, vehicula faucibus ante. Cras id lacus a ligula placerat dignissim vitae non purus. Mauris ut erat magna. ",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Integer pellentesque non sem eu ultrices. Donec ipsum justo, pulvinar eget condimentum sit amet, tincidunt at mi. Pellentesque cursus mi enim, nec facilisis sapien tempus tempor"
        )
	);

	$data[] = array(
		'image' => $images_url . 'strawberry_comp.jpg',
		'category' => 'Entertainment',
		'post' => array(
            'post_title'     => "Aenean erat nisi",
            'post_content'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus. Cras porttitor eleifend tincidunt. In hac habitasse platea dictumst. Etiam orci erat, congue malesuada metus quis, pharetra pretium ante. Nullam rutrum, sem eget efficitur porta, velit sem pretium diam, in auctor purus magna eu metus. Integer leo ante, commodo nec nulla pellentesque, luctus vestibulum nisl. Praesent condimentum, libero et eleifend sodales, mauris ligula commodo tortor, lacinia pharetra ex mi ut eros. Phasellus in nunc ac sapien porta placerat quis eget risus. Vivamus scelerisque mi at nisl facilisis tempor. Aenean ut risus massa. Sed porta id nulla eget accumsan. Praesent sodales orci facilisis, cursus sapien consequat, tincidunt purus. Donec in neque enim. Nam id est consectetur, fermentum magna ac, dapibus nunc.",
            'post_status'    => "publish",
            'post_type'      => $post_type,
            'post_excerpt'   => "Aenean erat nisi, tempus nec massa vitae, gravida cursus nulla. Nunc lacinia diam sit amet elit gravida, in auctor odio mollis. Integer id pretium orci, a consequat lacus"
        )
	);

	return $data;
}