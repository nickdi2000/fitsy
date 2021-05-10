<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function store(Request $request)
      {
        //if id is returned, update instead
        if($request->id){
          return $this->update($request, $request->id);
        }

        $data = $request->toArray();
        $plan = $this->model::create($data);
        $plan->save();

        return response()->json(['message' => $this->modelName . ' Successfully Saved.']);
      }

			public function destroy($id)
		    {
		        $this->model::destroy($id);

		        return response()->json([
		            'message' => "Deleted {$this->modelName}."
		        ]);
		    }


    public function show($id){
          if($id == "undefined"){
            $res = collect(new $this->model);
          }else{
            $res = $this->model::findOrFail($id);
          }
          return $res;
    }

		public function update(Request $request, $id)
			{
				$plan = $this->model::findOrFail($id);
				$data = $request->toArray();

				$plan->update($data);
				$plan->save();

				return response()->json(['message' => $this->modelName . ' updated.']);
			}

}
