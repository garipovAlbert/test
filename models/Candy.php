<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%candy}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $producer
 * @property string $packing_type
 * @property integer $price
 * @property integer $packing_weight
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Account $createdBy
 * @property Account $updatedBy
 */
class Candy extends ActiveRecord
{

    // шоколадные
    const TYPE_CHOCOLATE = 'CHOCOLATE';
    // карамель леденцовая
    const TYPE_LOLLIPOP = 'LOLLIPOP';
    // карамель с начинкой
    const TYPE_WITH_FILLING = 'WITH_FILLING';
    // фасовка: упаковка
    const PACKING_TYPE_PACKED = 'PACKED';
    // фасовка: на развес
    const PACKING_TYPE_LOOSE = 'LOOSE';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%candy}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public static function typeList()
    {
        return [
            static::TYPE_CHOCOLATE => 'Шоколадные',
            static::TYPE_LOLLIPOP => 'Карамель леденцовая',
            static::TYPE_WITH_FILLING => 'Карамель с начинкой',
        ];
    }

    public static function packingTypeList()
    {
        return [
            static::PACKING_TYPE_PACKED => 'Упаковка',
            static::PACKING_TYPE_LOOSE => 'На развес',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'producer', 'packing_type', 'price'], 'required'],
            ['type', 'in', 'range' => array_keys(static::typeList())],
            ['packing_type', 'in', 'range' => array_keys(static::packingTypeList())],
            ['price', 'integer'],
            ['producer', 'string', 'max' => 31],
            [
                // вес упаковки нужен только если конфеты в упаковке
                'packing_weight', 'required',
                'when' => function(Candy $model) {
                    return $model->packing_type == static::PACKING_TYPE_PACKED;
                },
            ],
            ['packing_weight', 'integer'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // удаляем вес упаковки, если конфеты не в упаковке
            if ($this->packing_type !== static::PACKING_TYPE_PACKED) {
                $this->packing_weight = null;
            }

            if ($this->isNewRecord) {
                $this->created_by = Yii::$app->user->identity->id;
            }
            $this->updated_by = Yii::$app->user->identity->id;

            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'producer' => 'Производитель',
            'packing_type' => 'Фасовка конфет',
            'price' => 'Цена за кг',
            'packing_weight' => 'Вес упаковки',
            'created_at' => 'Время создания',
            'updated_at' => 'Время изменения',
            'created_by' => 'Кто создал',
            'updated_by' => 'Кто изменил',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Account::className(), ['id' => 'created_by']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Account::className(), ['id' => 'updated_by']);
    }

}