<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\dj\DreamCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>
	<div class="dream-category-index">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				'id',
				'name',
				['class' => \app\components\gui\ActionColumn::class],
			],
		]); ?>


	</div>
</div>