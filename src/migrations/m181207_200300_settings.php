<?php

use yii\db\Migration;

class m181207_200300_settings extends Migration
{
    public function up()
    {
        if (Yii::$app->settings instanceof \pheme\settings\components\Settings) {
            Yii::$app->settings->getOrSet('backendWidget', 'modal', 'frontend', 'string');

        }

    }

    public function down()
    {
        if (Yii::$app->settings instanceof \pheme\settings\components\Settings) {
            Yii::$app->settings->delete('backendWidget', 'frontend');
        }
    }
}
