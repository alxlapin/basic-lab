<?php

namespace app\modules\admin\models;

use app\models\UserProject;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectSearch extends Project
{
    public $date_from;
    public $date_to;
    public $authors;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_status'], 'integer'],
            [['project_title', 'authors'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'Y-m-d']
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
        if (!$this->date_to) {
            $this->date_to = (new \DateTime())->format('Y-m-d');
        }

        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->authors) {
            $subQuery = UserProject::find()
                ->select('project_id')
                ->distinct()
                ->innerJoin('user', '`user_project`.`user_id` = `user`.`id`')
                ->andFilterWhere(['or',
                    ['like', 'user.user_name', $this->authors],
                    ['like', 'user.user_surname', $this->authors],
                    ['like', 'user.user_patronymic', $this->authors]]);
            $query->andFilterWhere(['in', '`project`.`id`', $subQuery]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'project_status' => $this->project_status,
        ]);

        $query->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}
