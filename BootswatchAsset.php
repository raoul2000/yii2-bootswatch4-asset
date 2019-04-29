<?php
namespace raoul2000\bootswatch4;

use Yii;
use yii\web\AssetBundle;
use yii\base\InvalidConfigException;
use yii\base\InvalidCallException;

/**
 * Asset bundle around the Bootswatch theme for bootstrap.
 * Use raoul2000\bootswatch4\BootswatchAsset::$theme = 'cyborg' to enable the "Cyborg" theme.
 *
 * @see http://bootswatch.com/
 * @author Raoul
 */
class BootswatchAsset extends AssetBundle
{
	const VENDOR_ALIAS = '@vendor/thomaspark/bootswatch/dist';

	public $sourcePath = BootswatchAsset::VENDOR_ALIAS;
	/**
	 * @var string name of the active bootswatch theme. When NULL, no bootswatch theme
	 * is applied.
	 */
	public static $theme = null;
	/**
	 * Initialize the class properties depending on the current active theme.
	 *
	 * When debug mode is disabled, the minified version of the CSS file is used.
	 * @see \yii\web\AssetBundle::init()
	 */
	public function init()
	{
		if (self::$theme != null) {
			if (!is_string(self::$theme) || empty(self::$theme)) {
				throw new InvalidConfigException('No theme Bootswatch configured : set BootswatchAsset::$theme to the theme name you want to use');
			}

			$this->css = [
				strtolower(self::$theme).'/bootstrap'.( YII_ENV_DEV ? '.css' : '.min.css' )
			];

			// optimized asset publication : only publish bootswatch CSS files
			$this->publishOptions['beforeCopy'] =  function ($from, $to)  {
				if ( ! is_dir($from)) {
					return pathinfo($from,PATHINFO_EXTENSION) == 'css'; 
				} else {
					return true;
				}
			};
		}
		parent::init();
	}

	/**
	 * Chekcs if a theme is a valid bootswatch theme.
	 *
	 * This method assumes the $theme name passed as argument is an existing
	 * subfolder of the vendor alias folder (@vendor/thomaspark/bootswatch/dist) that contains
	 * the file 'bootstrap.min.css'. If this condition is not true, the theme name is invalid.
	 *
	 * An yii\base\InvalidCallException exception is thrown if the $theme value is not a non-empty string.
	 * 
	 * @param string $theme the theme name to test
	 * @return boolean TRUE if $theme is a valid bootswatch theme, FALSE otherwise
	 */
	static function isSupportedTheme($theme)
	{
		if (! is_string($theme) || empty($theme)) {
			throw new InvalidCallException('Invalid bootswatch theme name value  : ' . $theme);
		}
		return file_exists(Yii::getAlias(self::$sourcePath . '/' . strtolower($theme) . '/bootstrap.min.css'));
	}
}
