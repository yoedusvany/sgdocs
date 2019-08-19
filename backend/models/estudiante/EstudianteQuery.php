<?php

namespace backend\models\estudiante;

/**
 * This is the ActiveQuery class for [[Estudiante]].
 *
 * @see Estudiante
 */
class EstudianteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Estudiante[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Estudiante|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
