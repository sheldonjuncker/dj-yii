<?php

namespace app\controllers;

use app\components\gui\Breadcrumb;
use app\components\gui\ActionItem;
use app\models\data\ExportForm;

/**
 * Class DataController
 *
 * Imports and exports dream data.
 *
 * @package app\controllers
 */
class DataController extends BaseController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [];
	}

	public function beforeAction($action)
	{
		$this->addBreadcrumb(new Breadcrumb('Data', '/data'));
		return parent::beforeAction($action); // TODO: Change the autogenerated stub
	}

	public function actionExport()
	{
		$this->getView()->title = 'Export Dreams';
		$this->addBreadcrumb(new Breadcrumb('Export', '', true));

		$exportForm = new ExportForm();
		return $this->render('export', [
			'exportForm' => $exportForm
		]);
	}

	public function actionImport()
	{
		$this->getView()->title = 'Import Dreams';
		$this->addBreadcrumb(new Breadcrumb('Import', '', true));

		return $this->render('import');
	}
}