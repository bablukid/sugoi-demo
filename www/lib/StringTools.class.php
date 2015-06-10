<?php

class StringTools {
	public function __construct(){}
	static function htmlEscape($s, $quotes = null) {
		$s = _hx_explode(">", _hx_explode("<", _hx_explode("&", $s)->join("&amp;"))->join("&lt;"))->join("&gt;");
		if($quotes) {
			return _hx_explode("'", _hx_explode("\"", $s)->join("&quot;"))->join("&#039;");
		} else {
			return $s;
		}
	}
	static function startsWith($s, $start) {
		return strlen($s) >= strlen($start) && _hx_substr($s, 0, strlen($start)) === $start;
	}
	static function endsWith($s, $end) {
		$elen = strlen($end);
		$slen = strlen($s);
		return $slen >= $elen && _hx_substr($s, $slen - $elen, $elen) === $end;
	}
	function __toString() { return 'StringTools'; }
}
