<?php

namespace app\controllers;

use app\components\graph\DreamGraphData;
use app\components\gui\Breadcrumb;
use app\components\gui\js\Script;

class AnalysisController extends BaseController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		$access = $this->getDefaultAccess();
		return $access;
	}

	public function beforeAction($action)
	{
		$this->getScriptRegistrar()->registerScript(new Script('chart.js', Script::POS_HEAD));

		$this->addBreadcrumb(new Breadcrumb('Dream Journal', '/'));
		$this->addBreadcrumb(new Breadcrumb('Analysis'));
		return parent::beforeAction($action);
	}

	public function actionWeek()
	{
		$this->addBreadcrumb(new Breadcrumb('Dreams by Day of Week', '', true));

		$dreamGraphData = new DreamGraphData();
		return $this->render('week', [
			'dreamCountData' => $dreamGraphData->getDreamCountByDayOfWeek()
		]);
	}

	public function actionMonth()
	{
		$this->addBreadcrumb(new Breadcrumb('Dreams by Month', '', true));

		$dreamGraphData = new DreamGraphData();
		return $this->render('month', [
			'dreamCountData' => $dreamGraphData->getDreamCountByMonth()
		]);
	}

	public function actionCategory()
	{
		$this->addBreadcrumb(new Breadcrumb('Dreams by Category', '', true));

		$dreamGraphData = new DreamGraphData();
		return $this->render('category', [
			'dreamCountData' => $dreamGraphData->getDreamCountByCategory()
		]);
	}
}