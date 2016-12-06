<?php

namespace dmstr\modules\backend;

/*
 * @link http://www.diemeisterei.de/
 *
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use insolita\wgadminlte\InfoBox;

/**
 * Class Module.
 *
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class Module extends \yii\base\Module
{
    static function colorHash($label)
    {
        $colors = [
            InfoBox::TYPE_NAVY,
            InfoBox::TYPE_LBLUE,
            InfoBox::TYPE_BLUE,
            InfoBox::TYPE_AQUA,
            InfoBox::TYPE_PURPLE,
            InfoBox::TYPE_MAR,
            InfoBox::TYPE_TEAL,
            InfoBox::TYPE_OLIVE,
        ];
        /*$brightColors = [
            InfoBox::TYPE_RED,
            InfoBox::TYPE_GREEN,
            InfoBox::TYPE_YEL,
            InfoBox::TYPE_LIME,
            InfoBox::TYPE_ORANGE,
            InfoBox::TYPE_FUS,
            #InfoBox::TYPE_BLACK,
            #InfoBox::TYPE_GRAY,
        ];*/

        srand(crc32($label));
        $rand = array_rand($colors);
        return $colors[$rand];
    }
}
