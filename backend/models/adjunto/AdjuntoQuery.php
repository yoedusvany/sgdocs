<?php

namespace backend\models\adjunto;

/**
 * This is the ActiveQuery class for [[Adjunto]].
 *
 * @see Adjunto
 */
class AdjuntoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Adjunto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Adjunto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
