<?php

namespace app\models\dj;

/**
 * This is the ActiveQuery class for [[DreamToCategory]].
 *
 * @see DreamToCategory
 */
class DreamToCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DreamToCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamToCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
