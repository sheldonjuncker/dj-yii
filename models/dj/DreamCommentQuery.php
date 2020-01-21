<?php

namespace app\models\dj;

/**
 * This is the ActiveQuery class for [[DreamComment]].
 *
 * @see DreamComment
 */
class DreamCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
