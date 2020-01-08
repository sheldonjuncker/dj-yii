<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var $this yii\web\View */
/** @var $searchModel app\models\freud\ConceptSearch */
/** @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="container concept-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['class' => \app\components\gui\ActionColumn::class],
        ],
    ]); ?>
</div>
