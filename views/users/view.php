<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = "Пользователь $model->name";
$this->params['breadcrumbs'] = [
    [
        'label' => 'Пользователи',
        'url' => ['index'],
    ],
    $model->name,
];
?>

<?= $this->render('_tabs', ['model' => $model]) ?>

<div class="container-fluid">
    <div class="col-md-6">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'first_name',
                'last_name',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ])
        ?>
    </div>
</div>


