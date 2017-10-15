<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrants".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $sex
 * @property string $group
 * @property string $email
 * @property integer $grade
 * @property integer $birth_year
 * @property integer $is_local
 * @property string $secret
 * @property string $cookie_id
 */
class EntrantsRecord extends \yii\db\ActiveRecord
{
    public function __construct() {
        parent::__construct();
        
        $this->cookie_id = self::generateUniqueRandomString('cookie_id');
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'sex', 'group', 'email', 
              'grade', 'birth_year', 'is_local', 'secret','cookie_id'], 'required'],
            [['grade', 'is_local'], 'integer'],
            [['name', 'surname', 'email'], 'string', 'max' => 100],
            [['sex'], 'string', 'max' => 1],
            [['group'], 'string', 'min'=> 2, 'max' => 5],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['birth_year'], 'integer', 'min' => 1950, 'max' => 2010],
            [['grade'], 'integer', 'min'=>0, 'max'=>150],
            [['secret'], 'string', 'max'=>16],
            [['cookie_id'], 'string', 'max'=>255],
            [['sex'], 'in', 'range' => ['f', 'm']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'sex' => 'Sex',
            'group' => 'Group',
            'email' => 'Email',
            'grade' => 'Grade',
            'birth_year' => 'Birth Year',
            'is_local' => 'Is Local',
        ];
    }
    
    public function beforeSave($insert){
        $return = parent::beforeSave($insert);
        
        if($this->isNewRecord) {
            $this->secret = Yii::$app->security
                ->generatePasswordHash($this->secret);
        }
        else if($this->isAttributeChanged('secret')) {
            // Prevent code modification
            $this->secret = $this->oldAttributes['secret'];
        }
 
        return $return;
    }
    
    public static function generateUniqueRandomString($attribute, $length = 255) {
 	do {
            $randomString = Yii::$app->getSecurity()->generateRandomString($length);
        }
        while(EntrantsRecord::findOne([$attribute => $randomString]));
        
	return $randomString;
    }
    public static function getGenders() {
        return [
          'f',
          'm'
        ];
    }
}
