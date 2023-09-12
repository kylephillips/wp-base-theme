/**
* Modal Windows
* 
* To use, include a modal backdrop and modal content window with the appropriate data-attributes
* The data attributes should match the value of the toggle buttons data-modal-toggle attribute
* Alternatively, a standard link that references the modal ID will open the modal (with a hash) 
* So, a modal with an id of "example" could be opened by a link with an href of "#example"
*/
var Theme = Theme || {};
Theme.Modals = function()
{
	var self = this;

	self.activeBtn = '';
	self.activeModal = '';
	self.modalOpen = false;

	self.selectors = {
		toggleBtn : '[data-modal-toggle]',
		backdrop : '[data-modal-backdrop]',
		closeBtn : '[data-modal-close]',
		modal : '[data-modal]'
	}

	self.bindEvents = function()
	{
		document.addEventListener('click', function(e){
			
			const toggleBtn = e.target.closest(self.selectors.toggleBtn);
			const closeBtn = e.target.closest(self.selectors.closeBtn);
			const backdrop = e.target.closest(self.selectors.backdrop);
			const link = e.target.closest('a');
			
			if ( toggleBtn ){
				e.preventDefault();
				self.activeBtn = toggleBtn;
				self.openModal();
			}

			if ( closeBtn ){
				e.preventDefault();
				self.closeModals();
			}

			if ( backdrop ){
				self.closeModals();
			}

			if ( link ){ // catch-all for targeting modal by data-attribute
				const href = link.getAttribute("href");
				if ( !href.includes('#') ) return;
				var modal = document.querySelectorAll('*[data-modal="' + href.replace('#', '') + '"]');
				if ( modal.length < 1 ) return;
				e.preventDefault();
				self.openModal(href.replace('#', ''));
			}
		});

		document.onkeydown = (e) => {
			if ( e.keyCode === 27 ) self.closeModals();
		}

		// Use to listen for open events (example only)
		document.addEventListener(
			"open-modal",
			(e) => {
				// Do stuff here
			}, 
			false,
		);

		// Use to listen for close events (example only)
		document.addEventListener(
			"close-modal",
			(e) => {
				// Do stuff here
			}, 
			false,
		);
	}

	/**
	* Open the Modal Window
	*/
	self.openModal = (modal) =>
	{
		if ( self.modalOpen ){
			self.closeModals();
			return;
		}
		modal = ( typeof modal !== 'undefined' ) ? modal : self.activeBtn.dataset.modal;
		self.activeModal = document.querySelectorAll('*[data-modal="' + modal + '"]');
		self.activeModal.forEach(el => { el.classList.add('active') });
		document.body.classList.add('modal-open');
		self.modalOpen = true;
		const event = new CustomEvent("open-modal", { button: self.activeBtn, modal: self.activeModal });
		document.dispatchEvent(event);
	}

	/**
	* Close the Modal Window
	*/
	self.closeModals = () =>
	{
		self.modalOpen = false;
		self.activeModal = null;
		const modal = document.querySelectorAll(self.selectors.modal);
		modal.forEach(el => { el.classList.remove('active') });
		document.body.classList.remove('modal-open');
		const event = new CustomEvent("close-modal", { button: self.activeBtn, modal: self.activeModal });
		document.dispatchEvent(event);
	}

	return self.bindEvents();
}