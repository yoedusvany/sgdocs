<?php

namespace backend\models\lineainvestigacion;

/**
 * This is the ActiveQuery class for [[Lineainvestigacion]].
 *
 * @see Lineainvestigacion
 */
class LineainvestigacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Lineainvestigacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Lineainvestigacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
