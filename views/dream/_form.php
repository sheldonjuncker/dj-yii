<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dj\Dream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>
	<div class="dream-form">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'dreamt_at')->textInput([
			'class' => 'form-control flatpickr-input',
			'data-flatpickr' => '',
			'data-default-date' => '',
			'data-alt-input' => 'true'
		]) ?>

		<?= $form->field($model, 'description')->textarea(['rows' => 12]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->getIsNewRecord() ? 'Add' : 'Update', ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
