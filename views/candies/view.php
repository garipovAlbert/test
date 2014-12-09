<?php

use app\models\Account;
use app\models\Candy;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Candy */

$this->title = "Конфета $model->id";
$this->params['breadcrumbs'] = [
    [
        'label' => 'Конфеты',
        'url' => ['index'],
    ],
    $model->id,
];
?>

<?= $this->render('_tabs', ['model' => $model]) ?>

<div class="container-fluid">
    <div class="col-md-6">
        <?php
        $attributes = [];
        $attributes[] = 'id';
        $attributes[] = [
            'attribute' => 'type',
            'value' => Candy::typeList()[$model->type]
        ];
        $attributes[] = 'producer';
        $attributes[] = [
            'attribute' => 'packing_type',
            'value' => Candy::packingTypeList()[$model->packing_type]
        ];
        if ($model->packing_type === Candy::PACKING_TYPE_PACKED) {
            $attributes[] = 'packing_weight';
        }
        $attributes[] = 'price';
        $attributes[] = 'created_at:datetime';
        $attributes[] = 'updated_at:datetime';

        if ($model->createdBy->role === Account::ROLE_USER) {
            $attributes[] = [
                'attribute' => 'created_by',
                'value' => Html::a(Html::encode($model->createdBy->name), [
                    'users/view', 'id' => $model->createdBy->id,
                ]),
                'format' => 'raw',
            ];
        } else {
            $attributes[] = [
                'attribute' => 'created_by',
                'value' => $model->createdBy->name,
            ];
        }

        if ($model->updatedBy->role === Account::ROLE_USER) {
            $attributes[] = [
                'attribute' => 'updated_by',
                'value' => Html::a(Html::encode($model->updatedBy->name), [
                    'users/view', 'id' => $model->updatedBy->id,
                ]),
                'format' => 'raw',
            ];
        } else {
            $attributes[] = [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->name,
            ];
        }

        echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes,
        ])
        ?>
    </div>
</div>


