<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProjectEditSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectEditSearch extends Project
{
    public $authors;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_status'], 'integer'],
            [['project_title', 'authors'], 'safe'],
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
        $subQuery = UserProject::find()
            ->select('project_id')
            ->where(['user_id' => Yii::$app->user->identity->id]);

        $query = Project::find()->where(['id' => $subQuery]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
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

        $query->andFilterWhere(['like', 'project_title', $this->project_title]);

        return $dataProvider;
    }
}
