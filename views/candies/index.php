<?php

use app\models\Account;
use app\models\Candy;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Конфеты';
$this->params['breadcrumbs'] = ['Конфеты'];
?>

<?php if (Yii::$app->user->can('manageCandies')): ?>
    <p class="clearfix">
        <?= Html::a('Создать конфету', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
<?php endif; ?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'attribute' => 'type',
            'value' => function(Candy $model) {
                return Candy::typeList()[$model->type];
            }
        ],
        'producer',
        [
            'attribute' => 'packing_type',
            'value' => function(Candy $model) {
                return Candy::packingTypeList()[$model->packing_type];
            }
        ],
        'packing_weight',
        'price',
        'created_at:datetime',
        'updated_at:datetime',
        [
            'attribute' => 'created_by',
            'format' => 'raw',
            'value' => function(Candy $model) {
                if ($model->createdBy->role === Account::ROLE_USER) {
                    return Html::a(Html::encode($model->createdBy->name), [
                        'users/view', 'id' => $model->createdBy->id,
                    ]);
                } else {
                    return Html::encode($model->createdBy->name);
                }
            }
        ],
        [
            'attribute' => 'updated_by',
            'format' => 'raw',
            'value' => function(Candy $model) {
                if ($model->updatedBy->role === Account::ROLE_USER) {
                    return Html::a(Html::encode($model->updatedBy->name), [
                        'users/view', 'id' => $model->updatedBy->id,
                    ]);
                } else {
                    return Html::encode($model->updatedBy->name);
                }
            }
        ],
        [
            'class' => ActionColumn::className(),
            'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    if (Yii::$app->user->can('manageCandies')) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    }
                },
                'delete' => function ($url, $model, $key) {
                    if (Yii::$app->user->can('manageCandies')) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                },
            ],
        ],
    ],
]);
?>