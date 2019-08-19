<?php

namespace backend\models\asignacion;

/**
 * This is the ActiveQuery class for [[Asignacion]].
 *
 * @see Asignacion
 */
class AsignacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Asignacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Asignacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
