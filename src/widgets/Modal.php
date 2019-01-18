<?php

namespace dmstr\modules\backend\widgets;

use dmstr\modules\backend\assets\ModalAsset;
use Yii;

/**
 * Class Modal
 * @package dmstr\modules\backend\widgets
 */
class Modal extends \yii\bootstrap\Widget
{

    public function init()
    {
        $this->registerAssets();
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {

        $data['name'] = Yii::$app->name;
        $data['appVersion'] = defined('APP_VERSION') ? APP_VERSION : '-';
        $data['projectVersion'] = defined('PROJECT_VERSION') ? PROJECT_VERSION : '-';
        $data['virtualHost'] = getenv('VIRTUAL_HOST');
        $data['hostname'] = getenv('HOSTNAME') ?: 'local';

        return $this->render('modal.twig', $data);
    }

    public function registerAssets()
    {
        ModalAsset::register($this->view);
    }
}