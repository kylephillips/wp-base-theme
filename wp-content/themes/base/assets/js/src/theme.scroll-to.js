/**
* Smoothly Scroll to an element
*/
var Theme = Theme || {};
Theme.ScrollTo = function()
{
	var self = this;
	var $ = jQuery;

	self.selectors = {
		inPageNavLink : 'data-in-page-nav-link',
		toggleButton : 'data-in-page-nav-toggle',
		backToTopButton: 'data-back-to-top',
		stickyElement : 'data-sticky-element'
	}

	self.bindEvents = function()
	{
		$(document).on('click', 'a', function(e){
			var href = $(this).attr('href');
			if ( !href.includes('#scroll-to') ) return;
			e.preventDefault();
			var target = href.replace('scroll-to-', '');
			self.scrollToLink(target);
		});
	}

	/**
	* Scroll to a link
	*/
	self.scrollToLink = function(href)
	{
		var top = $(href).offset().top;
		if ( $('body').hasClass('logged-in') ) top = top - 32;
		$('html, body').animate({
			scrollTop: top
		}, 300);
	}

	return self.bindEvents();
}