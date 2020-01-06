<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dream app\models\dj\Dream */
/* @var $form yii\widgets\ActiveForm */
/** @var \app\models\dj\DreamType[] $dreamTypes */
/** @var bool $dreamTypesDisabled */
?>

<div class="container">
	<br>
	<h3><?= Html::encode($this->title) ?></h3>
	<div class="dream-form">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($dream, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($dream, 'dreamt_at')->textInput([
			'class' => 'form-control flatpickr-input',
			'data-flatpickr' => '',
			'data-default-date' => '',
			'data-alt-input' => 'true'
		]) ?>

		<?= $form->field($dream, 'description')->textarea(['rows' => 12]) ?>

		<div class="form-group">
			<label>Dream Type</label>
			<div>
				<?php
				foreach($dreamTypes as $dreamType)
				{
					$checked = $dream->hasType($dreamType) ? 'checked' : '';
					$disabled = $dreamTypesDisabled ? 'disabled' : '';
					?>
					<div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="DreamType_<?=$dreamType->getId()?>" name="Dream[types][<?=$dreamType->getId()?>]" <?=$checked?> <?=$disabled?>>
						<label class="custom-control-label" for="DreamType_<?=$dreamType->getId()?>"><?=$dreamType->getName()?></label>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="form-group">
			<label for="Dream_categories">Dream Categories</label>
			<?= Html::textInput('Dream[categories]', $categoryIdString, [
				'id' => 'Dream_categories',
				'class' => 'form-control'
			])?>
		</div>

		<div class="form-group">
			<?= Html::submitButton($dream->getIsNewRecord() ? 'Add' : 'Update', ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
