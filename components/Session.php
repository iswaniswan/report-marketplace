<?php

namespace app\components;

use app\models\Role;
use Yii;

class Session extends \yii\web\Session
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public static function isAdmin()
    {        
        return (int) Yii::$app->user->identity->id_role == Role::ADMIN;
    }

    public function getPlatform()
    {
        return $this->get('platform', 'web');
    }

    public function isMobile()
    {
        if($this->getPlatform() == 'mobile') {
            return true;
        }

        return false;
    }

    public static function getUsername()
    {
        return Yii::$app->user->identity->username;
    }

    public static function getIdUser()
    {
        return (int) @Yii::$app->user->identity->id;
    }

}