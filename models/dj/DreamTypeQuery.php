<?php

namespace app\models\dj;

/**
 * This is the ActiveQuery class for [[DreamType]].
 *
 * @see DreamType
 */
class DreamTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DreamType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
