<?php
/** @var \app\models\dj\Dream $dream */
/** @var \app\models\dj\DreamType[] $dreamTypes */
/** @var bool $dreamTypesDisabled */
?>

<div class="container">
    <br>
    <div class="row col-lg-12">
        <div class="col-lg-9">
            <h4><?=$dream->getTitle()?></h4>
        </div>
        <div class="col-lg-3 text-center">
			<?=$dream->getFormattedDate()?>
        </div>
    </div>
    <hr>
    <div class="row col-lg-12">
        <p><?=nl2br($dream->getDescription())?></p>
    </div>
    <hr>
    <div class="row col-lg-12">
		<?php
        //$dreamTypesElement->render()
        ?>
    </div>
	<div class="row col-lg-12">
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
						<input type="checkbox" class="custom-control-input" id="DreamType_<?=$dreamType->getId()?>}" name="Dream[types][<?=$dreamType->getId()?>]" <?=$checked?> <?=$disabled?>>
						<label class="custom-control-label" for="DreamType_<?=$dreamType->getId()?>"><?=$dreamType->getName()?></label>
					</div>
<?php
				}
?>
			</div>
		</div>
	</div>
	<hr>
    <div class="row col-lg-12">
        <div class="form-group">
            <label>Dream Categories</label>
            <div>
				<?php
				foreach($dream->categories as $category)
				{
					?>
                    <span class="badge badge-primary badge-pill rounded-pill"><?=$category->getName()?></span>
					<?php
				}

				if(!$dream->categories)
				{
					?>
                    <span class="badge badge-primary badge-pill rounded-pill">None</span>
					<?php
				}
				?>
            </div>
        </div>
    </div>
	<hr>
	<div class="row col-lg-12">
		<div class="form-group">
			<label>Concepts</label>
			<div>
				<?php
				echo '<ul>';
				foreach($dream->getConcepts() as $concept)
				{
					echo '<li>' . $concept->name . '</li>';
				}
				echo '</ul>';
				?>
			</div>
		</div>
	</div>
	<hr>
	<div class="row col-lg-12">
		<div class="form-group">
			<label>Similar Dreams</label>
			<div>
				<?php
				echo '<ul>';
				foreach($dream->findRelated() as $relatedDream)
				{
					if($dream->id !== $relatedDream->id)
					{
						echo '<li>' . $relatedDream->title . '</li>';
					}
				}
				echo '</ul>';
				?>
			</div>
		</div>
	</div>
	<hr>
	<div class="row col-lg-12">
		<label>Comments</label>
		<div id="dream-comment-app" class="col-lg-12">
			<!-- Dream Comment Modal -->
			<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="commentModalLabel">Dream Comment</h5>
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
				<comment
						v-for="comment in comments"
						v-bind:comment="comment"
						v-bind:key="comment.id"
				></comment>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success" data-toggle="modal" v-on:click="newComment">Add comment</button>
		</div>
	</div>
</div>