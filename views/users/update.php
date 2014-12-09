<?php

use app\models\Account;
use yii\web\View;

/* @var $this View */
/* @var $model Account */

$this->title = "Пользователь $model->first_name $model->last_name";
$this->params['breadcrumbs'] = [
    [
        'label' => 'Пользователи',
        'url' => ['index'],
    ],
    [
        'label' => $model->name,
        'url' => ['view', 'id' => $model->id],
    ],
    'Редактирование',
];
?>

<?= $this->render('_tabs', ['model' => $model]) ?>

<div class="page-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
