<div class="container">
	<br>
	<div class="row content-list-head">
		<div class="col-auto">
			<h3>Recent Dreams</h3>
		</div>
		<div class="col-md-auto">
			<ul class="nav nav-pills nav-small">
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" role="tab" aria-controls="day" aria-selected="false">Day</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" role="tab" aria-controls="week" aria-selected="true">Week</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" role="tab" aria-controls="month" aria-selected="false">Month</a>
				</li>
			</ul>
		</div>
	</div>
	<hr>

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
                            <a href="/dream/show/<?=$dream->getId()?>" class="A-filter-by-text"><?=$dream->getTitle()?>}</a>
                        </div>
                        <span class="text-small"><?=$dream->getFormattedDate()?></span>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
	</ol>
</div>