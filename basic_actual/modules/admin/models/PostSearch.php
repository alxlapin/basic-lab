<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{

    public $date_from;
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_type'], 'integer'],
            [['post_title'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['post_date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!$this->date_to) {
            $this->date_to = (new \DateTime())->format('Y-m-d');
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'post_type' => $this->post_type,
        ]);

        $query->andFilterWhere(['like', 'post_title', $this->post_title])
            ->andFilterWhere(['like', 'post_desc', $this->post_desc])
            ->andFilterWhere(['>=', 'post_date', $this->date_from ? $this->date_from . ' 00:00:00' : null])
            ->andFilterWhere(['<=', 'post_date', $this->date_to ? $this->date_to . ' 23:59:59' : null]);

        return $dataProvider;
    }
}
