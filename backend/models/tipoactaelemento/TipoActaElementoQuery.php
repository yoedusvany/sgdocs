<?php

namespace backend\models\tipoactaelemento;

/**
 * This is the ActiveQuery class for [[TipoActaElemento]].
 *
 * @see TipoActaElemento
 */
class TipoActaElementoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TipoActaElemento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TipoActaElemento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
