<?php

namespace app\modules\admin\models;

use Yii;
use app\models\Project;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request_project".
 *
 * @property string $id
 * @property string $request_project_id
 * @property string $request_date
 * @property string $user_fio
 * @property string $user_email
 * @property string $user_phone
 * @property string $request_quantity
 * @property integer $request_status
 * @property string $addtext
 *
 * @property Project $project
 */
class RequestProject extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_FINISH = 1;

    public $captcha;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->request_date = (new \Datetime())->format('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_project_id', 'user_fio', 'user_email', 'user_phone'], 'required'],
            [['request_project_id', 'request_quantity', 'request_status'], 'integer'],
            [['request_quantity'], 'required'],
            [['user_fio'], 'string', 'max' => 255],
            [['user_email'], 'email'],
            [['user_email'], 'string', 'max' => 64],
            [['user_phone'], 'string', 'max' => 30],
            [['addtext'], 'string'],
            [['user_fio', 'user_email', 'request_quantity', 'addtext'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_project_id' => 'Request Project ID',
            'request_date' => 'Дата подачи заявки',
            'user_fio' => 'ФИО отправителя',
            'user_email' => 'Email отправителя',
            'user_phone' => 'Телефон',
            'request_quantity' => 'Количество товара',
            'request_status' => 'Статус',
            'project' => 'Название проекта',
            'addtext' => 'Дополнительные сведения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'request_project_id']);
    }

    public function getStatusName() {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->request_status);
    }

    public static function getStatusesArray() {
        return [
            self::STATUS_WAIT => 'Не обработана',
            self::STATUS_FINISH => 'Обработана',
        ];
    }
}
