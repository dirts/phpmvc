;(function($){
	$('a[action-type="act-login"]').on('click', function(){
		var $form = $('#login');
		var option = {
			'success':function(json){
				json = $.parseJSON(json);
				if(json.code == 0){
					window.location.href = json.data.href;	
				}else{
					$.comfirm(json.message);
				}
			}
		}
	
		$form.ajaxSubmit(option);
	});
}(jQuery));

var ss = 's';
alert(ss);
