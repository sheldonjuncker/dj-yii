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
		echo '<label class="control-label">Add Words</label>';
		echo Select2::widget([
			'name' => 'Concept[words]',
			'data' => \app\models\freud\Word::getFormData(),
			'value' => array_column($model->words, 'id'),
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
