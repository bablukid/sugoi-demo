import js.JQuery;

class App {
	
	function new() {
	}

	public static inline function j(r:String) {
		return new JQuery(r);
	}

	public static function main() {
		untyped _ = new App();
	}
	
}
