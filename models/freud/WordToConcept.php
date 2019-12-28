<?php

namespace app\models\freud;

use Yii;

/**
 * This is the model class for table "freud.word_to_concept".
 *
 * @property int $word_id
 * @property int $concept_id
 * @property float|null $certainty
 */
class WordToConcept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freud.word_to_concept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word_id', 'concept_id'], 'required'],
            [['word_id', 'concept_id'], 'integer'],
            [['certainty'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'word_id' => 'Word ID',
            'concept_id' => 'Concept ID',
            'certainty' => 'Certainty',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WordToConceptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordToConceptQuery(get_called_class());
    }
}
