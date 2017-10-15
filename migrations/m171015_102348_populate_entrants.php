<?php

use yii\db\Migration;

class m171015_102348_populate_entrants extends Migration
{
    public static $genders = ['male', 'female'];
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $entrantsCount = 175;
        
        for($i=0; $i<$entrantsCount; $i++) {
            $model = $this->imagineEntrant();
            $model->save();
        }
    }

    public function down()
    {
        $this->delete('entrants');
    }
   
    public function imagineEntrant() {
        $faker = \Faker\Factory::create();
        $entrant = new \app\models\EntrantsRecord();
        
        $gender = $faker->randomElement(self::$genders);
        
        $entrant->name = $faker->name($gender);
        $entrant->surname = $faker->lastName;
        $entrant->sex = substr($gender, 0, 1);
        $entrant->group = $faker->randomLetter . $faker->randomLetter . $faker->randomNumber(2);
        $entrant->email = $faker->email;
        $entrant->grade = $faker->numberBetween(0, 150);
        $entrant->birth_year = $faker->numberBetween(1950, 2010);
        $entrant->is_local = $faker->numberBetween(0,1);
        $entrant->secret = $faker->word;
        $entrant->cookie_id = app\models\EntrantsRecord::generateUniqueRandomString('cookie_id');
        
        return $entrant;
    }
}
