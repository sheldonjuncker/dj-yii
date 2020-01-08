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
</div>