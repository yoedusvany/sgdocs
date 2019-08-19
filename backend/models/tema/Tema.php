<?php

namespace backend\models\tema;

use Yii;
use backend\models\lineainvestigacion\Lineainvestigacion;
use backend\models\area\Area;
use backend\models\tema\TemaQuery;

/**
 * This is the model class for table "tema".
 *
 * @property int $idtema
 * @property string $nombre
 * @property string $desc
 * @property string $estado
 * @property string $create_at
 * @property int $linea_investigacion_id
 * @property int $area_id
 *
 * @property Asignacion[] $asignacions
 * @property Area $area
 * @property LineaInvestigacion $lineaInvestigacion
 */
class Tema extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tema';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at'], 'safe'],
            [['linea_investigacion_id', 'area_id', 'nombre', 'desc'], 'required'],
            [['linea_investigacion_id', 'area_id'], 'integer'],
            [['nombre', 'desc', 'estado'], 'string', 'max' => 255],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'idarea']],
            [['linea_investigacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => LineaInvestigacion::className(), 'targetAttribute' => ['linea_investigacion_id' => 'idlinea_investigacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtema' => 'Idtema',
            'nombre' => 'Nombre',
            'desc' => 'Desc.',
            'estado' => 'Estado',
            'create_at' => 'Fecha de creación',
            'linea_investigacion_id' => 'Línea Investigación',
            'area_id' => 'Área',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['tema_id' => 'idtema']);
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
    public function getLineaInvestigacion()
    {
        return $this->hasOne(LineaInvestigacion::className(), ['idlinea_investigacion' => 'linea_investigacion_id']);
    }

    /**
     * @inheritdoc
     * @return \backend\models\trabajador\TemaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TemaQuery(get_called_class());
    }
}
