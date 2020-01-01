<?php


namespace app\components\gui;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
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
					case 'update':
						$title = Yii::t('yii', 'Update');
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