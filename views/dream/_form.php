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

		<!-- Used by JS to find the dream's id. -->
		<?= Html::hiddenInput('_Dream[id]', $dream->getId(), [
			'id' => 'Dream_id'
		]) ?>

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

		<div class="row col-lg-12">
			<label>Comments</label>
			<div id="dream-comment-app" class="col-lg-12">
				<!-- Dream Comment Modal -->
				<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="commentModalLabel">{{ title }}</h5>
							</div>
							<div class="modal-body">
								<div class="form">
									<div class="form-group">
										<label for="dream-comment">Comment</label>
										<textarea id="dream-comment" class="form-control" rows="6" v-model="text">{{ text }}</textarea>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" v-on:click="saveComment" data-dismiss="modal">{{ buttonTitle }}</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Modal -->
				<div class="dream comments-container">
					<div v-for="comment in comments" class="dream comment row">
						<div class="col-lg-8">
							<b>{{ comment.author }}</b>
						</div>
						<div class="col-lg-4">
							<i>{{ comment.date }}</i>
						</div>
						<div class="col-lg-12">
							<p>{{ comment.text }}</p>
							<input type="hidden" :name="'Dream[comment][' + comment.id + ']'" :value="comment.text" :id="'DreamComment_' + comment.id" />
						</div>
						<div class="col-lg-12">
							<button type="button" class="btn btn-sm btn-warning" v-on:click="editComment(comment.id)">Edit</button>
							<button type="button" class="btn btn-sm btn-danger" v-on:click="deleteComment(comment.id)">Delete</button>
						</div>
					</div>
				</div>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success" v-on:click="newComment">Add comment</button>
			</div>
		</div>

		<div class="form-group">
			<?= Html::submitButton($dream->getIsNewRecord() ? 'Add' : 'Update', ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
