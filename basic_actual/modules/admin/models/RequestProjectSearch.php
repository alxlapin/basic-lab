<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\RequestProject;

/**
 * RequestProjectSearch represents the model behind the search form about `app\modules\admin\models\RequestProject`.
 */
class RequestProjectSearch extends RequestProject
{
    public $project;
    public $date_from;
    public $date_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'request_status'], 'integer'],
            [['user_email', 'project'], 'safe'],
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
        $query = RequestProject::find();

        $query->joinWith(['project']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['request_date' => SORT_DESC]]
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

        if (!$this->date_to) {
            $this->date_to = (new \DateTime())->format('Y-m-d');
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'request_status' => $this->request_status,
        ]);

        $query->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'project.project_title', $this->project])
            ->andFilterWhere(['>=', 'request_date', $this->date_from ? $this->date_from . ' 00:00:00' : null])
            ->andFilterWhere(['<=', 'request_date', $this->date_to ? $this->date_to . ' 23:59:59' : null]);

        return $dataProvider;
    }
}
