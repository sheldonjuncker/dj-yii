<?php
/** @var \yii\web\View $this */
/** @var \app\models\search\DreamForm $dreamForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="container">
	<br>
	<h3><?=$this->title?></h3>

	<div class="import-form">
		<?php $form = ActiveForm::begin([
			'method' => 'get',
			'action' => '/search/search'
		]); ?>

		<?= $form->field($dreamForm, 'search')->textInput() ?>

		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>