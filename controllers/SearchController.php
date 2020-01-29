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
		$access = $this->getDefaultAccess();
		return $access;
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

	public function actionList()
	{
		$dreamForm = new DreamForm();
		$dreamForm->user_id = $this->getUser()->getId();
		$dreamForm->load(\Yii::$app->request->get());
		$dreamSearchResponse = $dreamForm->performSearch();
		$data = [
			'total' => 0,
			'results' => []
		];
		if($dreamSearchResponse->isSuccess())
		{
			$dreamData = [];
			foreach($dreamSearchResponse->getDreams() as $dream)
			{
				$dreamData[] = [
					'id' => $dream->getId(),
					'title' => $dream->getTitle(),
					'date' => $dream->getFormattedDate()
				];
			}
			$data['total'] = $dreamSearchResponse->total;
			$data['results'] = $dreamData;
		}

		return $this->asJson($data);
	}

	public function actionRelated(string $id)
	{
		$dreamForm = new DreamForm();
		$dreamForm->user_id = $this->getUser()->getId();
		$dreamForm->load(\Yii::$app->request->get());
		$dreamSearchResponse = $dreamForm->performSearch();
		$data = [
			'total' => 0,
			'results' => []
		];
		if($dreamSearchResponse->isSuccess())
		{
			$dreamData = [];
			foreach($dreamSearchResponse->getDreams() as $dream)
			{
				$dreamData[] = [
					'id' => $dream->getId(),
					'title' => $dream->getTitle(),
					'date' => $dream->getFormattedDate()
				];
			}
			$data['total'] = $dreamSearchResponse->total;
			$data['results'] = $dreamData;
		}

		return $this->asJson($data);
	}

	public function actionSearch()
	{
		$dreamForm = new DreamForm();
		$dreamForm->user_id = $this->getUser()->getId();
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