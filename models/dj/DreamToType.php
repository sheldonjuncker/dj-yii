<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_to_dream_type".
 *
 * @property string $dream_id
 * @property int $type_id
 *
 * @property Dream $dream
 * @property DreamType $type
 */
class DreamToType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_to_dream_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dream_id', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['dream_id'], 'string', 'max' => 16],
            [['dream_id', 'type_id'], 'unique', 'targetAttribute' => ['dream_id', 'type_id']],
            [['dream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dream::className(), 'targetAttribute' => ['dream_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DreamType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dream_id' => 'Dream ID',
            'type_id' => 'Type ID',
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
    public function getType()
    {
        return $this->hasOne(DreamType::className(), ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return DreamToTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamToTypeQuery(get_called_class());
    }
}
