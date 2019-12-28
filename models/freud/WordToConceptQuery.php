<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[WordToConcept]].
 *
 * @see WordToConcept
 */
class WordToConceptQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WordToConcept[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WordToConcept|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
