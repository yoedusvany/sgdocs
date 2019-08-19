<?php

namespace backend\models\tipoacta;

use Yii;
use backend\models\acta\Acta;
use backend\models\elementoacta\ElementoActa;
use backend\models\tipoactaelemento\TipoActaElemento;

/**
 * This is the model class for table "tipo_acta".
 *
 * @property int $idtipo_acta
 * @property string $tipo
 *
 * @property Acta[] $actas
 * @property TipoActaElemento[] $tipoActaElementos
 * @property ElementoActa[] $elementoActas
 */
class TipoActa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_acta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo_acta' => 'Idtipo Acta',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActas()
    {
        return $this->hasMany(Acta::className(), ['tipo_acta_id' => 'idtipo_acta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoActaElementos()
    {
        return $this->hasMany(TipoActaElemento::className(), ['tipo_acta_id' => 'idtipo_acta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementoActas()
    {
        return $this->hasMany(ElementoActa::className(), ['idelemento_acta' => 'elemento_acta_id'])->viaTable('tipo_acta_elemento', ['tipo_acta_id' => 'idtipo_acta']);
    }

    /**
     * @inheritdoc
     * @return TipoActaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoActaQuery(get_called_class());
    }
}
