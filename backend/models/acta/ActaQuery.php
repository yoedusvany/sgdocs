<?php

namespace backend\models\acta;

/**
 * This is the ActiveQuery class for [[Acta]].
 *
 * @see Acta
 */
class ActaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Acta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Acta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
