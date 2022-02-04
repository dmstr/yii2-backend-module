<?php


namespace dmstr\modules\backend\controllers;


use yii\data\ArrayDataProvider;
use yii\helpers\FileHelper;
use yii\web\Controller;
use Yii;

class RbacController extends Controller
{
    private $_mmdFile = '@runtime/backend/rbac.mmd';
    private $_manager;

    public function init()
    {
        parent::init();
        $this->_manager = \Yii::$app->authManager;

    }

    /**
     * @return string
     */
    public function actionAssignments()
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

    public function actionDiagram()
    {
        $this->renderDiagram();

        $mmd = file_get_contents(\Yii::getAlias($this->_mmdFile));
        return $this->render('index.twig', ['mmd' => $mmd]);
    }


    private function renderDiagram()
    {

        $mermaid = 'flowchart LR' . PHP_EOL . PHP_EOL;

        $assignmentsMmd = '';
        $permissionMmd = '';

        $rolesMmd = $this->renderRoles();
        $permissionMmd .= $this->renderPermissions();

        foreach ($this->_manager->getRoles() as $role) {
            $assignmentsMmd .= $this->renderAssignments($role);
        }
        $assignmentsMmd .= PHP_EOL . PHP_EOL;
        foreach ($this->_manager->getPermissions() as $permission) {
            $assignmentsMmd .= $this->renderAssignments($permission);
        }

        #$mermaid .= $this->renderAsSubgraph('roles',$rolesMmd) . PHP_EOL;
        $mermaid .= $rolesMmd . PHP_EOL;
        #$mermaid .= $permissionMmd . PHP_EOL;
        $mermaid .= $permissionMmd . PHP_EOL;
        $mermaid .= $assignmentsMmd . PHP_EOL;

        $filename = \Yii::getAlias($this->_mmdFile);
        FileHelper::createDirectory(dirname($filename));
        file_put_contents($filename, $mermaid);

    }

    private function renderRoles()
    {
        $roles = $this->_manager->getRoles();
        $rolesMmd = '';
        $assignmentsMmd = '';

        $_gs = [];

        foreach ($roles as $role) {
            #var_dump($this->module->rbacDiagramExcludeRoles);exit;
            if (in_array($role->name, $this->module->rbacDiagramExcludeRoles)) continue;

            $group = $role->ruleName ?? '__NONE__';
            $group = '__NONE__';

            if ($role->ruleName) {
                $_gs[$group][] = $this->renderItem($role) . PHP_EOL;
                $arrow = '-.->';
            } else {
                $_gs[$group][] = $this->renderItem($role) . PHP_EOL;
                $arrow = '-->';
            }

            #$assignmentsMmd .= $this->renderAssignments($role);

        }

        foreach ($_gs as $groupName => $g) {
            $groupMmd = implode("\n", $g);
            if ($groupName !== '__NONE__') {
                $rolesMmd .= $this->renderAsSubgraph($groupName, $groupMmd);
            } else {
                $rolesMmd .= $groupMmd;
            }
            #$rolesMmd .= $groupMmd;
        }


        return $rolesMmd . $assignmentsMmd;
    }

    private function renderAssignments($item)
    {
        if (in_array($item->name, $this->module->rbacDiagramExcludeRoles, true)) {
            return;
        }

        $assignmentsMmd = '';
        foreach ($this->_manager->getChildren($item->name) as $child) {
            $arrow = ($item->ruleName) ? '-.->' : '-->';
            $assignmentsMmd .= $this->renderItem($item, true) . $arrow . $this->renderItem($child, true) . PHP_EOL;
        }
        return $assignmentsMmd;
    }

    private function renderPermissions()
    {
        $permissionGroups = [];
        $permissionMmd = '' . PHP_EOL;
        foreach ($this->_manager->getPermissions() as $permission) {
            $group = explode('_', $permission->name)[0];
            $group = explode('.', $group)[0];
            $group = explode('-', $group)[0];
            $permissionGroups[$group][] = $this->renderItem($permission) . PHP_EOL;
        }

        foreach ($permissionGroups as $group => $items) {
            $g = '';
            foreach ($items as $line) {
                $g .= $line;
            }
            $permissionMmd .= $this->renderAsSubgraph("__$group", $g);
        }
        return $permissionMmd;
    }

    private function renderAsSubgraph($name, $diagram)
    {
        $subgraph = 'subgraph ' . $name . PHP_EOL;
        $subgraph .= $diagram . PHP_EOL;
        $subgraph .= 'end' . PHP_EOL;

        return $subgraph;
    }

    private function renderItem($item, $compact = false)
    {
        if ($compact) {
            $node = md5($item->name);
        } else {
            $symbols = ($item->type == 1) ? ["(",")"] : ["[","]"];
            $node = md5($item->name) . $symbols[0]. '"' . $item->name . '<br/><br/>' . $item->description . '"'.$symbols[1];

            $node .= ';' . PHP_EOL;
            $routePart = $item->type == 1 ? 'role' : 'permission';
            $node .= 'click ' . md5($item->name) . ' "/user/' . $routePart . '/update?name=' . $item->name . '" "TT";';
        }
        return $node;
    }
}
