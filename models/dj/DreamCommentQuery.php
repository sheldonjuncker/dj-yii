<?php

namespace app\models\dj;

use Rhumsaa\Uuid\Uuid;

/**
 * This is the ActiveQuery class for [[DreamComment]].
 *
 * @see DreamComment
 */
class DreamCommentQuery extends \yii\db\ActiveQuery
{
	/**
	 * Filters by ID.
	 *
	 * @param string $id The UUID in string or binary form.
	 */
	public function id(string $id)
	{
		if(Uuid::isValid($id))
		{
			$id = Uuid::fromString($id)->getBytes();
		}
		return $this->andWhere(['id' => $id]);
	}

    /**
     * {@inheritdoc}
     * @return DreamComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
