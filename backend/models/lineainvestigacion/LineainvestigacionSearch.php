<?php

namespace backend\models\lineainvestigacion;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\lineainvestigacion\Lineainvestigacion;

/**
 * LineainvestigacionSearch represents the model behind the search form of `backend\models\lineainvestigacion\Lineainvestigacion`.
 */
class LineainvestigacionSearch extends Lineainvestigacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlinea_investigacion'], 'integer'],
            [['nombre_linea_inv', 'desc'], 'safe'],
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
        $query = Lineainvestigacion::find();

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
            'idlinea_investigacion' => $this->idlinea_investigacion,
        ]);

        $query->andFilterWhere(['like', 'nombre_linea_inv', $this->nombre_linea_inv])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
