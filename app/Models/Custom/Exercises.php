<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\BaseModel;

use SoftDeletes;

class Exercises extends BaseModel
{
		//protected $fillable = array('*');
				protected $module = 'Exercises';
				protected $resource = 'exercises';
				protected $modelName = 'Exercises';

		    protected $fillable = [
        'name', 'order', 'description'
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
