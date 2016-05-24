<?php

namespace dmstr\modules\backend\controllers;

use dmstr\helpers\Metadata;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default backend controller.
 *
 * Usually renders a customized dashboard for logged in users
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['error'],
                    ],
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->can(
                                $this->module->id.'_'.$this->id.'_'.$action->id,
                                ['route' => true]
                            );
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Application dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        // prepare menu items, get all modules
        $adminMenuItems = [];
        $developerMenuItems = [];

        foreach (\dmstr\helpers\Metadata::getModules() as $name => $module) {
            $role = $name;

            $defaultItem = [
                'icon' => 'fa fa-cube',
                'label' => $name,
                'url' => ['/'.$name],
                'visible' => Yii::$app->user->can($role) || (Yii::$app->user->identity && Yii::$app->user->identity->isAdmin),
                'items' => [],
            ];

            $developerMenuItems[] = $defaultItem;
        }

        // create developer menu, when user is admin
        if (Yii::$app->user->identity && Yii::$app->user->identity->isAdmin) {
            $adminMenuItems[] = [
                'url' => '#',
                'icon' => 'fa fa-cogs',
                'label' => 'Modules',
                'items' => $developerMenuItems,
                'options' => ['class' => 'treeview'],
                'visible' => Yii::$app->user->identity->isAdmin,
            ];
        }

        return $this->render('index', ['allModulesMenuItems'=>$developerMenuItems]);
    }

    /**
     * Application configuration.
     *
     * @return string
     */
    public function actionViewConfig()
    {
        $loadedModules = Metadata::getModules();
        $loadedModulesDataProvider = new ArrayDataProvider(['allModels' => $loadedModules]);
        
        $components = Yii::$app->getComponents();
        ksort($components);
        $modules = Yii::$app->getModules();
        ksort($modules);

        return $this->render(
            'view-config',
            [
                'params' => Yii::$app->params,
                'components' => $components,
                'modules' => $modules,
                'loadedModulesDataProvider' => $loadedModulesDataProvider,
            ]
        );
    }
}
