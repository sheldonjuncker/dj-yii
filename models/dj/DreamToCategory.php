<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_to_dream_category".
 *
 * @property string $dream_id
 * @property int $category_id
 *
 * @property DreamCategory $category
 * @property Dream $dream
 */
class DreamToCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_to_dream_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dream_id', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['dream_id'], 'string', 'max' => 16],
            [['dream_id', 'category_id'], 'unique', 'targetAttribute' => ['dream_id', 'category_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DreamCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['dream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dream::className(), 'targetAttribute' => ['dream_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dream_id' => 'Dream ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(DreamCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDream()
    {
        return $this->hasOne(Dream::className(), ['id' => 'dream_id']);
    }

    /**
     * {@inheritdoc}
     * @return DreamToCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamToCategoryQuery(get_called_class());
    }
}
