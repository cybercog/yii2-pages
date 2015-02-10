<?php

namespace fonclub\pages;

use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package fonclub\pages
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $backend = strpos($app->controllerNamespace, 'backend') === false ? false : true;

        if( $backend )
            $app->urlManager->addRules(
                [
                    '<_m:pages>' => '<_m>/admin/index',
                    '<_m:pages>/<_a>' => '<_m>/admin/<_a>',
                ],
                false
            );
        else
            $app->urlManager->addRules(
                [
                    '<_m:pages>' => '<_m>/default/index',
                ],
                false
            );
    }
}
