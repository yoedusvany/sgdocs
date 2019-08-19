<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use backend\models\trabajador\Trabajador;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $nombre;
    public $apellidos;
    public $categoria_docente;
    public $categoria_cientifica;
    public $departamento_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['nombre','apellidos','categoria_docente','categoria_cientifica', 'departamento_id'], 'required'],
            [['nombre','apellidos'], 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        //datos para la tabla trabajador
        $trabajador = new Trabajador();
        $trabajador->nombre = $this->nombre;
        $trabajador->apellidos = $this->apellidos;
        $trabajador->categoria_docente = $this->categoria_docente;
        $trabajador->categoria_cientifica = $this->categoria_cientifica;
        $trabajador->departamento_id = $this->departamento_id;
        $trabajador->save();
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->rol_id = '1';
        $user->trabajador_id = $trabajador->idtrabajador;
        $user->save();

        return $user;
    }
}
