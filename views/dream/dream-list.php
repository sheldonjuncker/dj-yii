<?php
/** @var bool $canFilter */
?>
<div id="dream-list-app" class="col-lg-12">
	<?php
	if($canFilter)
	{
		?>
		<input v-model="filter" type="text" name="filter" placeholder="Search for dreams..." class="form-control" v-on:keyup.enter="search()" v-on:blur="search()" />
		<?php
	}
	?>

	<button v-on:click="prev()" type="button" class="btn btn-primary">Previous</button>
	<span> page </span>
	<button type="button" class="btn btn-primary btn-sm">{{ currentPage + 1 }}</button>
	<span> of </span>
	<button type="button" class="btn btn-primary btn-sm">{{ totalPages }}</button>
	<button v-on:click="next()" type="button" class="btn btn-primary">Next</button>
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