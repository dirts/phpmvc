var server 	= require('webserver').create();
var page 	= require('webpage');
var system 	= require('system');
var host, port;

/*截获url参数*/
function get_param(url, name){
	var 	patten 		= new RegExp('(\\?|\&)' + name + '=([^&!#]+)','ig'),
		returnval 	= patten.exec(url);
	
	if(returnval != null && returnval.length == 3) return returnval[2];
	else return false;
}

/*输出结果*/
function parse_html(response, content){
	response.statusCode 	= 200;
	response.headers 	= {"Cache": "no-cache", "Content-Type": "text/html;charset=UTF-8"};
	response.write(content);
	response.close();
}


if (system.args.length !== 2) {
	console.log('Usage: server.js <some port>');
	phantom.exit(1);
} else {
   	port = system.args[1];
  
	/*监听请求*/
	var listening = server.listen(port, function (request, response) {
		
		var request_url = request.url;
		var target_url 	= get_param(request_url, 'url');
		var p 		= page.create();
		
		/*如果未检测到url页面直接返回错误页面*/
		if (target_url == false) {
			parse_html(response, '');
			p.close();
			return true;
		} else {
			target_url = decodeURIComponent(target_url);
		}

		/*阻止静态文件加载*/
		p.onResourceRequested = function(requestData, request) {
			if ((/(http|https):\/\/.+?\.(css|jpg|jpeg|gif|png)/gi).test(requestData['url']) || requestData['Content-Type'] == 'text/css') request.abort();
		};

		/*页面加载完成事件*/
		p.onLoadFinished = function(status){
			if (status !== 'success') {
			} else {
		
				if (get_param(request_url, 'iframe') == 'true') {
					setTimeout(function(){
		
						var str = p.evaluate(function(){
							var t = document.title;
							var b = document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML;
							return '<body><title>' + t  +'</title>' + b + '</body>';
						});

						parse_html(response, str);
						p.close();
					
					}, 80);
				} else {
					
					parse_html(response, p.content);
					p.close();
				
				}
			
			}
		};
		
		/*发起新的窗口*/
		p.open(target_url, function(status){
			if (status !== 'success') {
			} else {
			}
		});

	});
   
	if (!listening) {
		console.log("could not create web server listening on port " + port + '.');
		phantom.exit();
	} else {
		console.log("web server is listening on port " + port + '.');
	}

}
