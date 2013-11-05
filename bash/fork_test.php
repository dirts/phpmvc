<?php
	
	#生成子进程，这个子进程仅pid和ppid，与其父进程不同。fork怎样在您的系统工作的详细信息请查阅您的系统fork手册
	$pid = pcntl_fork();
	
	if($pid == -1){
		die('could not fork');
	}else if($pid){

		#wait函数挂起当前进程的执行直到一个子进程退出或接收到一个信号要求中断当前进程或调用一个信号处理函数。如果一个子进程在调用此函数时已经退出（僵尸进程），此函数立刻返回。子进程使用的所有系统资源将被释放。关于wait在您系统上工作的详细规范请查看您系统的wait。
		#等待或返回fork的子进程状态
		
		pcntl_waitpid($pid, $s);
		var_dump("this pid : ". getmypid());
		var_dump("fork pid : " . $pid);
		var_dump("fork prosses status : " . $s);
	
	}else{
		//
	}

	##异步处理的回调部分
	//setInterval('console_log', 3, $start_time = time());

	//$sid = exec("/usr/local/php/bin/php ./a.php");
	
	//$sid = exec("ls");
	//var_dump($sid);
	//pcntl_waitpid($pid, $status);
	//var_dump($status);

	function console_log($msg = 's'){
		echo "$msg\r\n";
	}

	#设置interval
	function setInterval($fn, $time, $start_time){
		while(1){
			if($time != 0 && (time() - $start_time) > $time){
				console_log($time);
				break;	
			}
			$fn(time());
		}
	}

	function setTimeout($fn, $time){
		
	}
