<?php

namespace app\models\freud;

/**
 * This is the ActiveQuery class for [[Concept]].
 *
 * @see Concept
 */
class ConceptQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Concept[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Concept|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
