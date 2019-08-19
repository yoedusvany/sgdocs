<?php

namespace backend\models\trabajador;

use Yii;
use backend\models\departamento\Departamento;
use common\models\User;

/**
 * This is the model class for table "trabajador".
 *
 * @property int $idtrabajador
 * @property string $nombre
 * @property string $apellidos
 * @property string $categoria_docente
 * @property string $categoria_cientifica
 * @property int $departamento_id
 *
 * @property Asignacion[] $asignacions
 * @property Departamento $departamento
 * @property User[] $users
 */
class Trabajador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trabajador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departamento_id'], 'required'],
            [['departamento_id'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 255],
            [['categoria_docente', 'categoria_cientifica'], 'string', 'max' => 45],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['departamento_id' => 'iddepartamento']],
            //[['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['trabajador_id' => 'idtrabajador']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtrabajador' => 'Idtrabajador',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'categoria_docente' => 'Categoria Docente',
            'categoria_cientifica' => 'Categoria Cientifica',
            'departamento_id' => 'Departamento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['tutor_id' => 'idtrabajador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['iddepartamento' => 'departamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['trabajador_id' => 'idtrabajador']);
    }

    /**
     * @inheritdoc
     * @return TrabajadorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrabajadorQuery(get_called_class());
    }
}
