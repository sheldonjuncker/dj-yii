<?php

namespace app\api\DreamAnalysis;

use app\models\dj\Dream;

class DreamSearchResponse extends Response
{
	/** @var  DreamSearchResult[] $results */
	public $results = [];

	/** @var  int|null $total The total number of results without paging */
	public $total;

	/**
	 * Gets all of the returned dreams as AR models.
	 *
	 * @return Dream[]
	 */
	public function getDreams(): array
	{
		$dreams = [];
		if(count($this->results))
		{
			foreach($this->results as $result)
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