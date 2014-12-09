<?php

use app\models\Candy;
use yii\web\View;

/* @var $this View */
/* @var $model Candy */

$this->title = "Конфета $model->id";
$this->params['breadcrumbs'] = [
    [
        'label' => 'Конфеты',
        'url' => ['index'],
    ],
    [
        'label' => $model->id,
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
