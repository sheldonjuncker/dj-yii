<?php

namespace app\models\dj;

/**
 * This is the ActiveQuery class for [[DreamTopic]].
 *
 * @see DreamTopic
 */
class DreamTopicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DreamTopic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DreamTopic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
