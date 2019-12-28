<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_topic".
 *
 * @property string $id
 * @property string $name
 * @property int $user_id
 *
 * @property User $user
 */
class DreamTopic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['id'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255],
            [['name', 'user_id'], 'unique', 'targetAttribute' => ['name', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return DreamTopicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamTopicQuery(get_called_class());
    }
}
