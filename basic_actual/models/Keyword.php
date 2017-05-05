<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "keyword".
 *
 * @property string $id
 * @property string $keyword_name
 *
 * @property Publication[] $publications
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword_name'], 'required'],
            [['keyword_name'], 'string', 'max' => 45],
            [['keyword_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword_name' => 'Ключевое слово',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['id' => 'public_id'])
            ->viaTable('publication_keyword', ['keyword_id' => 'id']);
    }

    public static function getKeywords()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'keyword_name', 'keyword_name');
    }

}
