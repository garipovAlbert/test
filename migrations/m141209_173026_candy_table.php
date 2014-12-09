<?php

use yii\db\Migration;

/**
 * @author Albert Garipov <bert320@gmail.com>
 */
class m141209_173026_candy_table extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS {{%candy}} (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `type` enum('CHOCOLATE','LOLLIPOP','WITH_FILLING') NOT NULL COMMENT 'Тип',
                `producer` varchar(31) NOT NULL COMMENT 'Производитель',
                `packing_type` enum('PACKED','LOOSE') NOT NULL COMMENT 'Фасовка конфет',
                `price` int(10) unsigned NOT NULL COMMENT 'Цена за кг',
                `packing_weight` int(10) unsigned DEFAULT NULL COMMENT 'Вес упаковки',
                `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                `created_by` int(11) unsigned DEFAULT NULL,
                `updated_by` int(11) unsigned DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `candy_fk_1` (`created_by`),
                KEY `candy_fk_2` (`updated_by`),
                CONSTRAINT `candy_fk_1` FOREIGN KEY (`created_by`) 
                    REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `candy_fk_2` FOREIGN KEY (`updated_by`) 
                    REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function safeDown()
    {
        $this->execute("DROP TABLE IF EXISTS {{%candy}};");
    }
}
