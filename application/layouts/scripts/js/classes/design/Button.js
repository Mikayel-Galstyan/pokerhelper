/**
* Buttons enabling and disabling.
*
* @author sourcio.com
* 
*/

function Button() {
	/**
     * enableAdd
     *
     * Enable 'Add' button.
     */
	this.enableAdd = function() {
		$('#add_button_disabled').hide();
		$('#add_button').show(); 
	}
	
	/**
     * disableAdd
     *
     * Disable 'Add' button.
     */
	this.disableAdd = function() {
		$('#add_button').hide();
		$('#add_button_disabled').show(); 		
	}
	
	/**
     * showRefresh
     *
     * Show Refresh button.
     */
	this.showRefresh = function(activeButtonId, buttonList) {
    	$.each(buttonList, function(index, value) {
    		if(value == activeButtonId) {
    			$('#' + value + '_refresh').css('display', 'inline-block');	
    		}
    		else {
    			$('#' + value + '_refresh').hide();
    		}	
		}); 
	}
	
	this.hideOthers = function(activeName, buttonList) {

	}
	
	/**
     * enableGreen
     *
     * Enable 'Green' button.
     */
	this.enableGreen = function() {
		$('#green_disabled').hide();
		$('#green').show(); 
	}
	
	/**
     * disableGreen
     *
     * Disable 'Green' button.
     */
	this.disableGreen = function() {
		$('#green').hide();
		$('#green_disabled').show(); 		
	}
	
}