<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_interest".
 *
 * @property string $ui_id
 * @property string $user_id
 * @property string $interest_id
 *
 * @property Interest $interest
 * @property User $user
 */
class UserInterest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'interest_id'], 'required'],
            [['user_id', 'interest_id'], 'integer'],
            [['user_id', 'interest_id'], 'unique', 'targetAttribute' => ['user_id', 'interest_id'], 'message' => 'The combination of User ID and Interest ID has already been taken.'],
            [['interest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interest::className(), 'targetAttribute' => ['interest_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ui_id' => 'Ui ID',
            'user_id' => 'User ID',
            'interest_id' => 'Interest ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterest()
    {
        return $this->hasOne(Interest::className(), ['id' => 'interest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
