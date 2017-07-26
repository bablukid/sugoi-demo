package ;
import sugoi.i18n.Locale;
import sugoi.i18n.TemplateTranslator;
import sugoi.i18n.GetText;
import sugoi.Web;

class App extends sugoi.BaseApp
{
	public static var current : App = null;
	public static var config = sugoi.BaseApp.config;
	
	public function new() 
	{
		super();
		#if i18n_generation
		if( false ) TemplateTranslator.parse("lang/master");
		#end
		
		Locale.init(config.LANG);//TODO  use session instead
		//log(Locale.texts._("Hello there, text from hx file"));
	}
	
	public static function main() {
		
		#if i18n_parsing
		if( false ) GetText.parse(["src", "lang/master"], "lang/allTexts.pot");
		#end

		sugoi.BaseApp.main();
	}
	
	public static function log(t:Dynamic) {
		if (config.DEBUG) {
			#if neko
			Web.logMessage(Std.string(t));
			#end
		}
	}
}