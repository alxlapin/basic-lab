<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PublicationEditSearch represents the model behind the search form about `app\models\Publication`.
 */
class PublicationEditSearch extends Publication
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
            [['id', 'public_type'], 'integer'],
            [['authors'], 'string'],
            [['public_title'], 'safe'],
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
        $subQuery = UserPublication::find()
            ->select('public_id')
            ->where(['user_id' => Yii::$app->user->identity->id]);

        $query = Publication::find()->where(['id' => $subQuery]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['public_date' => SORT_DESC]]
        ]);

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

        $query->andFilterWhere(['like', 'public_title', $this->public_title]);

        return $dataProvider;
    }
}
