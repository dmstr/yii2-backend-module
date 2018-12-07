<?php

namespace dmstr\modules\backend\widgets;

use Yii;

class Modal extends \yii\bootstrap\Widget
{
    public function run()
    {
        $data['name'] = Yii::$app->name;
        $data['version'] = getenv('APP_VERSION');
        $data['virtualHost'] = getenv('VIRTUAL_HOST');
        $data['hostname'] = getenv('HOSTNAME') ?: 'local';
        return $this->render('modal.twig', $data);
    }
}