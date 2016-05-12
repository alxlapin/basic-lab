<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_storage".
 *
 * @property string $id
 * @property string $post_id
 * @property string $file_name
 * @property string $storage_path
 *
 * @property Post $post
 */
class PostStorage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'file_name', 'storage_path'], 'required'],
            [['post_id'], 'integer'],
            [['file_name', 'storage_path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'file_name' => 'File Name',
            'storage_path' => 'Storage Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
