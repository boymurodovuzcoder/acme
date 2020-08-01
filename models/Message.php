<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property int $trip_id
 * @property string $text
 * @property string $created
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id', 'trip_id', 'text'], 'required'],
            [['from_user_id', 'to_user_id', 'trip_id'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'trip_id' => 'Trip ID',
            'text' => 'Text',
            'created' => 'Created',
        ];
    }
}
