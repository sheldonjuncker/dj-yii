<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[WordNormalization]].
 *
 * @see WordNormalization
 */
class WordNormalizationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WordNormalization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WordNormalization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
