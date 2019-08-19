<?php

namespace backend\models\tipoactaelemento;

use backend\models\actaelemento\ActaElemento;
use Yii;
use backend\models\elementoacta\ElementoActa;
use backend\models\tipoacta\TipoActa;

/**
 * This is the model class for table "tipo_acta_elemento".
 *
 * @property int $id
 * @property int $tipo_acta_id
 * @property int $elemento_acta_id
 * @property int $orden
 *
 * @property ElementoActa $elementoActa
 * @property TipoActa $tipoActa
 */
class TipoActaElemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_acta_elemento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_acta_id', 'elemento_acta_id'], 'required'],
            [['tipo_acta_id', 'elemento_acta_id', 'orden'], 'integer'],
            [['tipo_acta_id', 'elemento_acta_id'], 'unique', 'targetAttribute' => ['tipo_acta_id', 'elemento_acta_id']],
            [['elemento_acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => ElementoActa::className(), 'targetAttribute' => ['elemento_acta_id' => 'idelemento_acta']],
            [['tipo_acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoActa::className(), 'targetAttribute' => ['tipo_acta_id' => 'idtipo_acta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_acta_id' => 'Tipo Acta ID',
            'elemento_acta_id' => 'Elemento Acta ID',
            'orden' => 'Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementoActa()
    {
        return $this->hasOne(ElementoActa::className(), ['idelemento_acta' => 'elemento_acta_id']);
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
    public function getActaElemento()
    {
        return $this->hasMany(ActaElemento::className(), ['tipo_acta_elemento_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TipoActaElementoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoActaElementoQuery(get_called_class());
    }
}
