<?php

namespace backend\models\departamento;

use Yii;
use backend\models\area\Area;
use common\models\trabajador\Trabajador;

/**
 * This is the model class for table "departamento".
 *
 * @property int $iddepartamento
 * @property string $nombre
 * @property int $area_id
 *
 * @property Area $area
 * @property Trabajador[] $trabajadors
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id'], 'required'],
            [['area_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'idarea']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddepartamento' => 'Iddepartamento',
            'nombre' => 'Nombre',
            'area_id' => 'Area',
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
    public function getTrabajadors()
    {
        return $this->hasMany(Trabajador::className(), ['departamento_id' => 'iddepartamento']);
    }

    /**
     * @inheritdoc
     * @return DepartamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartamentoQuery(get_called_class());
    }
}
