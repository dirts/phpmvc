<?php

$pid = pcntl_fork();
//这里最好不要有其他语句
if($pid){
	
	//父进程逻辑,
	//pcntl_waitpid 会阻塞这个分支，
	
	pcntl_waitpid($pid , $status);
	
	//阻塞当前进程，只到当前进程的一个子进程退出或者收到一个结束当前进程的信号。使用$status返回子进程的状态码，并可以指定第二个参数来说明是否以阻塞状态调用：
	//1. 阻塞方式调用的，函数返回值为子进程的pid,如果没有子进程返回值为-1；
	//2. 非阻塞方式调用，函数还可以在有子进程在运行但没有结束的子进程时返回0
	
	console_log("[1] child status: ".$status);
	console_log("[2] im parent");
	console_log("[3] pid is:". $pid);
	console_log("[4] ppid is:". getmypid());

}elseif($pid == 0){ 
	
	//$pid == 0 进入子进程逻辑，因为fork了分支，则脚本直接再次打开一次，进入这个分支。
	console_log("[5] im child");
	console_log("[6] and is:". getmypid());
	$start_time = time();
	while(1){
		$ppid = posix_getppid();
		console_log("[x] my ppid is: ". $ppid);

		//父进程为1则父进程挂掉了
		if($ppid == 1) console_log("[x] my parent is die");
		
		if((time() - $start_time ) > 5 ){
			console_log('[7] child is end ~');
			//子进程最好有一个exit,防止不必要的出错;
			exit;
		}
	}
}else{
	console_log("wtf");	
}

#输出
function console_log($msg){
	echo "$msg\r\n";
}


/*
打印结果:

[5] im child
[6] and is: 12811
[7] child is end ~
[1] status: 0
[2] im parent
[3] pid is: 12811
[4] ppid is: 12810/*
*/
