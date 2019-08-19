<?php

namespace backend\models\departamento;

/**
 * This is the ActiveQuery class for [[Departamento]].
 *
 * @see Departamento
 */
class DepartamentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Departamento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Departamento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
