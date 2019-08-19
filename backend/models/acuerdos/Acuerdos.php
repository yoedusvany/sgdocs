<?php

namespace backend\models\acuerdos;

use Yii;
use backend\models\acta\Acta;

/**
 * This is the model class for table "acuerdos".
 *
 * @property int $idacuerdos
 * @property string $acuerdo
 * @property string $no_acuerdo
 * @property int $acta_id
 *
 * @property Acta $acta
 */
class Acuerdos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acuerdos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acta_id'], 'required'],
            [['acta_id'], 'integer'],
            [['acuerdo', 'no_acuerdo'], 'string', 'max' => 45],
            [['acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acta::className(), 'targetAttribute' => ['acta_id' => 'idacta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacuerdos' => 'Idacuerdos',
            'acuerdo' => 'Acuerdo',
            'no_acuerdo' => 'No Acuerdo',
            'acta_id' => 'Acta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActa()
    {
        return $this->hasOne(Acta::className(), ['idacta' => 'acta_id']);
    }

    /**
     * @inheritdoc
     * @return AcuerdosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcuerdosQuery(get_called_class());
    }
}
