<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\select2\Select2;

/** @var $this yii\web\View */
/** @var $model app\models\freud\Concept */
?>
<div class="container concept-view">
	<br>
    <h3><?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

	<?php
	$words = \app\models\freud\Word::find()->orderBy('word DESC')->all();
	$wordData = [];
	foreach($words as $word)
	{
		$wordData[$word->id] = $word->word;
	}
	echo '<label class="control-label">Words</label>';
	echo Select2::widget([
		'name' => 'Concept[words]',
		'data' => $wordData,
		'value' => array_column($model->words, 'id'),
		'options' => [
			'placeholder' => 'Select words...',
			'multiple' => true,
			'disabled' => true
		],
	]);
	?>
</div>
