<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\PasswordResetForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Password Reset Request';
?>
<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>

	<p>We're sorry you forgot your password. To tell the truth, we don't know what it is either, so you'll have to enter your email address and we'll send you a code so that you can reset it.</p>

	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'layout' => 'horizontal',
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-1 control-label'],
		],
	]); ?>

	<?= $form->field($model, 'email')->textInput(['autofocus' => true, 'type' => 'email']) ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Send Request', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
