<?php
/** @var \yii\web\View $this */
/** @var \app\models\data\ImportForm $importForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="container">
	<br>
	<h3><?=$this->title?></h3>

	<div class="import-form">
		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

		<?= $form->field($importForm, 'format')->dropDownList([
			'json' => 'JSON',
			'text' => 'Text'
		]) ?>

		<?= $form->field($importForm, 'file')->fileInput() ?>

		<?= Html::submitButton('Import', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>