<?php

use yii\db\Migration;

class m160926_160610_settings extends Migration
{
    public function up()
    {
        if (Yii::$app->settings instanceof \pheme\settings\components\Settings) {
            Yii::$app->settings->set('skin', 'black-light', 'backend.adminlte');
        }

    }

    public function down()
    {
        if (Yii::$app->settings instanceof \pheme\settings\components\Settings) {
            Yii::$app->settings->delete('skin', 'backend.adminlte');
        }
    }
}
