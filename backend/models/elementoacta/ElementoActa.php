<?php

namespace backend\models\elementoacta;

use Yii;
use backend\models\tipoacta\TipoActa;
use backend\models\tipoactaelemento\TipoActaElemento;

/**
 * This is the model class for table "elemento_acta".
 *
 * @property int $idelemento_acta
 * @property string $elemento
 *
 * @property TipoActaElemento[] $tipoActaElementos
 * @property TipoActa[] $tipoActas
 */
class ElementoActa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elemento_acta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elemento'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idelemento_acta' => 'Idelemento Acta',
            'elemento' => 'Elemento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoActaElementos()
    {
        return $this->hasMany(TipoActaElemento::className(), ['elemento_acta_id' => 'idelemento_acta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoActas()
    {
        return $this->hasMany(TipoActa::className(), ['idtipo_acta' => 'tipo_acta_id'])->viaTable('tipo_acta_elemento', ['elemento_acta_id' => 'idelemento_acta']);
    }

    /**
     * @inheritdoc
     * @return ElementoActaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ElementoActaQuery(get_called_class());
    }
}
