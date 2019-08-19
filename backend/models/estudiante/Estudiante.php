<?php

namespace backend\models\estudiante;

use Yii;
use backend\models\asignacion\Asignacion;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $idestudiante
 * @property string $nombre
 * @property string $apellidos
 * @property int $asignacion_id
 *
 * @property Asignacion $asignacion
 */
class Estudiante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estudiante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idestudiante' => 'Idestudiante',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
        ];
    }


    /**
     * @inheritdoc
     * @return EstudianteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstudianteQuery(get_called_class());
    }
}
