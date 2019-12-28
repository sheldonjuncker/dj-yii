<?php

namespace app\models\freud;

use Yii;

/**
 * This is the model class for table "freud.dream_word_freq".
 *
 * @property string $dream_id
 * @property int $word_id
 * @property float $frequency
 */
class DreamWordFrequency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freud.dream_word_freq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dream_id', 'word_id', 'frequency'], 'required'],
            [['word_id'], 'integer'],
            [['frequency'], 'number'],
            [['dream_id'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dream_id' => 'Dream ID',
            'word_id' => 'Word ID',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DreamWordFrequencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamWordFrequencyQuery(get_called_class());
    }
}
