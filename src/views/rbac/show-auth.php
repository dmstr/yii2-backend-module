<?php

use insolita\wgadminlte\Box;
use yii\grid\GridView;

$this->title = Yii::t('backend-module', 'Authorizations');

?>
<div class="row">
    <div class="col-sm-6">
        <?php
        Box::begin(['title'=>'Roles']);
        echo GridView::widget([
            'dataProvider' => $roles,

        ]);
        Box::end();
        ?>

    </div>
    <div class="col-sm-6">
        <?php
        Box::begin(['title'=>'Permissions']);
        echo GridView::widget([
            'dataProvider' => $permissions
        ]);
        Box::end();
        ?>
    </div>
</div>

