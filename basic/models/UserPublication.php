<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_publication".
 *
 * @property string $upub_id
 * @property string $user_id
 * @property string $public_id
 *
 * @property Publication $public
 * @property User $user
 */
class UserPublication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_publication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'public_id'], 'required'],
            [['user_id', 'public_id'], 'integer'],
            [['user_id', 'public_id'], 'unique', 'targetAttribute' => ['user_id', 'public_id'], 'message' => 'The combination of User ID and Public ID has already been taken.'],
            [['public_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['public_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upub_id' => 'Upub ID',
            'user_id' => 'User ID',
            'public_id' => 'Public ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublic()
    {
        return $this->hasOne(Publication::className(), ['id' => 'public_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
