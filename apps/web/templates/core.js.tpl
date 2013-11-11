require(['jquery', 'css','jquery.form', 'jquery.icard', 'suggest'], function(jQuery){

	$('input[action-type="act-form-submit"]').on('click', function(e){
		e.preventDefault();
		var $this = $(this);
		var $form = $this.closest('form');

		var o = {
			'success':function(json){
				json = $.parseJSON(json);
				if(json.code != '0'){
					$.ierror(json.msg);
				}else{
					$.ierror(json.msg);
				}
			}
		}
		$form.ajaxSubmit(o);
	});

});
