<?php

use app\models\Candy;
use app\widgets\Embedjs;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
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
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
        ]);
        ?>

        <?=
        $form->field($model, 'type')->dropDownList(Candy::typeList(), [
            'prompt' => ''
        ])
        ?>

        <?= $form->field($model, 'producer') ?>

        <?=
        $form->field($model, 'packing_type')->dropDownList(Candy::packingTypeList(), [
            'prompt' => ''
        ])
        ?>

        <?= $form->field($model, 'packing_weight') ?>

        <?=
        $form->field($model, 'price', [
            'options' => [
                'id' => ''
            ]
        ])
        ?>


        <?php
        $jsData = Json::encode([
            'typeInputId' => Html::getInputId($model, 'packing_type'),
            'weightInputId' => Html::getInputId($model, 'packing_weight'),
            'packedValue' => Candy::PACKING_TYPE_PACKED,
        ]);
        ?>
        <?php Embedjs::begin() ?>
        <script>
            // показываем вес упаковки только если конфеты в упаковке
            (function (data) {
                var changeHandler = function () {
                    var $weightInput = $('#' + data.weightInputId);
                    if ($(this).val() === data.packedValue) {
                        $weightInput.closest('.form-group').show();
                    } else {
                        $weightInput.closest('.form-group').hide();
                        $weightInput.val('');
                    }
                };
                $('#' + data.typeInputId).each(changeHandler).change(changeHandler);
            }(<?= $jsData ?>));
        </script>
        <?php Embedjs::end() ?>
        

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

