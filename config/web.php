<?php
use kartik\datecontrol\Module;
$params = require(__DIR__ . '/params.php');
// hide web dekat URL
use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$config = [
    'id' => 'myschool',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language'=>'ms', // tukar language
    'components' => [
		'session' => [
			'class' => '\yii\web\Session',
			'name' => 'myschool',
		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '@#$%^&123Aq_4YN5x0rwTf60BfzaaR',
			'baseUrl' => $baseUrl, // hide dekat URL
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'user' => [
			// 'identityClass' => 'app\models\User', // yang asal
			'identityClass' => 'dektrium\user\models\User', // yang diubah
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            /*'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'emel@gmail.com',
                'password' => 'password',
                'port' => '587',//465
                'encryption' => 'tls',//ssl
            ],*/
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
		// tambah untuk paparan format tarikh 
		'formatter' => [ 
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i A',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Asia/Kuala_Lumpur', // time zone
        ],
		// administrator authentication 
		'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
    ],
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
		],
	   'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:d-m-Y',
                Module::FORMAT_TIME => 'php:H:i:s',//hh:mm:ss
                Module::FORMAT_DATETIME => 'php:d-m-Y H:i:s',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                Module::FORMAT_TIME => 'H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            //'displayTimezone' => 'Asia/Kuala_Lumpur',

            // set your timezone for date saved to db
            //'saveTimezone' => 'Asia/Kuala_Lumpur',//'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => false,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>3, 'pluginOptions'=>['autoclose'=>true,'todayHighlight' => true]],
                //Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
            // other settings
        ],
		//https://github.com/dektrium/yii2-user/blob/master/docs/getting-started.md
		// untuk configuration user login
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableConfirmation' => false, // disable email confirmation
			'enableFlashMessages' => true,//version 0.9.4 baru ada
            //'enableGeneratingPassword' => true,
            'enablePasswordRecovery' => true, 
            //'enableUnconfirmedLogin' => true,
            'emailChangeStrategy'=>'STRATEGY_DEFAULT',//STRATEGY_INSECURE,STRATEGY_SECURE
            'confirmWithin' => 21600,// 6 hours
            'cost' => 12,
			'admins' => ['admin']
		],
		// https://github.com/mdmsoft/yii2-admin/blob/master/docs/guide/configuration.md
		// configuration untuk administrator
		'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    'idField' => 'id', // id field of model User
                ]
            ],
            'layout' => 'left-menu',
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'rule' => null, // disable menu
                //'menu' => null, // disable menu
            ],
        ],
	],
	// access control - beri access kepada pengguna
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'*',
            //'admin/*',
            'site/*',
            'user/registration/*',
			'user/recovery/request',
			'debug/*',
			'datecontrol/*',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];*/

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		//'allowedIPs' => ['127.0.0.1', '::1']//hanya ip ni boleh access gii 
    ];
}

return $config;
