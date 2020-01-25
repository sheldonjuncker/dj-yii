<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[Word]].
 *
 * @see Word
 */
class WordQuery extends \yii\db\ActiveQuery
{
	public function wordLike(string $search): self
	{
		return $this->andWhere("word LIKE :search", [
			':search' => '%' . $search . '%'
		]);
	}

	public function word(string $word): self
	{
		return $this->andWhere(['word' => $word]);
	}

    /**
     * {@inheritdoc}
     * @return Word[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Word|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
