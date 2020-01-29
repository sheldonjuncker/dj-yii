<?php

/** @var \yii\web\View $this */
/** @var bool $canFilter */
/** @var string $formAction */

echo $this->renderFile('@app/views/dream/dream-list.php', [
	'canFilter' => true,
	'formAction' => $formAction
]);