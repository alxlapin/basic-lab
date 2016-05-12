<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property string $message_date
 * @property string $message_topic
 * @property string $user_name
 * @property string $user_email
 * @property string $user_phone
 * @property string $message_text
 * @property integer $message_status
 */
class Message extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_FINISH = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_date', 'message_topic', 'user_name', 'user_email', 'message_text'], 'required'],
            [['message_text'], 'string'],
            [['message_status'], 'integer'],
            [['message_topic'], 'string', 'max' => 255],
            [['user_name'], 'string', 'max' => 45],
            [['user_email'], 'string', 'max' => 64],
            [['user_phone'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_date' => 'Дата сообщения',
            'message_topic' => 'Тема сообщения',
            'user_name' => 'User Name',
            'user_email' => 'Email отправителя',
            'user_phone' => 'User Phone',
            'message_text' => 'Message Text',
            'message_status' => 'Статус',
        ];
    }

    public function getStatusName() {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->message_status);
    }

    public static function getStatusesArray() {
        return [
            self::STATUS_WAIT => 'Не прочитано',
            self::STATUS_FINISH => 'Прочитано',
        ];
    }
}
