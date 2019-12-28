<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[DreamWordFrequency]].
 *
 * @see DreamWordFrequency
 */
class DreamWordFrequencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DreamWordFrequency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamWordFrequency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
