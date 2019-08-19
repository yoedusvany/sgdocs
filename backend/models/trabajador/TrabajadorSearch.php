<?php

namespace backend\models\trabajador;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\trabajador\Trabajador;

/**
 * TrabajadorSearch represents the model behind the search form of `backend\models\trabajador\Trabajador`.
 */
class TrabajadorSearch extends Trabajador
{
    public $username;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtrabajador'], 'integer'],
            [['nombre', 'apellidos', 'categoria_docente', 'categoria_cientifica','departamento_id', 'username','email'], 'safe'],
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
        $query = Trabajador::find();

        // add conditions that should always apply here

        $query->joinWith(['users','departamento']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['username'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idtrabajador' => $this->idtrabajador,
            'categoria_docente'=> $this->categoria_docente,
            'categoria_cientifica' =>$this->categoria_cientifica,
            'departamento_id' => $this->departamento_id
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'user.email', $this->email]);

        return $dataProvider;
    }
}
