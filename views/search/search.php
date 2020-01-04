<?php
/** @var \yii\web\View $this */
/** @var \app\models\dj\Dream[] $dreams */

?>

<div class="container">
	<br>
	<h3><?=$this->title?></h3>

	<ol class="list-group list-group-activity">
		<?php
		foreach($dreams as $dream)
		{
			?>
			<li class="list-group-item">
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
							<a href="/dream/view/<?=$dream->getId()?>" class="A-filter-by-text"><?=$dream->getTitle()?></a>
						</div>
						<span class="text-small"><?=$dream->getFormattedDate()?></span>
					</div>
				</div>
			</li>
			<?php
		}
		if(!$dreams)
		{
			print "<i>No results found.</i>";
		}
		?>
	</ol>
</div>