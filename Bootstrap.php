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
        // Add module URL rules.
        $app->urlManager->addRules(
            [
                '<_m:pages>' => '<_m>/default/index',
            ],
            false
        );
    }
}
