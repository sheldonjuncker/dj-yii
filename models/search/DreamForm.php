<?php

namespace app\models\search;

use app\api\DreamAnalysis\DreamAnalysisApi;
use app\api\DreamAnalysis\DreamSearchRequest;
use app\models\dj\Dream;
use yii\web\BadRequestHttpException;

class DreamForm extends \yii\base\Model
{
	/** @var string $search The search text */
	public $search;

	/** @var int|null $user_id Optional user id */
	public $user_id;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// search
			[['search'], 'required'],
		];
	}

	public function attributeLabels()
	{
		return [
			'search' => 'Search Text'
		];
	}

	/**
	 * Reaches out to our ol' friend Jung and searches for dreams.
	 *
	 * @return Dream[]
	 */
	public function getDreams(): array
	{
		$result = NULL;

		$dreamAnalysis = new DreamAnalysisApi('127.0.0.1', 1995);
		$dreamSearchRequest = new DreamSearchRequest();
		$dreamSearchRequest->user_id = $this->user_id;
		$dreamSearchRequest->search_text = $this->search;
		$dreamSearchResponse = $dreamAnalysis->search($dreamSearchRequest);

		if(!$dreamSearchResponse->isSuccess())
		{
			throw new BadRequestHttpException('Error: code=' . $dreamSearchResponse->code . ', error=' . $dreamSearchResponse->error . '.');
		}
		else
		{
			$dreams = [];
			if(count($dreamSearchResponse->results))
			{
				foreach($dreamSearchResponse->results as $result)
				{
					$dreamId = $result->dreamId;
					$parts = explode(" ", $dreamId);
					$id = $parts[0];

					$dreamModel = new Dream();
					$dreamModel->setId($id);
					$dream = Dream::find()->where('id = :id', [
						':id' => $dreamModel->id
					])->one();
					if($dream)
					{
						$dreams[] = $dream;
					}
				}
			}
			return $dreams;
		}
	}
}