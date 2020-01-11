<?php

namespace app\models\freud;

use app\models\dj\Dream;
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

	/**
	 * Gets all of the dreams with this concept.
	 * Dreams are ordered by relevance.
	 *
	 * @return Dream[]
	 */
	public function getDreams(): array
	{
		$sql = "
			select
				z.*
			from
			(
				select
					dream.*,
					SUM(dwf.frequency) as 'freq'
				from
					dj.dream
				inner join
					freud.dream_word_freq dwf on dwf.dream_id = dream.id
				inner join
					freud.word_to_concept d2c on(
						d2c.concept_id = :concept_id
						and d2c.word_id = dwf.word_id
					)
				group by
					dream.id
			) z
			order by
				z.freq DESC
			;
		";

		return Dream::findBySql($sql, [':concept_id' => $this->id])->all();
	}
}
