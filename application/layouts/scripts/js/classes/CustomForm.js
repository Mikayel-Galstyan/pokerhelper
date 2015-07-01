/**
* CustomForm class
* 
* Version 1.0
* 
* @author sourcio.com 
* 
*/
function CustomForm(){
	this.left = 0;
	this.top = 0;	
    var btn = {save:'Save', cancel:'Cancel'};    
    /**
     * Page Response 
     *
     * Calling ajax response
     */
    this.init = function (tSave, tCancel) {
    	CustomForm.btn = {save:tSave, cancel:tCancel};    	
    };
    this.editClub = function(obj,action){
        id = $(obj).attr('id');
        id = id.replace('club_','');
        $('#editField').parent().children().show();
        $('#editField').remove();
        var str = '<form action="'+action+'" method="POST" id="editField" onsubmit="Form.submit(\'editField\');return false;" >'
        +'<input type="hidden" name="id" value="'+id+'" />'
        +'<input type="text" class="textInput w305" name="name" value="'+$(obj).text()+'"/>'
        +'<input type="button" class="green mr10 ml10" onclick="Form.submit(\'editField\');" value="'+btn.save+'">'
        +'<input type="button" class="gray mr10" onclick="$(\'#club_'+id+'\').show();$(\'#editField\').remove();" value="'+btn.cancel+'">'
        +'</form>';
        $(obj).hide();
        $(obj).parent().append(str)
    };
	
    this.editCourse = function(url){
    	//Cropper.remove();
    	//Button.disableAdd();
        Ajax.get(url, successCourse);   
    };
	
    function successCourse(response) {
    	$('#editPop').html(response);
    	$('.pop').show();
    	//Hiding mask
		Mask.hide();
    };
    
	this.showInfoForLive = function(url,left,top){
		CustomForm.left = left;
		CustomForm.top = top;
		$('#info_label').remove();
		Ajax.get(url, successResponseInfo);
	};
	
	function successResponseInfo(response){
		var html = '<div id="info_label" class="waitingLabel">'+response+'</div>';
		$('#map_container').append(html);
    	//Hiding mask
		Mask.hide();
	};
	
    this.test = function(url){
    	$.ajax({
            url:url,
            success: function(r){
            },
            error: function(xhr, ajaxOptions, thrownError){
            }
        });   
    }; 
};