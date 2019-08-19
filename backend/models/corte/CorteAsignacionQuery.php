<?php

namespace backend\models\corte;

/**
 * This is the ActiveQuery class for [[CorteAsignacion]].
 *
 * @see CorteAsignacion
 */
class CorteAsignacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CorteAsignacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CorteAsignacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
