/**
* Add Theme-specific inline formats available in the block editor
*/
(function(wp){
	/**
	* All caps intro text
	*/
	var AllCapsButton = function (props) {
		return wp.element.createElement( wp.editor.RichTextToolbarButton, {
			icon: 'heading',
			title: 'All Caps Intro',
			onClick: function(){
				props.onChange(
                    wp.richText.toggleFormat( props.value, {
                        type:'base/all-caps-intro',
                    })
                );
			},
		} );
	};
	wp.richText.registerFormatType('base/all-caps-intro', {
		title: 'All Caps Intro',
		tagName: 'span',
		className: 'all-caps-intro',
		edit: AllCapsButton,
	});
})(window.wp);