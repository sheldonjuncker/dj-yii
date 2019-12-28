<?php

namespace app\models\dj;

/**
 * This is the ActiveQuery class for [[DreamToType]].
 *
 * @see DreamToType
 */
class DreamToTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DreamToType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamToType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
