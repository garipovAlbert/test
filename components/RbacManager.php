<?php

namespace app\components;

use app\models\Account;
use Yii;
use yii\rbac\DbManager;

/**
 * @author Albert Garipov <bert320@gmail.com>
 */
class RbacManager extends DbManager
{

    public function getAssignments($userId)
    {
        $assignments = parent::getAssignments($userId);

        /* @var $identity Account */
        $identity = Yii::$app->getUser()->getIdentity();
        if ($identity !== null && $identity->id === $userId) {
            $assignments[$identity->role] = true;
        } else {
            $role = Account::find()
            ->select('role')
            ->where(['id' => (string) $userId])
            ->scalar();
            $assignments[$role] = true;
        }

        return $assignments;
    }

}