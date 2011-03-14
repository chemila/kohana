<?php defined('SYS') or die('No direct script access.');
class queue
{
	//@todo could be static for each queue
	private $id;
	public function __construct($key)
	{
		$this->id = msg_get_queue($key,0666);
	}
	public function push($msg)
	{
		msg_send($this->id,1,$msg);
	}

	public function pop()
	{
		return msg_receive($this->id,0,$message_type,1024,$msg,true,MSG_IPC_NOWAIT);
	}
}
