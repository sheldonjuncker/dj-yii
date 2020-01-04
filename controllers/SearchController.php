<?php

namespace app\controllers;

use app\components\gui\Breadcrumb;
use app\models\search\DreamForm;

class SearchController extends BaseController
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
		$this->addBreadcrumb(new Breadcrumb('Dream Journal', '/'));
		return parent::beforeAction($action);
	}

	public function actionIndex()
	{
		$this->getView()->title = 'Dream Search';
		$this->addBreadcrumb(new Breadcrumb('Search', '', true));
		$dreamForm = new DreamForm();

		return $this->render('index', [
			'dreamForm' => $dreamForm
		]);
	}

	public function actionSearch()
	{
		$dreamForm = new DreamForm();
		$dreamForm->load(\Yii::$app->request->get());

		$this->getView()->title = 'Search Results';
		$this->addBreadcrumb(new Breadcrumb('Search', '/search'));
		$this->addBreadcrumb(new Breadcrumb('Results for "' . $dreamForm->search . '"', '', true));

		$dreams = $dreamForm->getDreams();

		return $this->render('search', [
			'dreams' => $dreams
		]);
	}
}