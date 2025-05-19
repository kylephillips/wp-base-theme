/**
* Primary Theme Scripts Initialization
*
*/
var Theme = Theme || {};
document.addEventListener("DOMContentLoaded", (event) => {
	new Theme.Factory;
});

/**
* Primary factory class
*/
Theme.Factory = function() {

	var self = this;

	self.build = () => {
		new Theme.ScrollTo;
		new Theme.Modals;
		new Theme.FieldLabels;
	}

	return self.build();
}