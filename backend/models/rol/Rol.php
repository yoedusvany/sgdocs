<?php

namespace backend\models\rol;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $idrol
 * @property string $rol
 *
 * @property User[] $users
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrol' => 'Idrol',
            'rol' => 'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'idrol']);
    }

    /**
     * @inheritdoc
     * @return RolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolQuery(get_called_class());
    }
}
