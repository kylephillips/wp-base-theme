/**
* Smoothly Scroll to an element
*/
var Theme = Theme || {};
Theme.ScrollTo = function()
{
	var self = this;

	self.selectors = {
		inPageNavLink : 'data-in-page-nav-link',
		toggleButton : 'data-in-page-nav-toggle',
		backToTopButton: 'data-back-to-top',
		stickyElement : 'data-sticky-element'
	}

	self.bindEvents = function()
	{
		document.addEventListener('click', function(e){

			const link = e.target.closest('a');
			if ( !link ) return;
			const href = link.getAttribute("href");
			if ( !href.includes('#scroll-to') ) return;
			e.preventDefault();
			const target = href.replace('#scroll-to-', '');
			const el = document.getElementById(target);
			if ( !el ) return;
			target.scrollIntoView({
				behavior: 'smooth'
			});
		});
	}

	/**
	* Scroll to a link
	*/
	self.scrollToLink = function(target)
	{
		target.scrollIntoView({
			behavior: 'smooth'
		});
	}

	return self.bindEvents();
}