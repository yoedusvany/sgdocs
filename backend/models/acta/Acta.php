<?php

namespace backend\models\acta;

use backend\models\adjunto\Adjunto;
use Yii;
use backend\models\area\Area;
use backend\models\tipoacta\TipoActa;
use backend\models\corte\CorteAsignacion;

/**
 * This is the model class for table "acta".
 *
 * @property int $idacta
 * @property string $fecha
 * @property string $nombre
 * @property string $modo
 * @property int $tipo_acta_id
 * @property int $area_id
 *
 * @property Area $area
 * @property TipoActa $tipoActa
 * @property CorteAsignacion[] $corteAsignacions
 * @property Adjunto[] $adjuntos
 */
class Acta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['tipo_acta_id', 'area_id'], 'required'],
            [['tipo_acta_id', 'area_id'], 'integer'],
            [['nombre','modo'], 'string', 'max' => 255],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'idarea']],
            [['tipo_acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoActa::className(), 'targetAttribute' => ['tipo_acta_id' => 'idtipo_acta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacta' => 'Idacta',
            'fecha' => 'Fecha',
            'nombre' => 'Nombre',
            'modo' => 'Modo',
            'tipo_acta_id' => 'Tipo de Acta',
            'area_id' => 'Area'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['idarea' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoActa()
    {
        return $this->hasOne(TipoActa::className(), ['idtipo_acta' => 'tipo_acta_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorteAsignacions()
    {
        return $this->hasMany(CorteAsignacion::className(), ['acta_id' => 'idacta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdjuntos()
    {
        return $this->hasMany(Adjunto::className(), ['acta_id' => 'idacta']);
    }

    /**
     * @inheritdoc
     * @return ActaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActaQuery(get_called_class());
    }
}
