<?php

namespace backend\models\actaelemento;

use Yii;
use backend\models\tipoactaelemento\TipoActaElemento;
use backend\models\acta\Acta;

/**
 * This is the model class for table "acta_elemento".
 *
 * @property int $acta_idacta
 * @property int $tipo_acta_elemento_id
 * @property string $contenido
 *
 * @property TipoActaElemento $tipoActaElemento
 * @property Acta $actaIdacta
 */
class ActaElemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acta_elemento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acta_idacta', 'tipo_acta_elemento_id'], 'required'],
            [['acta_idacta', 'tipo_acta_elemento_id'], 'integer'],
            [['contenido'], 'string'],
            [['tipo_acta_elemento_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoActaElemento::className(), 'targetAttribute' => ['tipo_acta_elemento_id' => 'id']],
            [['acta_idacta'], 'exist', 'skipOnError' => true, 'targetClass' => Acta::className(), 'targetAttribute' => ['acta_idacta' => 'idacta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acta_idacta' => 'Acta Idacta',
            'tipo_acta_elemento_id' => 'Tipo Acta Elemento ID',
            'contenido' => 'Contenido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoActaElemento()
    {
        return $this->hasOne(TipoActaElemento::className(), ['id' => 'tipo_acta_elemento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaIdacta()
    {
        return $this->hasOne(Acta::className(), ['idacta' => 'acta_idacta']);
    }

    /**
     * @inheritdoc
     * @return ActaElementoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActaElementoQuery(get_called_class());
    }
}
