<?php

namespace app\models\search;

use app\models\dj\Dream;
use Socket\Raw\Factory;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

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
		$dreamIds = [];
		$result = NULL;

		$factory = new Factory();

		try
		{
			try
			{
				$student = $factory->createClient('127.0.0.1:1995');
			}
			catch(\Exception $e)
			{
				throw new NotFoundHttpException('Failed to connect to Jung.');
			}

			$data = [
				'search_text' => $this->search,
				'user_id' => $this->user_id,
				'api' => 'search'
			];
			$data['api'] = 'add_word';
			$data['word'] = 'Evangelion';
			$jsonData = json_encode($data, JSON_PRETTY_PRINT);
			if(!$student->write($jsonData))
			{
				throw new BadRequestHttpException('Failed to send message to Jung.');
			}

			$response = $student->read(8192);
			if(!$response)
			{
				throw new BadRequestHttpException('Failed to receive response from Jung.');
			}

			$response = json_decode($response);
			if($response === false)
			{
				throw new BadRequestHttpException('Invalid Jungian JSON data.');
			}

			$responseCode = $response->code ?? 'none';
			$error = $response->error ?? NULL;
			$data = $response->data ?? [];

			if($responseCode !== 200)
			{
				throw new BadRequestHttpException('Error: code=' . $responseCode . ', error=' . $error . '.');
			}
			else
			{
				foreach($data as $dreamData)
				{
					$dreamId = $dreamData[0] ?? NULL;
					if(!$dreamId)
					{
						throw new BadRequestHttpException('Invalid dream id.');
					}
					$dreamIds[] = $dreamId;
				}
			}
		}
		catch(\Exception $e)
		{
			throw $e;
			return [];
		}

		$dreams = [];
		if($result == 0)
		{
			foreach($dreamIds as $dreamId)
			{
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