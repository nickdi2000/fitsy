<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Custom\Exercises;
use Illuminate\Support\Facades\DB;

class ExercisesController extends Controller
{

	protected $model = Exercises::class;
	protected $modelName = 'Exercise';

	//get exercises by day
	public function index($day_id = null){
		//	$data = $this->model::where('day_id', $day_id)->get();
			$data = DB::table('day_exercises')
								->join('days', 'days.id', '=', 'day_exercises.day_id')
								->join('exercises', 'exercises.id', '=', 'day_exercises.exercise_id' )
								->where('day_exercises.day_id', '=', $day_id)
								->get();

			return response()->json($data);
	}

	public function getByDay($day_id){
			$data = DB::table('day_exercises')
								->join('days', 'days.id', '=', 'day_exercises.day_id')
								->join('exercises', 'exercises.id', '=', 'day_exercises.exercise_id' )
								->where('day_exercises.day_id', '=', $day_id)
								->get();

			return response()->json($data);
	}


	public function list(){
		$id = 1;
		return Exercises::where('user_id', '=', $id)->get();
		//return 'hello';//response()->json(['message' => 'list of exercises']);
	}




}
