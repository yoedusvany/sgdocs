<?php

namespace backend\models\elementoacta;

/**
 * This is the ActiveQuery class for [[ElementoActa]].
 *
 * @see ElementoActa
 */
class ElementoActaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ElementoActa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ElementoActa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
