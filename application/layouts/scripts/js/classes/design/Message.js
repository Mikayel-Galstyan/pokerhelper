function Messages(){
    this.callback;
    this.callbackChange;
    this.popups = [];
    this.data;
    this.init = function(){
        Messages.callbackRemove = function(){
            var options = {
                dataType:'json',
                success: function(result) {
                }
            };             
            $('#ajaxFormDeleteDevice').ajaxSubmit(options);
        };
        Messages.callbackChange = function(){
            var options = {
                dataType:'json',
                success: function(result) {
                }
            };             
            $('#ajaxFormChangeDevice').ajaxSubmit(options);
        };
        Messages.init = {buttons:[{name:'<?php echo $this->translate("remove.device") ?>',callback: Messages.callbackRemove},{name:'<?php echo $this->translate("change.device") ?>',callback: Messages.callbackChange}]};
    };
    
    this.setData = function(data){

    }
}