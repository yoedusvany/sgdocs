<?php

namespace backend\models\tipoacta;

/**
 * This is the ActiveQuery class for [[TipoActa]].
 *
 * @see TipoActa
 */
class TipoActaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TipoActa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TipoActa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
