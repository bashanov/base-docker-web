<?php

namespace app\controllers;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}