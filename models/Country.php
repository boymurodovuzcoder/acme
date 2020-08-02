<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $phonecode
 * @property string $lat
 * @property string $lng
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'phonecode', 'lat', 'lng'], 'required'],
            [['phonecode'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 80],
            [['lat', 'lng'], 'string', 'max' => 45],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'phonecode' => 'Phonecode',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }
}
