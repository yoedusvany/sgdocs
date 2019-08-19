<?php

namespace backend\models\asignacion;

use Yii;
use backend\models\tema\Tema;
use backend\models\trabajador\Trabajador;
use backend\models\estudiante\Estudiante;

/**
 * This is the model class for table "asignacion".
 *
 * @property int $idasignacion
 * @property int $tutor_id
 * @property int $tema_id
 * @property string $fecha
 *
 * @property Tema $tema
 * @property Trabajador $tutor
 * @property CorteAsignacion[] $corteAsignacions
 * @property Estudiante $estudiante
 */
class Asignacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asignacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tema_id'], 'required'],
            [['tema_id'], 'integer'],
            [['fecha'], 'safe'],
            [['tema_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tema::className(), 'targetAttribute' => ['tema_id' => 'idtema']],
            [['tutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['tutor_id' => 'idtrabajador']],
            [['estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['estudiante_id' => 'idestudiante']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idasignacion' => 'Idasignacion',
            'tutor_id' => 'Tutor',
            'tema_id' => 'Tema',
            'estudiante_id' => 'Estudiantes',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTema()
    {
        return $this->hasOne(Tema::className(), ['idtema' => 'tema_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutor()
    {
        return $this->hasOne(Trabajador::className(), ['idtrabajador' => 'tutor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorteAsignacions()
    {
        return $this->hasMany(CorteAsignacion::className(), ['asignacion_id' => 'idasignacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante()
    {
        return $this->hasOne(Estudiante::className(), ['idestudiante' => 'estudiante_id']);
    }

    /**
     * @inheritdoc
     * @return AsignacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsignacionQuery(get_called_class());
    }
}
