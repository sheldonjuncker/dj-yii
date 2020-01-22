<?php
/** @var bool $editable */
?>
<div id="dream-comment-app" class="col-lg-12">
	<!-- Dream Comment Modal -->
<?php
	if($editable)
	{
?>
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
<?php
	}
?>

	<div class="dream comments-container">
		<div class="deleted">
			<input v-for="deleted in deletedComments" type="hidden" :name="'Dream[comment][deleted][' + deleted.id + ']'" value="1" />
		</div>

		<div v-for="comment in comments" class="dream comment row">
			<div class="col-lg-8">
				<b>{{ comment.author }}</b>
			</div>
			<div class="col-lg-4">
				<i>{{ comment.date }}</i>
			</div>
			<div class="col-lg-12">
				<p>{{ comment.text }}</p>
			</div>
		<?php
			if($editable)
			{
		?>
			<div class="col-lg-12">
				<input type="hidden" :name="'Dream[comment][' + comment.id + ']'" :value="comment.text" :id="'DreamComment_' + comment.id" />
				<button type="button" class="btn btn-sm btn-warning" v-on:click="editComment(comment.id)">Edit</button>
				<button type="button" class="btn btn-sm btn-danger" v-on:click="deleteComment(comment.id)">Delete</button>
			</div>
		<?php
			}
		?>
		</div>
	</div>
	<!-- Button trigger modal -->
	<?php
	if($editable)
	{
		?>
		<button type="button" class="btn btn-success" v-on:click="newComment">Add comment</button>
		<?php
	}
	?>
</div>