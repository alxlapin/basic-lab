<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "interest".
 *
 * @property string $id
 * @property string $interest_name
 *
 * @property UserInterest[] $userInterests
 * @property User[] $users
 */
class Interest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interest_name'], 'required'],
            [['interest_name'], 'string', 'max' => 45],
            [['interest_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'interest_name' => 'Interest Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterests()
    {
        return $this->hasMany(UserInterest::className(), ['interest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_interest', ['interest_id' => 'id']);
    }

    public static function getInterests()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'interest_name', 'interest_name');
    }
}
