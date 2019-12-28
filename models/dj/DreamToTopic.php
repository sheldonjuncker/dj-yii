<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_to_dream_topic".
 *
 * @property string $dream_id
 * @property string $topic_id
 *
 * @property Dream $dream
 * @property DreamTopic $topic
 */
class DreamToTopic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_to_dream_topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dream_id', 'topic_id'], 'required'],
            [['dream_id', 'topic_id'], 'string', 'max' => 16],
            [['dream_id', 'topic_id'], 'unique', 'targetAttribute' => ['dream_id', 'topic_id']],
            [['dream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dream::className(), 'targetAttribute' => ['dream_id' => 'id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => DreamTopic::className(), 'targetAttribute' => ['topic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dream_id' => 'Dream ID',
            'topic_id' => 'Topic ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDream()
    {
        return $this->hasOne(Dream::className(), ['id' => 'dream_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(DreamTopic::className(), ['id' => 'topic_id']);
    }

    /**
     * {@inheritdoc}
     * @return DreamToTopicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamToTopicQuery(get_called_class());
    }
}
