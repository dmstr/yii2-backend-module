<?php

namespace dmstr\modules\backend\widgets;

use Yii;
use yii\web\JqueryAsset;
use yii\web\View;

class Modal extends \yii\bootstrap\Widget
{
    public function run()
    {
        $js = Yii::$app->assetManager->publish('@dmstr/modules/backend/widgets/views/modal.js');
        $this->view->registerJsFile($js[1], ['depends' => JqueryAsset::class]);

        $data['name'] = Yii::$app->name;
        $data['appVersion'] = defined('APP_VERSION') ? APP_VERSION : '-';
        $data['projectVersion'] = defined('PROJECT_VERSION') ? PROJECT_VERSION : '-';
        $data['virtualHost'] = getenv('VIRTUAL_HOST');
        $data['hostname'] = getenv('HOSTNAME') ?: 'local';
        return $this->render('modal.twig', $data);
    }
}