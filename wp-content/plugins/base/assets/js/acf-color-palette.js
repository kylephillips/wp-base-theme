acf.add_filter('color_picker_args', function( args, $field ){
	var colors = [];
	for ( var i = 0; i < theme_acf.colors.length; i++){
		colors.push(theme_acf.colors[i]['color']);
	};
	args.palettes = colors;
	return args;			
});