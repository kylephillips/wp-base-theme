<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title('-'); ?></title>
	
	<?php wp_site_icon(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=1.0">

	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/ie.css" />
	<![endif]-->

	<!--[if lt IE 9]>
    	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>