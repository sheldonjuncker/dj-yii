<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_comment".
 *
 * @property string $id
 * @property string $dream_id
 * @property int $user_id
 * @property string $created_at
 * @property string|null $description
 */
class DreamComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dream_id', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string'],
            [['id', 'dream_id'], 'string', 'max' => 16],
            [['id'], 'unique'],
            [['dream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dream::className(), 'targetAttribute' => ['dream_id' => 'id']],
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
            'dream_id' => 'Dream ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'description' => 'Description',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DreamCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamCommentQuery(get_called_class());
    }
}
