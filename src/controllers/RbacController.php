<?php


namespace dmstr\modules\backend\controllers;


use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\web\Controller;

class RbacController extends Controller
{
    private $_mmdFile = '@runtime/backend/rbac.mmd';
    private $_manager;

    public function init()
    {
        parent::init();
        $this->_manager = \Yii::$app->authManager;

    }

    public function actionIndex()
    {
        $this->renderDiagram();

        $mmd = file_get_contents(\Yii::getAlias($this->_mmdFile));
        return $this->render('index.twig', ['mmd' => $mmd]);
    }


    private function renderDiagram()
    {
        $manager = \Yii::$app->authManager;
        $roles = $manager->getRoles();

        $mermaid = 'flowchart LR' . PHP_EOL . PHP_EOL;

        $assignmentsMmd = '';
        $rolesMmd = '';
        $permissionMmd = '';

        foreach ($this->_manager->getPermissions() as $permission) {
            $permissionMmd .= $this->renderAssignments($permission);
        }

        $permissionMmd .= $this->renderPermissions();

        foreach ($roles as $role) {
            if ($role->ruleName) {
                $rolesMmd .= $this->renderItem($role) . PHP_EOL;
                $arrow = '-.->';
            } else {
                $rolesMmd .= $this->renderItem($role) . PHP_EOL;
                $arrow = '-->';
            }
            $assignmentsMmd .= $this->renderAssignments($role);
        }

        #$mermaid .= $this->renderAsSubgraph('roles',$rolesMmd) . PHP_EOL;
        $mermaid .= $rolesMmd . PHP_EOL;
        $mermaid .= $permissionMmd . PHP_EOL;
        $mermaid .= $assignmentsMmd . PHP_EOL;

        $filename = \Yii::getAlias($this->_mmdFile);
        FileHelper::createDirectory(dirname($filename));
        file_put_contents($filename, $mermaid);

    }

    private function renderAssignments($item)
    {
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

    private function renderAsSubgraph($name, $diagram) {
        $subgraph = 'subgraph '.$name.PHP_EOL;
        $subgraph .= $diagram.PHP_EOL;
        $subgraph .= 'end'.PHP_EOL;

        return $subgraph;
    }

    private function renderItem($item, $compact = false)
    {
        if ($compact) {
            $node = md5($item->name);
        } else {
            $node = md5($item->name) . '["' . $item->name . '<br/><br/>' . $item->description . '"]';
            $node .= ';'.PHP_EOL;
            $routePart = $item->type == 1 ? 'role' : 'permission';
            $node .= 'click '.md5($item->name).' "/user/'.$routePart.'/update?name='.$item->name.'" "TT";';
        }
        return $node;
    }
}
