<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dj\DreamCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>
	<div class="dream-category-form">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
