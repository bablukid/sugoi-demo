<?php

class php_Web {
	public function __construct(){}
	static function getParams() {
		$a = array_merge($_GET, $_POST);
		if(get_magic_quotes_gpc()) {
			reset($a); while(list($k, $v) = each($a)) $a[$k] = stripslashes((string)$v);
		}
		return php_Lib::hashOfAssociativeArray($a);
	}
	static function getParamValues($param) {
		$reg = new EReg("^" . _hx_string_or_null($param) . "(\\[|%5B)([0-9]*?)(\\]|%5D)=(.*?)\$", "");
		$res = new _hx_array(array());
		$explore = array(new _hx_lambda(array(&$param, &$reg, &$res), "php_Web_0"), 'execute');
		call_user_func_array($explore, array(php_Web_1($explore, $param, $reg, $res)));
		call_user_func_array($explore, array(php_Web::getPostData()));
		if($res->length === 0) {
			$post = php_Lib::hashOfAssociativeArray($_POST);
			$data1 = $post->get($param);
			$k = 0;
			$v = "";
			if(is_array($data1)) {
				 reset($data); while(list($k, $v) = each($data)) { 
				$res[$k] = $v;
				 } 
			}
		}
		if($res->length === 0) {
			return null;
		}
		return $res;
	}
	static function getURI() {
		$s = $_SERVER['REQUEST_URI'];
		return _hx_array_get(_hx_explode("?", $s), 0);
	}
	static function redirect($url) {
		header("Location: " . _hx_string_or_null($url));
	}
	static function getClientHeader($k) {
		$k1 = null;
		{
			$s = strtoupper($k);
			$k1 = str_replace("-", "_", $s);
		}
		if(null == php_Web::getClientHeaders()) throw new HException('null iterable');
		$__hx__it = php_Web::getClientHeaders()->iterator();
		while($__hx__it->hasNext()) {
			unset($i);
			$i = $__hx__it->next();
			if($i->header === $k1) {
				return $i->value;
			}
		}
		return null;
	}
	static $_client_headers;
	static function getClientHeaders() {
		if(php_Web::$_client_headers === null) {
			php_Web::$_client_headers = new HList();
			$h = php_Lib::hashOfAssociativeArray($_SERVER);
			if(null == $h) throw new HException('null iterable');
			$__hx__it = $h->keys();
			while($__hx__it->hasNext()) {
				unset($k);
				$k = $__hx__it->next();
				if(_hx_substr($k, 0, 5) === "HTTP_") {
					php_Web::$_client_headers->add(_hx_anonymous(array("header" => _hx_substr($k, 5, null), "value" => $h->get($k))));
				} else {
					if(_hx_substr($k, 0, 8) === "CONTENT_") {
						php_Web::$_client_headers->add(_hx_anonymous(array("header" => $k, "value" => $h->get($k))));
					}
				}
			}
		}
		return php_Web::$_client_headers;
	}
	static function getParamsString() {
		if(isset($_SERVER["QUERY_STRING"])) {
			return $_SERVER["QUERY_STRING"];
		} else {
			return "";
		}
	}
	static function getPostData() {
		$h = fopen("php://input", "r");
		$bsize = 8192;
		$max = 32;
		$data = null;
		$counter = 0;
		while(!(feof($h) && $counter < $max)) {
			$data .= _hx_string_or_null(fread($h, $bsize));
			$counter++;
		}
		fclose($h);
		return $data;
	}
	static function getCookies() {
		return php_Lib::hashOfAssociativeArray($_COOKIE);
	}
	static function getMultipart($maxSize) {
		$h = new haxe_ds_StringMap();
		$buf = null;
		$curname = null;
		php_Web::parseMultipart(array(new _hx_lambda(array(&$buf, &$curname, &$h, &$maxSize), "php_Web_2"), 'execute'), array(new _hx_lambda(array(&$buf, &$curname, &$h, &$maxSize), "php_Web_3"), 'execute'));
		if($curname !== null) {
			$h->set($curname, $buf->b);
		}
		return $h;
	}
	static function parseMultipart($onPart, $onData) {
		$a = $_POST;
		if(get_magic_quotes_gpc()) {
			reset($a); while(list($k, $v) = each($a)) $a[$k] = stripslashes((string)$v);
		}
		$post = php_Lib::hashOfAssociativeArray($a);
		if(null == $post) throw new HException('null iterable');
		$__hx__it = $post->keys();
		while($__hx__it->hasNext()) {
			unset($key);
			$key = $__hx__it->next();
			call_user_func_array($onPart, array($key, ""));
			$v = $post->get($key);
			call_user_func_array($onData, array(haxe_io_Bytes::ofString($v), 0, strlen($v)));
			unset($v);
		}
		if(!isset($_FILES)) {
			return;
		}
		$parts = new _hx_array(array_keys($_FILES));
		{
			$_g = 0;
			while($_g < $parts->length) {
				$part = $parts[$_g];
				++$_g;
				$info = $_FILES[$part];
				$tmp = $info["tmp_name"];
				$file = $info["name"];
				$err = $info["error"];
				if($err > 0) {
					switch($err) {
					case 1:{
						throw new HException("The uploaded file exceeds the max size of " . _hx_string_or_null(ini_get("upload_max_filesize")));
					}break;
					case 2:{
						throw new HException("The uploaded file exceeds the max file size directive specified in the HTML form (max is" . _hx_string_or_null((_hx_string_or_null(ini_get("post_max_size")) . ")")));
					}break;
					case 3:{
						throw new HException("The uploaded file was only partially uploaded");
					}break;
					case 4:{
						continue 2;
					}break;
					case 6:{
						throw new HException("Missing a temporary folder");
					}break;
					case 7:{
						throw new HException("Failed to write file to disk");
					}break;
					case 8:{
						throw new HException("File upload stopped by extension");
					}break;
					}
				}
				call_user_func_array($onPart, array($part, $file));
				if("" !== $file) {
					$h = fopen($tmp, "r");
					$bsize = 8192;
					while(!feof($h)) {
						$buf = fread($h, $bsize);
						$size = strlen($buf);
						call_user_func_array($onData, array(haxe_io_Bytes::ofString($buf), 0, $size));
						unset($size,$buf);
					}
					fclose($h);
					unset($h,$bsize);
				}
				unset($tmp,$part,$info,$file,$err);
			}
		}
	}
	static $isModNeko;
	function __toString() { return 'php.Web'; }
}
php_Web::$isModNeko = !php_Lib::isCli();
function php_Web_0(&$param, &$reg, &$res, $data) {
	{
		if($data === null || strlen($data) === 0) {
			return;
		}
		{
			$_g = 0;
			$_g1 = _hx_explode("&", $data);
			while($_g < $_g1->length) {
				$part = $_g1[$_g];
				++$_g;
				if($reg->match($part)) {
					$idx = $reg->matched(2);
					$val = null;
					{
						$s = $reg->matched(4);
						$val = urldecode($s);
						unset($s);
					}
					if($idx === "") {
						$res->push($val);
					} else {
						$res[Std::parseInt($idx)] = $val;
					}
					unset($val,$idx);
				}
				unset($part);
			}
		}
	}
}
function php_Web_1(&$explore, &$param, &$reg, &$res) {
	{
		$s1 = php_Web::getParamsString();
		return str_replace(";", "&", $s1);
	}
}
function php_Web_2(&$buf, &$curname, &$h, &$maxSize, $p, $_) {
	{
		if($curname !== null) {
			$h->set($curname, $buf->b);
		}
		$curname = $p;
		$buf = new StringBuf();
		$maxSize -= strlen($p);
		if($maxSize < 0) {
			throw new HException("Maximum size reached");
		}
	}
}
function php_Web_3(&$buf, &$curname, &$h, &$maxSize, $str, $pos, $len) {
	{
		$maxSize -= $len;
		if($maxSize < 0) {
			throw new HException("Maximum size reached");
		}
		{
			$s = $str->toString();
			$buf->b .= _hx_string_or_null(_hx_substr($s, $pos, $len));
		}
	}
}
