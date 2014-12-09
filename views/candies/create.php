<?php

use app\models\Candy;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Candy */

$this->title = 'Создать конфету';
$this->params['breadcrumbs'] = [
    [
        'label' => 'Конфеты',
        'url' => ['index'],
    ],
    'Создать конфету',
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