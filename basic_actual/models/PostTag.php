<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_tag".
 *
 * @property string $pt_id
 * @property string $post_id
 * @property string $tag_id
 *
 * @property Post $post
 * @property Tag $tag
 */
class PostTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
            [['post_id', 'tag_id'], 'unique', 'targetAttribute' => ['post_id', 'tag_id'], 'message' => 'The combination of Post ID and Tag ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pt_id' => 'Pt ID',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public static function getTagsCount() {
        return self::find()->select('tag_id, count(*) as cnt')
            ->groupBy(['tag_id'])
            ->orderBy('cnt DESC')
            ->asArray()
            ->all();
    }
}
