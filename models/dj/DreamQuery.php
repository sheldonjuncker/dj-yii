<?php

namespace app\models\dj;

use app\utilities\date\MysqlFormatter;

/**
 * This is the ActiveQuery class for [[Dream]].
 *
 * @see Dream
 */
class DreamQuery extends \yii\db\ActiveQuery
{
	public function dreamtBetween($startDate, $endDate): self
	{
		$startDate = MysqlFormatter::toMysql($startDate);
		$endDate = MysqlFormatter::toMysql($endDate);

		return $this->andWhere('dreamt_at BETWEEN :startDate AND :endDate', [
			':startDate' => $startDate,
			':endDate' => $endDate
		]);
	}

	public function whereUserId(int $id): self
	{
		return $this->andWhere(['user_id' => $id]);
	}

	public function whereUser(User $user)
	{
		return $this->whereUserId($user->getId());
	}

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dream[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dream|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
