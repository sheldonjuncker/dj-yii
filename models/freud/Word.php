<?php

namespace app\models\freud;

use Yii;

/**
 * This is the model class for table "freud.word".
 *
 * @property int $id
 * @property string|null $word Long enough for all normal real words.
 * @property string|null $search Stemmatized version of word for searching
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'freud.word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word', 'search'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'search' => 'Search',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordQuery(get_called_class());
    }
}
