<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=> 'SGDocs',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'view' => [
            'theme' => [
                'class' => 'yii\base\Theme',
                'pathMap' => ['@app/views' => '@app/web/themes/grey-dance'],
                'baseUrl' => '@web/themes/grey-dance'
            ]
        ],*/
        'view' => [
            'theme' => [
                'class' => 'yii\base\Theme',
                'pathMap' => ['@app/views' => '@app/web/themes/in-the-mountains'],
                'baseUrl' => '@web/themes/in-the-mountains'
            ]
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
            ],
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'showScriptName' => false,
            'baseUrl' => 'http://admin.sgdocs.develop',
        ],

    ],
    'params' => $params,
];
