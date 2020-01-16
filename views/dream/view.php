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

	<div class="row col-lg-12">
		<div class="form-group">
			<label>Comments</label>
			<div id="dream-comment-app">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCommentModal">
					Add comment
				</button>

				<!-- Modal -->
				<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="addCommentModalLabel">Dream Comment</h5>
							</div>
							<div class="modal-body">
								{{ message }}
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Add</button>
							</div>
						</div>
					</div>
				</div>

				<div class="dream comments-container">
					<ul>
						<li v-for="comment in comments" class="dream comment">
							<div>
								<b>{{ comment.author }}</b>
							</div>
							<div>
								<i>{{ comment.date }}</i>
							</div>
							<div>
								<p>{{ comment.text }}</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>