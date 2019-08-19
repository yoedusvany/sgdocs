<?php

namespace backend\models\tema;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\tema\Tema;

/**
 * TemaSearch represents the model behind the search form of `backend\models\tema\Tema`.
 */
class TemaSearch extends Tema
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtema'], 'integer'],
            [['nombre', 'desc', 'estado', 'create_at', 'linea_investigacion_id', 'area_id'], 'safe'],
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
            $query = Tema::find();
        }else{
            $query = Tema::find()->where('area_id='.Yii::$app->user->identity->getDpto()->getAttribute('area_id'));
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

        $query->joinWith("area");
        $query->joinWith("lineaInvestigacion");

        // grid filtering conditions
        $query->andFilterWhere([
            'idtema' => $this->idtema,
            'linea_investigacion_id' => $this->linea_investigacion_id,
            'estado' => $this->estado,
            'area_id' =>$this->area_id
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'tema.create_at', $this->create_at]);

        return $dataProvider;
    }
}
