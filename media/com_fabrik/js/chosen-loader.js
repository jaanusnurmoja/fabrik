/**
 * For:
 * https://github.com/Fabrik/fabrik/issues/1659
 * We can't/shouldn't use any Joomla html behavior code to load in js as
 * when you open a modal ajax form JQuery reloads and references to the original jQuery
 * become confused.
 * So in our html helper we load the chosen css and this file as default and set up
 * an interval timer function to call Fabrik.buildChosen (kinda odd but works!)
 * And in ajax loaded forms we re-call Fabrik.buildChosen function
 */
require(['fab/fabrik', 'jquery'], function (Fabrik, $) {
    if (!Fabrik.buildChosen) {
        Fabrik.buildChosen = function (selector, options)
        {
            if ($(selector).chosen !== undefined) {
                return $(selector).chosen(options);
            }
       };
	
	    /**		
         * Build Ajax chosen		
         * @param {string}   selector		
         * @param {object}   options		
         * @param {function} func		
        */		
        Fabrik.buildAjaxChosen = function (selector, options, func) {		
            if ($(selector).ajaxChosen !== undefined) {		
                return $(selector).ajaxChosen(options, func);		
			}		
		}
	}
});