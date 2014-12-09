<?php

use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'] = ['Пользователи'];
?>

<?php if (Yii::$app->user->can('manageUsers')): ?>
    <p class="clearfix">
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
<?php endif; ?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'username',
        'last_name',
        'first_name',
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => ActionColumn::className(),
            'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
            'visible' => Yii::$app->user->can('manageUsers'),
        ],
    ],
]);
?>