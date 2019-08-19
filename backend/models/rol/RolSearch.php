<?php

namespace backend\models\rol;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\rol\Rol;

/**
 * RolSearch represents the model behind the search form of `backend\models\rol\Rol`.
 */
class RolSearch extends Rol
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrol'], 'integer'],
            [['rol'], 'safe'],
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
        $query = Rol::find();

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
            'idrol' => $this->idrol,
        ]);

        $query->andFilterWhere(['like', 'rol', $this->rol]);

        return $dataProvider;
    }
}
