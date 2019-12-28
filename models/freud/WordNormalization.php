<?php

namespace app\models\freud;

use Yii;

/**
 * This is the model class for table "freud.word_normalization".
 *
 * @property string|null $matched_word Word literal or regular expression to match.
 * @property int $is_regexp
 * @property int|null $word_id Word to substitute. Null means the word is to be ignored.
 */
class WordNormalization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freud.word_normalization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_regexp', 'word_id'], 'integer'],
            [['matched_word'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matched_word' => 'Matched Word',
            'is_regexp' => 'Is Regexp',
            'word_id' => 'Word ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WordNormalizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordNormalizationQuery(get_called_class());
    }
}
