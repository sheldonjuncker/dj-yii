<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */

//Fill these things in later from the base controller
$headerScripts = $this->params['headerScripts'] ?? [];
$bodyScripts = $this->params['bodyScripts'] ?? [];
$breadcrumbs = $this->params['breadcrumbs'] ?? [];
$actionItems = $this->params['actionItems'] ?? [];

$this->beginPage()
?>
<!-- Start of Header -->
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A project management Bootstrap theme by Medium Rare">
		<link href="/dist/assets/img/favicon.ico" rel="icon" type="image/x-icon">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
		<link href="/dist/assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
		<link href="/dist/assets/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" media="all" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title ? 'Dream Journal | ' . $this->title : 'Dream Journal | Celial.net') ?></title>
		<?php $this->head() ?>

<?php
		foreach($headerScripts as $script)
		{
			echo "\t\t" . $script->render() . "\n";
		}
?>
	</head>
<body>
<?php $this->beginBody() ?>
<!-- End of Header-->

<div class="layout layout-nav-side">
	<?php echo $this->renderFile('@app/views/layouts/left-navbar.php'); ?>
	<div class="main-container">
		<div class="breadcrumb-bar navbar bg-white sticky-top">
			<div class="col-lg-9">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
<?php
						foreach($breadcrumbs as $breadcrumb)
						{
						    echo "\t\t\t\t\t\t" . '<li class="breadcrumb-item ' . $breadcrumb->getActive() . '">' . $breadcrumb->getTitle() . '</li>' . "\n";
	                    }
?>
					</ol>
				</nav>
			</div>
			<div class="col-lg-3 text-right">
<?php
                foreach($actionItems as $actionItem)
                {
					echo "\t\t\t\t\t" . $actionItem->getItem() . "\n";
                }
?>
			</div>
		</div>
		<?= $content ?>
	</div>
</div>

<!-- Start of Footer -->
    <?php
    foreach($bodyScripts as $script)
    {
        echo $script->render();
    }
    ?>
    <!-- Custom JS -->
    <script type="text/javascript" src="/dist/assets/js/custom.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!-- End of Footer -->