<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Achievement;

/**
 * AchievementEditSearch represents the model behind the search form about `app\models\Achievement`.
 */
class AchievementEditSearch extends Achievement
{
    public $date_from;
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['achieve_desc'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m']
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
        $query = Achievement::find()->where(['user_id' => Yii::$app->user->identity->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['achieve_date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'achieve_desc', $this->achieve_desc])
            ->andFilterWhere(['>=', 'achieve_date', $this->date_from ? $this->date_from . '-01' : null])
            ->andFilterWhere(['<=', 'achieve_date', $this->date_to ? $this->date_to . '-01' : null]);;

        return $dataProvider;
    }
}
