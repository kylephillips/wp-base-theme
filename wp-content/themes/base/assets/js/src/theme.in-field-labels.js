/**
* In-Field Form Labels
* Adds material-like transition when focusing in field
*/
var Theme = Theme || {};
Theme.FieldLabels = function()
{
	var self = this;
	var $ = jQuery;

	self.selectors = {
		field : '.in-field', // selector for field
		formBody : '.gform_body', // Form Body
		label : '.in-field label', // Form Body
		active : 'active' // Active state class
	}

	self.bindEvents = function()
	{
		$(document).ready(function(){
			self.adjustAllFields();
		});
		$(document).on('focus', 'input', function(){
			self.fieldLabels($(this), 'focus');
		});
		$(document).on('focusout', 'input', function(){
			self.fieldLabels($(this), 'blur');
		});
		$(document).on('focus', 'textarea', function(){
			self.fieldLabels($(this), 'focus');
		});
		$(document).on('focusout', 'textarea', function(){
			self.fieldLabels($(this), 'blur');
		});
		$(document).on('click', self.selectors.label, function(){
			self.labelFocus($(this));
		});
		$(document).on('gform_post_render', function(){
   			self.adjustAllFields();
   		});
   		$(document).on('updated_checkout', function(){
   			self.adjustAllFields();
   		});
   		$(document).on('update_checkout', function(){
   			self.adjustAllFields();
   		});
   		$(document).on('init_checkout', function(){
   			self.adjustAllFields();
   		});
   		$(document).on('updated_shipping_method', function(){
   			self.adjustAllFields();
   		});
   		$(document).on('woocommerce-invoice-payment-billing-fields-toggled', function(){
   			setTimeout(function(){
   				self.adjustAllFields();
   			},200);
   		});
	}

	self.adjustAllFields = function()
	{
		var fields = $(self.selectors.field);
		$.each(fields, function(){
			var input = $(this).find('input');
			self.fieldLabels($(input));
		});
	}

	/**
	* Fix for FF & Safari, where clicking directly on the label does not focus/trigger
	*/
	self.labelFocus = function(label)
	{
		var field = $(label).parents(self.selectors.field);
		var state = ( $(field).hasClass(self.selectors.active) ) ? 'blur' : 'focus';
		var input = $(field).find('input');
		self.fieldLabels(input, state);
		if ( $(label).hasClass('active') ) {
			$(input).focus();
		}
	}

	self.fieldLabels = function(input, state)
	{
		if ( $(input).parents(self.selectors.field).length < 1 ) return;
		if ( typeof state === 'undefined' || state === '' ){
			var value = $(input).val();
			var state = ( value !== '' ) ? 'focus' : 'blur';
		}
		if ( state === 'focus'){
			$(input).parents(self.selectors.field).find('label').addClass(self.selectors.active);
			$(input).parents(self.selectors.formBody).addClass(self.selectors.active);
			return;
		} 
		if ( state === 'blur' ) {
			if ( $(input).val() !== '' ) return;
			$(input).parents(self.selectors.field).find('label').removeClass(self.selectors.active);
			$(input).parents(self.selectors.formBody).removeClass(self.selectors.active);
			return;
		}
		// Loading
		if ( $(input).val() === '' ) return;
		$(input).parents(self.selectors.formBody).addClass(self.selectors.active);
		$(input).parents(self.selectors.field).find('label').addClass(self.selectors.active);
	}

	return self.bindEvents();
}