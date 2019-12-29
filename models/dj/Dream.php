<?php

namespace app\models\dj;

use Rhumsaa\Uuid\Uuid;
use Yii;

/**
 * This is the model class for table "dj.dream".
 *
 * @property string $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $dreamt_at
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Dream extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'title', 'dreamt_at'], 'required'],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['dreamt_at', 'created_at', 'updated_at'], 'safe'],
            [['id'], 'app\models\validators\UuidValidator', 'allowEmpty' => false, 'generateOnEmpty' => true],
            [['title'], 'string', 'max' => 256],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'dreamt_at' => 'Dreamt At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DreamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamQuery(get_called_class());
    }

	/**
	 * Gets the UUID formatted as a string.
	 *
	 * @return string
	 */
    public function getId(): ?string
	{
		if(!$this->id)
		{
			return NULL;
		}
		else
		{
			return Uuid::fromBytes($this->id)->toString();
		}
	}

	/**
	 * Sets the formatted UUID.
	 *
	 * @param null|string $id
	 */
	public function setId(?string $id)
	{
		if(!$id)
		{
			$this->id = $id;
		}
		else
		{
			$this->id = Uuid::fromString($id)->getBytes();
		}
	}

	public function getTitle(): string
	{
		return $this->title;
	}

    public function getFormattedDate(): string
	{
		return Yii::$app->getFormatter()->asDate($this->dreamt_at);
	}
}
