/**
* Primary Theme Scripts Initialization
*
*/
var Theme = Theme || {};

jQuery(document).ready(function(){
	new Theme.Factory;
});

/**
* DOM Selectors Used by the Theme
*/
Theme.selectors = {
}

/**
* CSS Classes Used by the theme
*/
Theme.cssClasses = {
	loading : 'loading', // Loading State
	active : 'active', // Active State
}

/**
* Localized JS Data Used by the theme
*/
Theme.jsData = {
}

/**
* Primary factory class
*/
Theme.Factory = function()
{
	var self = this;
	var $ = jQuery;

	self.build = function()
	{
		self.initializeLibraries();
	}

	/**
	* Initialize any 3rd party plugin/libraries required
	*/
	self.initializeLibraries = function()
	{
		new Theme.ScrollTo;
		new Theme.Modals;
		$('body').fitVids();
	}

	return self.build();
}