<?php

use yii\db\Migration;

/**
 * @author Albert Garipov <bert320@gmail.com>
 */
class m141209_150813_init extends Migration
{

    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS  {{%account}} (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `username` varchar(255) NOT NULL,
                `auth_key` varchar(32) NOT NULL,
                `password_hash` varchar(255) NOT NULL,
                `role` varchar(31) NOT NULL COMMENT 'Роль',
                `password_reset_token` varchar(255) DEFAULT NULL,
                `first_name` varchar(255) DEFAULT NULL,
                `last_name` varchar(255) DEFAULT NULL,
                `status` smallint(6) NOT NULL DEFAULT '10',
                `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
        ");
    }

    public function safeDown()
    {
        $this->execute("DROP TABLE IF EXISTS {{%account}};");
    }

}