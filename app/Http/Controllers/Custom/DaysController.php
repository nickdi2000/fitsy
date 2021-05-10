<?php
namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Custom\Days;

class DaysController extends Controller
{

	protected $model = Days::class;
	protected $modelName = 'Day';
	//store, update, etcs from core "Controller"
	public function index($id = null){
			$data = $this->model::where('day_id', $id)->get();
			return response()->json($data);
	}

	public function byPlan ($plan_id = null){
			return Days::all();
	}

	public function store(Request $request)
		{
			//if id is returned, update instead
			if($request->id){
				return $this->update($request, $request->id);
			}

			$data = $request->toArray();
			$data['plan_id'] = $data['key'];

			$day = $this->model::create($data);
			$day->save();

			return response()->json(['message' => 'Successfully Saved.']);
		}


}
