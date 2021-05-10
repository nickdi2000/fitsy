<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\BaseModel;

//use SoftDeletes;

class Plans extends BaseModel
{
		//protected $fillable = array('*');
				protected $module = 'Plans';
				protected $resource = 'plans';
				protected $model = 'Plans';

				protected $modelName = 'plans';

		    protected $fillable = [
        'name', 'active', 'user_id', 'description'
    ];


		public function __construct(array $attributes = [])
		{
			$this->append([
				'managePath',
			]);
			parent::__construct($attributes);
		}


		public function getManagePathAttribute(){
			return '/' . $this->resource . '/' . $this->id . '/manage/';
		}
}
