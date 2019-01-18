<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2019 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\backend\interfaces;


/**
 * Class ContextMenuItemsInterface
 * @package dmstr\modules\backend\interfaces
 * @author Elias Luhr <e.luhr@herzogkommunikation.de>
 */
interface ContextMenuItemsInterface
{
    /**
     * This methods should return array list of menu items
     *
     * Example:
     *
     * [
     *    [
     *      'label' => 'Link label',
     *      'url' => ['/']
     *    ]
     * ]
     *
     * Classes which use this interface should also trigger the `registerMenuItems` preferred in the `init` method
     *
     * Example:
     *
     * public function init()
     * {
     *     \Yii::$app->trigger('registerMenuItems', new Event(['sender' => $this]));
     *     parent::init();
     * }
     *
     * Heads up: You may want to add a if statement around the trigger if it should only be triggered on certain conditions.
     *
     * @return array
    */
    public function getMenuItems();
}