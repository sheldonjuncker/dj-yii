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
	echo '<label class="control-label">Words</label>';
	echo Select2::widget([
		'name' => 'Concept[words]',
		'data' => $model->getFormData(),
		'value' => array_column($model->words, 'word'),
		'options' => [
			'placeholder' => 'Select words...',
			'multiple' => true,
			'disabled' => true
		],
	]);

	echo '<label class="control-label">Dreams</label>';
	echo "<ul>";
	foreach($model->getDreams() as $dream)
	{
		echo "<li>" . $dream->getTitle() . "</li>";
	}
	echo "</ul>";
	?>
</div>
