<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GuestQuestion */

$this->title = 'Create Guest Question';
$this->params['breadcrumbs'][] = ['label' => 'Guest Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
