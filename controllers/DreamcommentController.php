<?php

namespace app\controllers;

use app\models\dj\Dream;
use app\models\dj\DreamComment;
use Rhumsaa\Uuid\Uuid;
use yii\filters\AccessControl;

class DreamcommentController extends \app\controllers\BaseController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => ['manageDream'],
						'roleParams' => function() {
							$dream = NULL;
							$dreamId = \Yii::$app->getRequest()->get('dreamId');
							if($dreamId)
							{
								$dreamId = Uuid::fromString($dreamId)->getBytes();
								$dream = Dream::findOne(['id' => $dreamId]);
							}
							return ['dream' => $dream];
						}
					]
				]
			]
		];
	}

	public function actionIndex(string $dreamId)
	{
		$dreamComments = $this->getCommentsByDreamId($dreamId);
		$data = [];
		foreach($dreamComments as $dreamComment)
		{
			$data[] = [
				"id" => $dreamComment->getId(),
				"date" => $dreamComment->getFormattedDate(),
				"author" => $dreamComment->user->name,
				"text" => $dreamComment->getDescription()
			];
		}
		return $this->asJson($data);
	}

	/**
	 * Gets all dream comments by dream id.
	 *
	 * @param string $dreamId
	 * @return DreamComment[]
	 */
	protected function getCommentsByDreamId(string $dreamId): array
	{
		$dreamId = Uuid::fromString($dreamId)->getBytes();
		$dream = Dream::find()->where(['id' => $dreamId])->one();
		if($dream)
		{
			return $dream->comments;
		}
		else
		{
			return [];
		}
	}
}
