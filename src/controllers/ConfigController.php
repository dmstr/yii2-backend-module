<?php


namespace dmstr\modules\backend\controllers;


use dmstr\helpers\Metadata;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use Yii;

class ConfigController extends Controller
{
    /**
     * Application configuration.
     *
     * @return string
     */
    public function actionView()
    {
        $loadedModules = Metadata::getModules();
        $loadedModulesDataProvider = new ArrayDataProvider(['allModels' => $loadedModules]);
        $loadedModulesDataProvider->pagination->pageSize = 100;

        $components = Yii::$app->getComponents();
        ksort($components);
        $modules = Yii::$app->getModules();
        ksort($modules);
        $env = $_ENV;
        ksort($env);


        return $this->render(
            'view',
            [
                'params' => Yii::$app->params,
                'components' => $components,
                'modules' => $modules,
                'env' => $env,
                'loadedModulesDataProvider' => $loadedModulesDataProvider,
            ]
        );
    }
}
