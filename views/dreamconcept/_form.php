<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $model app\models\freud\Concept */
/** @var $form yii\widgets\ActiveForm */
?>

<div class="container concept-form">
	<br>
	<h3><?=$this->title?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?php
		$words = \app\models\freud\Word::find()->orderBy('word DESC')->all();
		$wordData = [];
		foreach($words as $word)
		{
			$wordData[$word->id] = $word->word;
		}
		echo '<label class="control-label">Add Words</label>';
		echo Select2::widget([
			'name' => 'Concept[words]',
			'data' => $wordData,
			'options' => [
				'placeholder' => 'Select words...',
				'multiple' => true
			],
		]);
		?>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->getIsNewRecord() ? 'Add' : 'Edit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
