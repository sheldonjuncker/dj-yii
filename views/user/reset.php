<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\PasswordResetForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Password Reset';
?>
<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>

	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'layout' => 'horizontal',
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-1 control-label'],
		],
	]); ?>

	<?= $form->field($model, 'new_password')->textInput(['autofocus' => true, 'type' => 'password']) ?>
	<?= $form->field($model, 'new_password_verify')->textInput(['type' => 'password']) ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Reset Password', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
