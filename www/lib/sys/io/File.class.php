<?php

class sys_io_File {
	public function __construct(){}
	static function getContent($path) {
		$GLOBALS['%s']->push("sys.io.File::getContent");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = file_get_contents($path);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function write($path, $binary = null) {
		$GLOBALS['%s']->push("sys.io.File::write");
		$__hx__spos = $GLOBALS['%s']->length;
		if($binary === null) {
			$binary = true;
		}
		{
			$tmp = new sys_io_FileOutput(fopen($path, (($binary) ? "wb" : "w")));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'sys.io.File'; }
}
