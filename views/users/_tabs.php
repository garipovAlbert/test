<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$actionId = Yii::$app->controller->action->id;
?>

<?php if (Yii::$app->user->can('manageUsers')): ?>
    <?php
    echo Nav::widget([
        'options' => [
            'class' => 'nav nav-tabs',
            'role' => 'tablist',
            'style' => 'margin-bottom: 40px;',
        ],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => 'Обзор',
                'url' => ['view', 'id' => $model->id],
                'active' => $actionId === 'view',
            ],
            [
                'label' => 'Редактирование',
                'url' => ['update', 'id' => $model->id],
                'active' => $actionId === 'update',
            ],
        ],
    ]);
    ?>
<?php endif; ?>
