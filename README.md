Backend module for Yii 2.0 Framework
====================================

[![Latest Stable Version](https://poser.pugx.org/dmstr/yii2-backend-module/v/stable.svg)](https://packagist.org/packages/dmstr/yii2-backend-module) 
[![Total Downloads](https://poser.pugx.org/dmstr/yii2-backend-module/downloads.svg)](https://packagist.org/packages/dmstr/yii2-backend-module)
[![License](https://poser.pugx.org/dmstr/yii2-backend-module/license.svg)](https://packagist.org/packages/dmstr/yii2-backend-module)


### AdminLTE Dashboard

![Screenshot](https://raw.githubusercontent.com/dmstr/gh-media/master/dmstr/yii2-backend-module/backend-default-index.png)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
composer require dmstr/yii2-backend-module
```

- Requires `loveorigami/yii2-notification-wrapper`

Usage
-----

Add module to application configuration

```
'backend' => [
    'class' => 'dmstr\modules\backend\Module',
    'layout' => '@backend/views/layouts/main',
],
```

### Minimalistic Login view from AdminLTE 2

```
'modules' => [
    'user' => [
        'controllerMap' => [
            'security' => [
                'class' => Da\User\Controller\SecurityController::class,
                'layout' => '@backend/views/layouts/login'
            ],
            'recovery' => [
                'class' => Da\User\Controller\RecoveryController::class,
                'layout' => '@backend/views/layouts/login'
            ],
            'registration' => [
                'class' => Da\User\Controller\RegistrationController::class,
                'layout' => '@backend/views/layouts/login'
            ]
        ]
    ]
]
```

### Params

- `context.menuItems` menu items to be shown, i.e. used by `dmstr/yii2-prototype-module`

### Settings

*from `settings` module*

- `backend.adminlte.skin` default `black-light`
- `backend.adminlte.sidebar` default `sidebar-mini`
- `backend.adminlte.navBarIcon` default `heart`
- `frontend.backendWidget` default `modal`
- `frontend.backendButtonsInModal` (experimental)


---

#### ![dmstr logo](http://t.phundament.com/dmstr-16-cropped.png) Built by [dmstr](http://diemeisterei.de)
