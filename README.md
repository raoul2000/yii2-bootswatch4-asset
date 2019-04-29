# yii2-bootswatch4-asset

Asset bunlde around the [Bootswatch Theme Suite](http://bootswatch.com/) based on **bootstrap 4**.

[![Latest Stable Version](https://poser.pugx.org/raoul2000/yii2-bootswatch4-asset/v/stable)](https://packagist.org/packages/raoul2000/yii2-bootswatch4-asset) [![Total Downloads](https://poser.pugx.org/raoul2000/yii2-bootswatch4-asset/downloads)](https://packagist.org/packages/raoul2000/yii2-bootswatch4-asset)

If you are using Bootstrap 3, please refer to the dedicated extension [yii2-bootswatch-asset](https://github.com/raoul2000/yii2-bootswatch-asset).


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist raoul2000/yii2-bootswatch4-asset "*"
```

or add

```
"raoul2000/yii2-bootswatch4-asset": "*"
```

to the require section of your `composer.json` file.


## Usage

Note that this asset bundle  **does NOT include Bootstrap 4 files**, but only the [Bootswatch](http://bootswatch.com/) CSS files dedicated to *overload* Bootstrap default theme. To use the Bootstrap 4 files with your Yii2 application, check the [yii2-bootstrap4](https://github.com/yiisoft/yii2-bootstrap4) extension.

To use a bootswatch theme in your Yii2 application add the **BootswatchAsset** bundle to your main *AppAsset* bundle:

```php

// ./assets/AppAsset.php

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
    	'raoul2000\bootswatch4\BootswatchAsset',
    ];
}
?>
```

Then at some point you must select the theme name you want to use. In the example below, the theme [materia](https://bootswatch.com/materia/) is set in the main layout file.

```php

// ./views/layouts/main.php

raoul2000\bootswatch4\BootswatchAsset::$theme = 'materia';
AppAsset::register($this);

```

## About Versioning

By convention this extension is using the same version number as the [project thomaspark/bootswatch](https://github.com/thomaspark/bootswatch) it depends on. Consequently, the first version of this extension is 4.3.1.

## License

**yii2-bootswatch4-asset** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
