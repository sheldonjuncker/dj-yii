<?php


namespace app\components\gui;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
	public $template = '{view} {edit} {delete}';

	/**
	 * Initializes the default button rendering callbacks.
	 */
	protected function initDefaultButtons()
	{
		$this->initDefaultButton('view', 'eye-open');
		$this->initDefaultButton('edit', 'pencil');
		$this->initDefaultButton('delete', 'trash', [
			'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
			'data-method' => 'post',
		]);
	}

	/**
	 * Overridden to avoid issues with Bootstrap 4 not coming with glyph icons.
	 *
	 * @param string $name
	 * @param string $iconName
	 * @param array $additionalOptions
	 */
	protected function initDefaultButton($name, $iconName, $additionalOptions = [])
	{
		if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
			$this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
				$buttonClass = "btn-default";
				switch ($name) {
					case 'view':
						$title = Yii::t('yii', 'View');
						$buttonClass = "btn-primary";
						break;
					case 'edit':
						$title = Yii::t('yii', 'Edit');
						$buttonClass = "btn-warning";
						break;
					case 'delete':
						$title = Yii::t('yii', 'Delete');
						$buttonClass = "btn-danger";
						break;
					default:
						$title = ucfirst($name);
				}
				$options = array_merge([
					'title' => $title,
					'aria-label' => $title,
					'data-pjax' => '0',
					'class' => 'btn btn-sm btn-light'
				], $additionalOptions, $this->buttonOptions);
				return Html::a($title, $url, $options);
			};
		}
	}
}