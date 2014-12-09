<?php

use app\widgets\Alert;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

/* @var $this View */
/* @var $content string */

$cId = Yii::$app->controller->id;
$route = Yii::$app->controller->route;
?>

<?php $this->beginContent('@app/views/layouts/blank.php'); ?>


<div class="container-fluid">
    <div class="col-md-10 well content-area">
        <?=
        Breadcrumbs::widget([
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <div class="col-md-2">
        <!-- MENU -->
        <?php
        echo Menu::widget([
            'encodeLabels' => false,
            'options' => [
                'class' => 'nav left-menu',
            ],
            'items' => [
                [
                    'label' => 'Главная',
                    'url' => ['/'],
                    'active' => $route === 'site/index',
                ],
                [
                    'label' => 'Пользователи',
                    'url' => ['/users/index'],
                    'active' => $cId === 'users',
                ],
                [
                    'label' => 'Конфеты',
                    'url' => ['/candies/index'],
                    'active' => $cId === 'candies',
                ],
            ],
        ]);
        ?>
        <!-- /MENU -->
    </div>
</div>


<?php $this->endContent(); ?>
