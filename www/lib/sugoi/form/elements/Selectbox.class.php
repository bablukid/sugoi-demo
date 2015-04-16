<?php

class sugoi_form_elements_Selectbox extends sugoi_form_FormElement {
	public function __construct($name, $label, $data = null, $selected = null, $required = null, $nullMessage = null, $attributes = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::new");
		$__hx__spos = $GLOBALS['%s']->length;
		if($attributes === null) {
			$attributes = "";
		}
		if($nullMessage === null) {
			$nullMessage = "-";
		}
		if($required === null) {
			$required = false;
		}
		parent::__construct();
		$this->name = $name;
		$this->label = $label;
		if($data !== null) {
			$this->data = $data;
		} else {
			$this->data = new _hx_array(array());
		}
		$this->value = $selected;
		$this->required = $required;
		$this->nullMessage = $nullMessage;
		$this->attributes = $attributes;
		$this->size = 1;
		$this->multiple = false;
		$this->onChange = "";
		if(sugoi_form_Form::$USE_TWITTER_BOOTSTRAP) {
			$this->cssClass = "form-control";
		}
		$GLOBALS['%s']->pop();
	}}
	public $data;
	public $nullMessage;
	public $onChange;
	public $size;
	public $multiple;
	public function render() {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$s = "";
		$n = $this->parentForm->name;
		$n .= "_" . _hx_string_or_null($this->name);
		$s .= "\x0A<select name=\"" . _hx_string_or_null($n) . "\" id=\"" . _hx_string_or_null($n) . "\" " . _hx_string_or_null($this->attributes) . " class=\"" . _hx_string_or_null($this->getClasses()) . "\" onChange=\"" . _hx_string_or_null($this->onChange) . "\" size=\"" . _hx_string_rec($this->size, "") . "\" " . _hx_string_or_null(((($this->multiple) ? "multiple" : ""))) . "/>";
		if($this->nullMessage !== "") {
			$s .= "<option value=\"\" " . _hx_string_or_null((((Std::string($this->value) === "") ? "selected" : ""))) . ">" . _hx_string_or_null($this->nullMessage) . "</option>";
		}
		if($this->data !== null) {
			$_g = 0;
			$_g1 = $this->data;
			while($_g < $_g1->length) {
				$row = $_g1[$_g];
				++$_g;
				$s .= "<option value=\"" . Std::string($row->key) . "\" " . _hx_string_or_null((((Std::string($row->key) === Std::string($this->value)) ? "selected" : ""))) . ">" . Std::string($row->value) . "</option>";
				unset($row);
			}
		}
		$s .= "</select>";
		{
			$GLOBALS['%s']->pop();
			return $s;
		}
		$GLOBALS['%s']->pop();
	}
	public function selectFirst() {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::selectFirst");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->value = _hx_array_get($this->data, 0)->key;
		$GLOBALS['%s']->pop();
	}
	public function add($key, $value) {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::add");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->data->push(_hx_anonymous(array("key" => $key, "value" => $value)));
		$GLOBALS['%s']->pop();
	}
	public function addOption($keyVal) {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::addOption");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->data->push($keyVal);
		$GLOBALS['%s']->pop();
	}
	public function toString() {
		$GLOBALS['%s']->push("sugoi.form.elements.Selectbox::toString");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->render();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return $this->toString(); }
}
