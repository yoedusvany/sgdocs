<?php

namespace backend\models\adjunto;

use Yii;
use backend\models\acta\Acta;

/**
 * This is the model class for table "adjunto".
 *
 * @property int $idadjunto
 * @property int $acta_id
 * @property string $filename
 * @property string $filesize
 *
 * @property Acta $acta
 */
class Adjunto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adjunto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acta_id', 'filename', 'filesize'], 'required'],
            [['acta_id'], 'integer'],
            [['filename'], 'file', 'extensions' => 'doc, docx, pdf, odt'],
            [['acta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acta::className(), 'targetAttribute' => ['acta_id' => 'idacta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idadjunto' => 'Idadjunto',
            'acta_id' => 'Acta ID',
            'filename' => 'Acta (fichero)',
            'filesize' => 'Tamaño',
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
     * @return AdjuntoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdjuntoQuery(get_called_class());
    }
}
