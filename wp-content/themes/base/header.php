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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>