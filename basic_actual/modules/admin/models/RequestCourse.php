<?php

namespace app\modules\admin\models;

use Yii;
use app\models\Course;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request_course".
 *
 * @property string $id
 * @property string $request_course_id
 * @property string $request_date
 * @property string $user_fio
 * @property string $user_email
 * @property string $user_phone
 * @property string $user_company
 * @property string $user_rank
 * @property integer $request_status
 * @property string $addtext
 *
 * @property Course $course
 *
 */
class RequestCourse extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_FINISH = 1;

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
        return 'request_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_course_id', 'user_fio', 'user_email', 'user_phone'], 'required'],
            [['request_course_id', 'request_status'], 'integer'],
            [['user_fio'], 'string', 'max' => 255],
            [['user_email'], 'email'],
            [['user_email'], 'string', 'max' => 64],
            [['user_phone'], 'string', 'max' => 30],
            [['user_company'], 'string', 'max' => 100],
            [['user_rank'], 'string', 'max' => 45],
            [['addtext'], 'string'],
            [['user_fio', 'user_email', 'user_company', 'user_rank', 'addtext'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_course_id' => 'Идентификатор курса',
            'request_date' => 'Дата подачи заявки',
            'user_fio' => 'Имя отправителя',
            'user_email' => 'Email отправителя',
            'user_phone' => 'Телефон отправителя',
            'user_company' => 'Организация',
            'user_rank' => 'Должность',
            'request_status' => 'Статус',
            'course' => 'Наименование курса',
            'addtext' => 'Дополнительные сведения'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'request_course_id']);
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
