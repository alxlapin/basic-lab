<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication_keyword".
 *
 * @property string $pk_id
 * @property string $public_id
 * @property string $keyword_id
 *
 * @property Keyword $keyword
 * @property Publication $public
 */
class PublicationKeyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication_keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public_id', 'keyword_id'], 'required'],
            [['public_id', 'keyword_id'], 'integer'],
            [['public_id', 'keyword_id'], 'unique', 'targetAttribute' => ['public_id', 'keyword_id'], 'message' => 'The combination of Public ID and Keyword ID has already been taken.'],
//            [['keyword_id'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['keyword_id' => 'id']],
//            [['public_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['public_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'public_id' => 'Public ID',
            'keyword_id' => 'Keyword ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyword()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'keyword_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublic()
    {
        return $this->hasOne(Publication::className(), ['id' => 'public_id']);
    }
}
