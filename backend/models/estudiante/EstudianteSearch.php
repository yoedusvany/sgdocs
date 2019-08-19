<?php

namespace backend\models\estudiante;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\estudiante\Estudiante;

/**
 * EstudianteSearch represents the model behind the search form of `backend\models\estudiante\Estudiante`.
 */
class EstudianteSearch extends Estudiante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idestudiante'], 'integer'],
            [['nombre', 'apellidos'], 'safe'],
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
        $query = Estudiante::find();

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
            'idestudiante' => $this->idestudiante,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos]);

        return $dataProvider;
    }
}
