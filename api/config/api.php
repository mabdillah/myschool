<?php

$db     = require(__DIR__ . '/../../config/db.php');
//$params = require(__DIR__ . '/params.php');
 
$config = [
    'id' => 'basic',
    'name' => 'TimeTracker',
    // Need to get one level up:
    'basePath' => dirname(__DIR__).'/..',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => '@#$%^&123Aq_4YN5x0rwTf60BfzaaR',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                     // Create API log in the standard log dir
                     // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
					'class' => 'yii\rest\UrlRule', 
					'controller' => [
						'v1/default',
						'v1/pelajar',
					]
				],
            ],
        ], 
		'user' => [
			'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'db' => $db,
    ],
    'modules' => [
        'v1' => [
			'basePath' => '@app/api/v1',
            'class' => 'app\api\v1\Module',
        ],
    ],
    //'params' => $params,
];
 return $config;