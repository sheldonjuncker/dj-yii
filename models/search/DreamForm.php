<?php

namespace app\models\search;

use app\api\DreamAnalysis\DreamAnalysisApi;
use app\api\DreamAnalysis\DreamSearchRequest;
use app\api\DreamAnalysis\DreamSearchResponse;
use app\models\dj\Dream;
use yii\web\BadRequestHttpException;

class DreamForm extends \yii\base\Model
{
	/** @var string $search The search text */
	public $search;

	/** @var int|null $user_id Optional user id */
	public $user_id;

	/** @var  int|null $limit Maximum number of dreams to return. */
	public $limit;

	/** @var  int|null $page Page of results to return. */
	public $page;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// search
			[['search'], 'required'],
			[['user_id'], 'string'],
			[['limit', 'page'], 'number']
		];
	}

	public function attributeLabels()
	{
		return [
			'search' => 'Search Text'
		];
	}

	/**
	 * Performs a search against the API.
	 *
	 * @return DreamSearchResponse
	 */
	public function performSearch(): DreamSearchResponse
	{
		$dreamAnalysis = new DreamAnalysisApi();
		$dreamSearchRequest = new DreamSearchRequest();
		$dreamSearchRequest->user_id = $this->user_id;
		$dreamSearchRequest->search_text = $this->search;
		$dreamSearchRequest->page = $this->page;
		$dreamSearchRequest->limit = $this->limit;
		return $dreamAnalysis->search($dreamSearchRequest);
	}

	/**
	 * Reaches out to our ol' friend Jung and searches for dreams.
	 *
	 * @return Dream[]
	 */
	public function getDreams(): array
	{
		$dreamSearchResponse = $this->performSearch();
		if(!$dreamSearchResponse->isSuccess())
		{
			throw new BadRequestHttpException('Error: code=' . $dreamSearchResponse->code . ', error=' . $dreamSearchResponse->error . '.');
		}
		else
		{
			return $dreamSearchResponse->getDreams();
		}
	}
}