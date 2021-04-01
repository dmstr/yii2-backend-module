<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\backend\controllers;


use yii\web\Controller;
use Yii;

class CacheController extends Controller
{

    /**
     * @event when cache flush failed
    */
    const EVENT_CACHE_FLUSH_ERROR = 'cacheFlushError';

    /**
     * @event when cache flush was successful
     */
    const EVENT_CACHE_FLUSH_SUCCESS = 'cacheFlushSuccess';

    /**
     * flush cache
     *
     * if APCu is used as cache we cannot flush cache from cli command
     * see: https://github.com/yiisoft/yii2/issues/8647
     *
     * @return \yii\web\Response
     */
    public function actionFlush()
    {
        if (\Yii::$app->cache->flush()) {
            \Yii::$app->session->addFlash('success', Yii::t('backend-module','Cache cleared'));
            $this->trigger(static::EVENT_CACHE_FLUSH_SUCCESS);
        } else {
            \Yii::$app->session->addFlash('error', Yii::t('backend-module','Cannot clear cache'));
            $this->trigger(static::EVENT_CACHE_FLUSH_ERROR);
        }
        return $this->redirect(['default/index']);
    }
}