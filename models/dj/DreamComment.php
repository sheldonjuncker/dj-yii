<?php

namespace app\models\dj;

use Rhumsaa\Uuid\Uuid;
use Yii;

/**
 * This is the model class for table "dj.dream_comment".
 *
 * @property string $id
 * @property string $dream_id
 * @property int $user_id
 * @property string $created_at
 * @property string|null $description
 *
 * @property Dream $dream
 * @property User $user
 */
class DreamComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dj.dream_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dream_id', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string'],
			[['id'], 'unique'],
			[['id'], 'app\models\validators\UuidValidator', 'allowEmpty' => false, 'generateOnEmpty' => true],
            [['dream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dream::class, 'targetAttribute' => ['dream_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dream_id' => 'Dream',
            'user_id' => 'User',
            'created_at' => 'Created At',
            'description' => 'Description',
        ];
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

	/**
	 * Gets the UUID formatted as a string.
	 *
	 * @return string
	 */
	public function getDreamId(): ?string
	{
		if(!$this->dream_id)
		{
			return NULL;
		}
		else
		{
			return Uuid::fromBytes($this->dream_id)->toString();
		}
	}

	/**
	 * Sets the formatted UUID.
	 *
	 * @param null|string $id
	 */
	public function setDreamId(?string $id)
	{
		if(!$id)
		{
			$this->dream_id = $id;
		}
		else
		{
			$this->dream_id = Uuid::fromString($id)->getBytes();
		}
	}

	/**
	 * Gets the user ID.
	 *
	 * @return int
	 */
	public function getUserId(): ?int
	{
		return $this->user_id;
	}

	/**
	 * Sets the user ID.
	 *
	 * @param null|string $id
	 */
	public function setUserId(?string $id)
	{
		$this->user_id = $id;
	}

	/**
	 * @return null|string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	public function getFormattedDate(): string
	{
		return Yii::$app->getFormatter()->asDate($this->created_at);
	}

	/**
	 * Dream comment relationship.
	 *
	 * @return DreamQuery
	 */
	public function getDream(): DreamQuery
	{
		return $this->hasOne(Dream::class, ['id' => 'dream_id']);
	}

	/**
	 * Dream user relationship.
	 *
	 * @return UserQuery
	 */
	public function getUser(): UserQuery
	{
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}

    /**
     * {@inheritdoc}
     * @return DreamCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DreamCommentQuery(get_called_class());
    }
}
