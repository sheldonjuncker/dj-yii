<?php

namespace app\models\freud;

use Yii;

/**
 * This is the model class for table "freud.concept".
 *
 * @property int $id
 * @property string $name
 * @property Word[] $words
 */
class Concept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freud.concept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
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
     * {@inheritdoc}
     * @return ConceptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConceptQuery(get_called_class());
    }

    public function getId()
	{
		return $this->id;
	}

	/**
	 * Dream category relation.
	 *
	 * @return WordQuery
	 */
	public function getWords(): WordQuery
	{
		return $this->hasMany(Word::class, ['id' => 'word_id'])->viaTable('freud.word_to_concept', ['concept_id' => 'id']);
	}
}
