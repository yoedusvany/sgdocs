<?php

namespace backend\models\acuerdos;

/**
 * This is the ActiveQuery class for [[Acuerdos]].
 *
 * @see Acuerdos
 */
class AcuerdosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Acuerdos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Acuerdos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
