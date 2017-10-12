<?php

namespace dmstr\modules\backend\controllers;

use dmstr\helpers\Metadata;
use dmstr\modules\backend\Module;
use dmstr\widgets\Menu;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
            if (in_array($name, $this->module->modulesDashboardBlacklist)) {
                continue;
            }

            $role = $name;

            $defaultItem = [
                'icon' => 'fa fa-cube',
                'label' => $name,
                'url' => ['/'.$name],
                'visible' => Yii::$app->user->can($role),
                'items' => [],
            ];

            $developerMenuItems[] = $defaultItem;
        }

        // create developer menu, when user is admin
        if (Yii::$app->user->can('Admin')) {
            $adminMenuItems[] = [
                'url' => '#',
                'icon' => 'fa fa-cogs',
                'label' => 'Modules',
                'items' => $developerMenuItems,
                'options' => ['class' => 'treeview'],
            ];
        }

        return $this->render('index', ['allModulesMenuItems' => $developerMenuItems]);
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
        $loadedModulesDataProvider->pagination->pageSize = 100;

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

    public function actionShowAuth()
    {
        $allPermissions = Yii::$app->authManager->getPermissions();
        $allRoles = Yii::$app->authManager->getRoles();
        $userPermissions = [];
        $userRoles = [];

        foreach ($allPermissions AS $item) {
            if (Yii::$app->user->can($item->name)) {
                $userPermissions[] = [
                    'description' => $item->description,
                    'name' => $item->name,
                ];
            }
        }
        foreach ($allRoles AS $item) {
            if (Yii::$app->user->can($item->name)) {
                $userRoles[] = [
                    'description' => $item->description,
                    'name' => $item->name,
                ];
            }
        }

        return $this->render('show-auth',
            [
                'permissions' => new ArrayDataProvider([
                    'allModels' => $userPermissions,
                    'pagination' => [
                        'pageSize' => 100,
                    ],
                ]),
                'roles' => new ArrayDataProvider([
                    'allModels' => $userRoles,
                    'pagination' => [
                        'pageSize' => 100,
                    ],
                ]),
            ]);
    }



    /**
     * flush cache
     *
     * if APCu is used as cache we cannot flush cache from cli command
     * see: https://github.com/yiisoft/yii2/issues/8647
     *
     * @return \yii\web\Response
     */
    public function actionCacheFlush()
    {
        if (Yii::$app->cache->flush()) {
            Yii::$app->session->addFlash('success', 'Cache wurde geleert');
        } else {
            Yii::$app->session->addFlash('error', 'Cache konnte nicht geleert werden');
        }
        return $this->redirect(!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : \yii\helpers\Url::to(['/backend/']));
    }


    /**
     * @param array $item \dmstr\modules\pages\models\Tree::getMenuItems()
     *
     * @return string
     * @throws \Exception
     */
    public function renderDashboardMenu($item = [])
    {
        $menuItems = '';

        if (!isset($item['items'])) {
            return $menuItems;
        }

        foreach ($item['items'] as $subItem) {
            if ($subItem['visible'] && $subItem['url']) {
                $colorSelect = ArrayHelper::getValue($item, 'icon');
                $menuItems .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
                $infoBoxHtml = \insolita\wgadminlte\InfoBox::widget(
                    [
                        'text' => '<h4 style="white-space: normal;">'.$subItem['label'].'</h4>',
                        'boxBg' => Module::colorHash(isset($colorSelect[2]) ? $colorSelect[2] : 0),
                        'icon' => (isset($subItem['icon']) && !empty($subItem['icon']))
                            ? Menu::$iconClassPrefix.$subItem['icon']
                            : 'fa fa-circle-o',
                    ]);
                $menuItems .= Html::a($infoBoxHtml, $subItem['url']);
                $menuItems .= '</div>';
            }

            if (!empty($subItem['items'])) {
                $menuItems .= $this->renderDashboardMenu($subItem);
            }
        }

        return $menuItems;
    }
}
