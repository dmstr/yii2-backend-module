Backend module for Yii 2.0 Framework
====================================

### AdminLTE Dashboard

![Screenshot](https://raw.githubusercontent.com/dmstr/gh-media/master/dmstr/yii2-backend-module/backend-default-index.png)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
composer require dmstr/yii2-backend-module
```

Usage
-----

Add module to application configuration

```
'backend' => [
    'class' => 'dmstr\modules\backend\Module',
    'layout' => '@backend/views/layouts/main',
],
```

### Params

- `context.menuItems` menu items to be shown, i.e. used by `dmstr/yii2-prototype-module`

### Settings

*from `settings` module*

- `backend.adminlte.skin` default `black-light`



---

#### ![dmstr logo](http://t.phundament.com/dmstr-16-cropped.png) Built by [dmstr](http://diemeisterei.de)