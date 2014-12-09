<?php

namespace app\commands;

use app\models\Account;
use Yii;
use yii\console\Controller;

/**
 * Allows you to create or rewrite site admin account.
 * 
 * @author Albert Garipov <bert320@gmail.com>
 */
class CreateAdminController extends Controller
{

    /**
     * Rewrite account record's data if it exists.
     * @var boolean
     */
    public $rewrite = false;

    /**
     * @var string
     */
    public $password = null;

    public function options($actionID)
    {
        $options = array_merge(parent::options($actionID), [
            'rewrite', 'password',
        ]);
        return $options;
    }

    public function actionIndex()
    {
        $account = Account::findOne(1);
        if ($account !== null && !$this->rewrite) {
            print("Error: account (ID=1) already exists. Set rewrite=true to rewrite it.\n");
            return;
        }

        if ($account === null) {
            $account = new Account;
            $account->id = 1;
            $account->username = 'admin';
        } else {
            if ($account->role !== Account::ROLE_ADMIN) {
                print("Error: account (ID=1) should have 'admin' role .\n");
                return;
            }
        }

        $account->generateAuthKey();

        if ($this->password) {
            $password = $this->password;
        } else {
            $password = Yii::$app->security->generateRandomString(12);
            print("pass: \"{$password}\"\n");
        }
        $account->setPassword($password);

        $account->role = Account::ROLE_ADMIN;

        $account->save(false) ? print("Ok.\n") : print("Fail.\n");
    }

}