<?php

namespace backend\models\elementoacta;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\elementoacta\ElementoActa;

/**
 * ElementoActaSearch represents the model behind the search form of `backend\models\elementoacta\ElementoActa`.
 */
class ElementoActaSearch extends ElementoActa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idelemento_acta'], 'integer'],
            [['elemento'], 'safe'],
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
        $query = ElementoActa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idelemento_acta' => $this->idelemento_acta,
        ]);

        $query->andFilterWhere(['like', 'elemento', $this->elemento]);

        return $dataProvider;
    }
}
