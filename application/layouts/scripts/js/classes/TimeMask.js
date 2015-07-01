function TimeMask() {
	
	this.apply = function(inputId) {
		$('#'+inputId).keyup(function(e) {
			var str = $(this).val();
			var strLen = str.length; 
			var test = false;
			switch(strLen) {
				case 1:
					test = /^[0-2]$/.test(str);
					break;	
				case 2:
					test = /^([0-1][0-9]|[2][0-3])$/.test(str);
					break;
				case 3:
					test = /^([0-1][0-9]|[2][0-3])\:$/.test(str);
					break;
				case 4:
					test = /^([0-1][0-9]|[2][0-3])\:[0-5]$/.test(str);
					break;
				case 5:
					test = /^([0-1][0-9]|[2][0-3])\:[0-5][0-9]$/.test(str);
					break;
				case 6:
					test = /^([0-1][0-9]|[2][0-3])\:[0-5][0-9]\:$/.test(str);
					break;
				case 7:
					test = /^([0-1][0-9]|[2][0-3])\:[0-5][0-9]\:[0-5]$/.test(str);
					break;
				case 8:
					test = /^([0-1][0-9]|[2][0-3])\:[0-5][0-9]\:[0-5][0-9]$/.test(str);
					break;
			}
			if(test) {
				if(strLen==8) {
					Button.enableGreen();
					return true;
				}
			}
			else {
				$(this).val(str.substr(0, strLen-1));
			}
			Button.disableGreen();
		});
	}
}