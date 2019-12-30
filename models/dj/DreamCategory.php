<?php

namespace app\models\dj;

use Yii;

/**
 * This is the model class for table "dj.dream_category".
 *
 * @property int $id
 * @property string|null $name
 */
class DreamCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

	/**
	 * @return null|string
	 */
	public function getName()
	{
		return $this->name;
	}

    /**
     * {@inheritdoc}
     * @return DreamCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamCategoryQuery(get_called_class());
    }
}
