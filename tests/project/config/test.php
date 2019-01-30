<?php

Yii::$classMap['app\components\EditorIdentity'] = '/repo/tests/project/src/components/EditorIdentity.php';
Yii::$classMap['app\components\AdminIdentity'] = '/repo/tests/project/src/components/AdminIdentity.php';

return [
    'aliases' => [
        'backend' => '/repo/src',
        'vendor/dmstr/yii2-backend-module' => '/repo'
    ],
    'components' => [
        'assetManager' => [
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color --modify-var="bowerAssetPath=/app/vendor/bower-asset"'],
                ],
            ],
        ],
        'user' => [
            'class' => 'dmstr\web\User',
            'identityClass' => 'app\components\AdminIdentity',
            #'rootUsers' => ['admin']
        ],
    ],
    'modules' => [
        'backend' => [
            'class' => 'dmstr\modules\backend\Module',
            'layout' => '@backend/views/layouts/main',
        ]
    ],
];