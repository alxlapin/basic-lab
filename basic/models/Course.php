<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "course".
 *
 * @property string $id
 * @property string $course_title
 * @property string $course_announce
 * @property string $course_desc
 * @property integer $course_status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RequestCourse[] $requestCourses
 */
class Course extends \yii\db\ActiveRecord
{
    const STATUS_OPEN_REG = 0;
    const STATUS_CLOSE_REG = 1;
    const STATUS_CLOSE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_title', 'course_announce', 'course_desc'], 'required'],
            [['course_announce', 'course_desc'], 'string'],
            [['course_status'], 'integer'],
            [['course_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_title' => 'Наименование курса',
            'course_announce' => 'Анонс курса',
            'course_desc' => 'Описание курса',
            'course_status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestCourses()
    {
        return $this->hasMany(RequestCourse::className(), ['request_course_id' => 'id']);
    }

    public function getStatusName() {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->course_status);
    }

    public static function getStatusesArray() {
        return [
            self::STATUS_OPEN_REG => 'Рег. открыта',
            self::STATUS_CLOSE_REG => 'Рег. закрыта',
            self::STATUS_CLOSE => 'Неактивен',
        ];
    }
}
