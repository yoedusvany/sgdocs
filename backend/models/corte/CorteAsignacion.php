<?php

namespace backend\models\corte;

use Yii;
use backend\models\acta\Acta;
use backend\models\asignacion\Asignacion;

/**
 * This is the model class for table "corte_asignacion".
 *
 * @property int $idcorte_asignacion
 * @property string $nota
 * @property string $observaciones
 * @property string $no_orden
 * @property int $acta_id
 * @property int $asignacion_id
 *
 * @property Acta $acta
 * @property Asignacion $asignacion
 */
class CorteAsignacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corte_asignacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['observaciones'], 'string'],
            [['no_orden', 'acta_id', 'asignacion_id'], 'required'],
            [['acta_id', 'asignacion_id','no_orden'], 'integer'],
            [['nota'], 'string', 'max' => 45],
            [['acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acta::className(), 'targetAttribute' => ['acta_id' => 'idacta']],
            [['asignacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignacion::className(), 'targetAttribute' => ['asignacion_id' => 'idasignacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcorte_asignacion' => 'Idcorte Asignacion',
            'nota' => 'Nota',
            'observaciones' => 'Observaciones',
            'no_orden' => 'No. de corte',
            'acta_id' => 'Acta',
            'asignacion_id' => 'Asignacion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActa()
    {
        return $this->hasOne(Acta::className(), ['idacta' => 'acta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacion()
    {
        return $this->hasOne(Asignacion::className(), ['idasignacion' => 'asignacion_id']);
    }

    /**
     * @inheritdoc
     * @return CorteAsignacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CorteAsignacionQuery(get_called_class());
    }
}
