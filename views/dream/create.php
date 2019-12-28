<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\dj\Dream */

$this->title = 'Create Dream';
$this->params['breadcrumbs'][] = ['label' => 'Dreams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
