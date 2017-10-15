<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntrantsRecord;

/**
 * EntrantsSearchModel represents the model behind the search form about `app\models\EntrantsRecord`.
 */
class EntrantsSearchModel extends EntrantsRecord
{
    public $str;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade', 'birth_year', 'is_local'], 'integer'],
            [['name', 'surname', 'sex', 'group', 
              'email', 'str'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EntrantsRecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
            'sort' => ['defaultOrder' => ['grade' => SORT_DESC]],
        ]);

        $this->load($params);

        if(isset($params['str'])) {
            $this->str = $params['str'];
            $query->where(['like', 
              "concat(name, surname, `group`, grade, birth_year)", $params['str']]);
        }
 
        return $dataProvider;
    }
}
