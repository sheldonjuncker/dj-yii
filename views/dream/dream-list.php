<?php
/** @var bool $canFilter */
?>
<div id="dream-list-app" class="col-lg-12">
	<?php
	if($canFilter)
	{
		?>
		<input type="text" name="filter" class="form-control" v-on:click="filter" />
		<?php
	}
	?>
	<li v-for="dream in dreams" class="list-group-item">
		<div class="media align-items-center">
			<ul class="avatars">
				<li>
					<div class="avatar bg-primary">
						<i class="material-icons">single_bed</i>
					</div>
				</li>
			</ul>
			<div class="media-body">
				<div>
					<a :href="'/dream/view/' + dream.id" class="A-filter-by-text">{{ dream.title }}</a>
				</div>
				<span class="text-small">{{ dream.date }}</span>
			</div>
		</div>
	</li>
</div>