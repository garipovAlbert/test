<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model common\models\City */
/* @var $form ActiveForm */
?>
<div class="container-fluid">
    <div class="col-md-3">

        <?php
        $form = ActiveForm::begin([
            'options' => [
                'autocomplete' => 'Off',
            ],
//            'enableClientValidation' => false,
//            'enableAjaxValidation' => true,
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

        <!-- disables autocomplete --><input type="text" style="display:none">

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 31]) ?>

        <?= $form->field($model, 'first_name')->textInput() ?>
        <?= $form->field($model, 'last_name')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

