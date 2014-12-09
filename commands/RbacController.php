<?php

namespace app\commands;

use app\models\Account;
use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;

/**
 * @author Albert Garipov <bert320@gmail.com>
 */
class RbacController extends Controller
{

    const TASK_MANAGE_USER = 'manageUsers';
    const TASK_MANAGE_CANDIES = 'manageCandies';

    public function actionInit()
    {
        /* @var $auth DbManager */
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        // permission
        $manageUsers = $auth->createPermission(self::TASK_MANAGE_USER);
        $auth->add($manageUsers);
        
        $manageCandies = $auth->createPermission(self::TASK_MANAGE_CANDIES);
        $auth->add($manageCandies);


        // roles
        $roleUser = $auth->createRole(Account::ROLE_USER);
        $auth->add($roleUser);
        $auth->addChild($roleUser, $manageCandies);

        $roleAdmin = $auth->createRole(Account::ROLE_ADMIN);
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $manageUsers);
        $auth->addChild($roleAdmin, $roleUser);

        $roleGuest = $auth->createRole(Account::ROLE_GUEST);
        $auth->add($roleGuest);
        
        print("rbac/init: Ok!\n");
    }

}