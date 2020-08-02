<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $place_id
 * @property string $lat
 * @property string $lng
 * @property string $country_code
 * @property int $is_country
 *
 * @property PlaceLang[] $placeLangs
 * @property Trip[] $trips
 * @property Trip[] $trips0
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_id', 'lat', 'lng', 'country_code', 'is_country'], 'required'],
            [['is_country'], 'integer'],
            [['place_id', 'lat', 'lng'], 'string', 'max' => 45],
            [['country_code'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'country_code' => 'Country Code',
            'is_country' => 'Is Country',
        ];
    }

    /**
     * Gets query for [[PlaceLangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceLangs()
    {
        return $this->hasMany(PlaceLang::className(), ['place_id' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['from' => 'id']);
    }

    /**
     * Gets query for [[Trips0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips0()
    {
        return $this->hasMany(Trip::className(), ['to' => 'id']);
    }
}
