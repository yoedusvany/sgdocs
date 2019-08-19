<?php

namespace backend\models\lineainvestigacion;

use Yii;

/**
 * This is the model class for table "linea_investigacion".
 *
 * @property int $idlinea_investigacion
 * @property string $nombre_linea_inv
 * @property string $desc
 *
 * @property Tema[] $temas
 */
class Lineainvestigacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linea_investigacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['nombre_linea_inv'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlinea_investigacion' => 'Idlinea Investigacion',
            'nombre_linea_inv' => 'Línea de Inestigación',
            'desc' => 'Desc.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemas()
    {
        return $this->hasMany(Tema::className(), ['linea_investigacion_id' => 'idlinea_investigacion']);
    }

    /**
     * @inheritdoc
     * @return LineainvestigacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LineainvestigacionQuery(get_called_class());
    }
}
