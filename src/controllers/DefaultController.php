<?php

namespace dmstr\modules\backend\controllers;

use dmstr\helpers\Metadata;
use dmstr\modules\backend\Module;
use dmstr\widgets\Menu;
use insolita\wgadminlte\InfoBox;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default backend controller.
 *
 * Usually renders a customized dashboard for logged in users
 */
class DefaultController extends Controller
{

    /**
     * Application dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->hasModule('pages')) {
            // no `use` statement, since module is optional
            $items = \dmstr\modules\pages\models\Tree::getMenuItems('backend', true);
        } else {
            $items = [];
        }

        return $this->render('index', ['items' => $items]);
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

    /**
     * @return string
     */
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
            Yii::$app->session->addFlash('success', Yii::t('backend-module','Cache cleared'));
        } else {
            Yii::$app->session->addFlash('error', Yii::t('backend-module','Cannot clear cache'));
        }
        return $this->redirect(!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Url::to(['index']));
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
            if ($subItem['visible'] && $subItem['url'] && $subItem['url'] !== '#') {
                $colorSelect = ArrayHelper::getValue($item, 'icon');
                $menuItems .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
                $infoBoxHtml = InfoBox::widget(
                    [
                        'text' => '<h4 style="white-space: normal;">'.$subItem['label'].'</h4>',
                        'boxBg' => Module::colorHash($colorSelect[2] ?? 0),
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
