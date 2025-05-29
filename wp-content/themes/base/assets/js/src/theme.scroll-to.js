/**
* Smoothly Scroll to an element
*/
var Theme = Theme || {};
Theme.ScrollTo = function()
{
	var self = this;

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
			el.scrollIntoView({
				behavior: 'smooth'
			});
		});
	}

	return self.bindEvents();
}