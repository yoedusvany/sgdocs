<?php

namespace backend\models\acta;

use common\models\trabajador\Trabajador;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\acta\Acta;
use backend\models\area\Area;

/**
 * ActaSearch represents the model behind the search form of `backend\models\acta\Acta`.
 */
class ActaSearch extends Acta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idacta'], 'integer'],
            [['fecha', 'nombre', 'tipo_acta_id', 'area_id'], 'safe'],
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
        if(Yii::$app->user->identity->isUserAdmin()){
            $query = Acta::find();
        }else{
            $query = Acta::find()->where('area_id ='.Yii::$app->user->getIdentity()->getDpto()->getAttribute('area_id'));
        }


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

        $query->joinWith("tipoActa");
        $query->joinWith("area");

        // grid filtering conditions
        $query->andFilterWhere([
            'idacta' => $this->idacta,
            'tipo_acta_id' => $this->tipo_acta_id,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'area', $this->area_id]);

        return $dataProvider;
    }
}
