<?php

namespace app\modules\admin\models;

use app\models\UserPublication;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publication;


/**
 * PublicationSearch represents the model behind the search form about `app\models\Publication`.
 */
class PublicationSearch extends Publication
{
    public $project;
    public $date_from;
    public $date_to;
    public $authors;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'public_type'], 'integer'],
            [['public_date', 'public_title', 'public_annotation', 'public_info', 'public_lang', 'public_file', 'project'], 'safe'],
            [['date_from', 'date_to', 'authors'], 'safe'],
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
        $query = Publication::find();

        $query->joinWith(['project']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort'=> ['defaultOrder' => ['public_date' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['project'] = [
            'asc' => ['project.project_title' => SORT_ASC],
            'desc' => ['project.project_title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->authors) {
            $subQuery = UserPublication::find()
                ->select('public_id')
                ->distinct()
                ->innerJoin('user', '`user_publication`.`user_id` = `user`.`id`')
                ->andFilterWhere(['or',
                    ['like', 'user.user_name', $this->authors],
                    ['like', 'user.user_surname', $this->authors],
                    ['like', 'user.user_patronymic', $this->authors]]);
            $query->andFilterWhere(['in', '`publication`.`id`', $subQuery]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'public_type' => $this->public_type,
        ]);

//        if (!is_null($this->public_date) && strpos($this->public_date, ' - ') !== false) {
//            list($start_date, $end_date) = explode(' - ', $this->public_date);
//            $query->andFilterWhere(['between', 'public_date', $start_date, $end_date]);
//        }

        $query->andFilterWhere(['like', 'public_title', $this->public_title])
            ->andFilterWhere(['like', 'project.project_title', $this->project])
            ->andFilterWhere(['>=', 'public_date', $this->date_from ? $this->date_from . '-01' : null])
            ->andFilterWhere(['<=', 'public_date', $this->date_to ? $this->date_to . '-01' : null]);

        return $dataProvider;
    }
}
