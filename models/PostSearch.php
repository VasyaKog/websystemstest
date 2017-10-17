<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title'], 'safe'],
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
        $query->where(['user_id' => Yii::$app->user->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'created_at',
                    'status'
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if (isset($this->status)) {
            $query->andFilterWhere([
                'status' => $this->status,
            ]);
        }

        if (isset($this->title)) {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }
        return $dataProvider;
    }
}
