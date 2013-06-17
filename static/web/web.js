;(function($){
	var $comfirm = $.comfirm('点击确认执行一个操作，点击取消什么都不做').close().onok(function(){ 
		$.message('执行了一个操作'); 
	});
	$('a[action-type="act-comfirm"]').on('click',function(){
		$comfirm.show().align();
	});

	var $alert = $.alert('点击确认关闭提示').close();
	$('a[action-type="act-alert"]').on('click',function(){
		$alert.show().align();
	});

	$('a[action-type="act-message"]').on('click',function(){
		$.message('提示一个消息，之后消失');
	});
	
	$('a[action-type="act-error"]').on('click', function(){
		$.ierror('提示一个错误消息，点x关闭');
	});
	
	$('a[action-type="act-api"]').on('click', function(e){
		e.preventDefault();
		var $url = $(this).attr('href');
		$.post($url, function(json){
			json  = $.parseJSON(json);
			if(json.code == 0){
				$.comfirm('<pre> ' + json.data + '</pre>').show().align();
			}
		});
	});

	$('a[action-type]').each(function(){
		$htm = $(this).html();
		$(this).itips({'class':'i-simple-tips', 'content':$htm});
	});
}(jQuery));
