<?php

use insolita\wgadminlte\Box;
$this->title = "Authorizations";

?>
<div class="row">
    <div class="col-sm-6">
        <?php
        Box::begin(['title'=>'Roles']);
        echo \yii\grid\GridView::widget([
            'dataProvider' => $roles,

        ]);
        Box::end();
        ?>

    </div>
    <div class="col-sm-6">
        <?php
        Box::begin(['title'=>'Permissions']);
        echo \yii\grid\GridView::widget([
            'dataProvider' => $permissions
        ]);
        Box::end();
        ?>
    </div>
</div>

