<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[Word]].
 *
 * @see Word
 */
class WordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
