<?php

use app\models\Account;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Account */

$this->title = 'Создать пользователя';
$this->params['breadcrumbs'] = [
    [
        'label' => 'Пользователи',
        'url' => ['index'],
    ],
    'Создать пользователя',
];
?>
<div class="page-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>