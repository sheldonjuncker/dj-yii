<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_type".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_default
 */
class DreamType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_default'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],
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
            'is_default' => 'Is Default',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DreamTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamTypeQuery(get_called_class());
    }
}
