<?php

$reconstruct_original_image_id = get_post_meta( get_the_ID(), '_reconstruct_original_image', true );
$reconstruct_revised_image_id = get_post_meta( get_the_ID(), '_reconstruct_revised_image', true );

$original_image = wp_get_attachment_image_src( $reconstruct_original_image_id, 'large' );
$revised_image = wp_get_attachment_image_src( $reconstruct_revised_image_id, 'large' );

?>

<div id="before-after-<?php echo the_ID(); ?>" class="before-after">
	<div><img alt="before" src="<?php echo $original_image[0]; ?>" width="<?php echo $original_image[1]; ?>" height="<?php echo $original_image[2]; ?>"></div>
	<div><img alt="after" src="<?php echo $revised_image[0]; ?>" width="<?php echo $revised_image[1]; ?>" height="<?php echo $revised_image[2]; ?>"></div>
</div>

<script>
jQuery(document).ready(function($) {"use strict";
	$('#before-after-<?php echo the_ID(); ?>').beforeAfter({
		imagePath : './content/themes/enterprise/js/beforeafter/',
		animateIntro:true,
		showFullLinks : true,
		beforeLinkText: 'Show before image',
		afterLinkText: 'Show after image',
		cursor: 'e-resize',
		enableKeyboard: true,
		dividerColor: '#f00'
	});
});
</script>