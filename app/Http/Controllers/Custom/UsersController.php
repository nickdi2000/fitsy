<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use App\Models\Custom\Plans;

class UsersController extends Controller
{

	public function stats(){
			$user_id = auth('web')->user()->id;

			$data['plans'] =
						DB::table('plans')
							->where('user_id', 1)
							->count();

			$data['clients'] = 0; //updatenickdi


		  return response()->json($data);
	}



}
