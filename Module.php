<?php

namespace fonclub\pages;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'fonclub\pages\controllers';

    public $appId = 'backend';

    public function init()
    {
        $this->viewPath = $this->viewPath.'\\'.$this->appId;

        parent::init();

        // custom initialization code goes here
    }
}
