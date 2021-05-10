<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Custom\Plans;
//use App\Models\Custom\Days;

class PlansController extends Controller
{

	protected $model = Plans::class;
	protected $modelName = 'Plan';

	public function index(){
			$data = Plans::where('user_id', auth('web')->user()->id)->get();
		  return response()->json($data);
	}


	public function store(Request $request)
    {
			//if id is returned, update instead
			if($request->id){
				return $this->update($request, $request->id);
			}

      $data = $request->toArray();
			$data['user_id'] = auth('web')->user()->id;

      $plan = Plans::create($data);
      $plan->save();

      return response()->json(['message' => ' Plan Successfully Saved.']);
    }

		public function update(Request $request, $id)
			{
				$plan = Plans::findOrFail($id);
				$data = $request->toArray();

				$plan->update($data);
				$plan->save();

				return response()->json(['message' => 'plan successfully updated.']);
			}


}
