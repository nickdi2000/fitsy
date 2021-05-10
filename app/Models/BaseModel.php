<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Schema;

class BaseModel extends Model
{

	//protected $model;
	protected $module;
	protected $resource;

	protected $modelName;

	public function __construct(array $attributes = [])
	{
		// Append the RESTful paths so they can be used by Vue
		$this->append([
			'indexPath',
			'storePath',
			'showPath',
			'updatePath',
			'destroyPath',
			'createPath',
			'editPath'
		]);

		// Append other attributes
		$this->append([
			'modelName'
		]);

		// Call parent constructor, this is necessary so that static methods (such as ::create()) still work as expected
		parent::__construct($attributes);
	}

	/* Boot Method allows us to consume events */
	public static function boot()
    {
        parent::boot();

		// Models to exclude from automatic slug updating - currently specifically for jeremykenedy Roles/Permissions
		$excludedModels = ['Permission'];

        self::creating(function($model) use ($excludedModels) {
			if(!in_array($model->modelName, $excludedModels))
            	$model->setSlug();
        });

        self::updating(function($model) use ($excludedModels) {
			if(!in_array($model->modelName, $excludedModels))
            	$model->setSlug();
        });

        // These events are also available if needed //

        //self::created(function($model){ });
        //self::updated(function($model){ });
        //self::deleting(function($model){ });
        //self::deleted(function($model){ });
    }


    /**********/
	/* Scopes */
	/**********/

	// Allow finding a model based on slug
	public function scopeSlug($query, $slug){
		return $query->where('slug', $slug)->firstOrFail();
	}

	/* END Scopes */


	/**************/
	/* Attributes */
	/**************/


	public function getModelNameAttribute()
	{
		if(!$this->modelName)
			throw new \Exception('The $modelName variable has not been set.');

		return $this->modelName;
	}

	/* END Attributes */



	/***********/
	/* Methods */
	/***********/

	// If the model has a slug, try to set it by looking for a name or title field
	public function setSlug()
	{
		// Set slug character as jeremykenedy roles and permissions use '.' instead of '-'
		$dotModels = ['Role', 'Permission'];

		$slug_char = in_array($this->modelName, $dotModels) ? '.' : '-';

		// If the model has a slug column, set it based on the name or title column
		if(Schema::hasColumn($this->getTable(), 'slug'))
		{
			if(Schema::hasColumn($this->getTable(), 'name') && $this->name)
				$this->slug = str_slug($this->name, $slug_char);
			elseif(Schema::hasColumn($this->getTable(), 'title') && $this->title)
				$this->slug = str_slug($this->title, $slug_char);
		}
	}

	/* END Methods */


	/* RESTful Path Methods */

	private function getBasePath()
	{
		//check for existance of required properties
		if(!$this->module || !$this->resource)
			throw new \Exception('protected $module and protected $resource must be set in order to use restful paths.');

		return '/' . $this->resource . '/';
	}

	/*
	Get the list of all resources
	METHOD: GET
	*/
	public function getIndexPathAttribute(){
		return $this->getBasePath();
	}

	/*
	Store a newly created resource in storage.
	METHOD: POST
	*/
	public function getStorePathAttribute(){
		return $this->getBasePath();
	}

	/*
	Display the specified resource
	METHOD: GET
	*/
	public function getShowPathAttribute(){
		return $this->getBasePath() . ($this->slug ?? $this->id);
	}

	/*
	Update the specified resource in storage.
	METHOD: PUT
	*/
	public function getUpdatePathAttribute(){
		return '/api' . $this->getBasePath() . $this->id;
	}

	/*
	Remove the specified resource from storage.
	METHOD: DELETE
	*/
	public function getDestroyPathAttribute(){
		return '/api' . $this->getBasePath() . $this->id;
	}

	/*
	Show the form for creating a new resource.
	METHOD: GET
	*/
	public function getCreatePathAttribute(){
		return $this->getBasePath() . 'create';
	}

	/*
	Show the form for editing the specified resource.
	METHOD: GET
	*/
	public function getEditPathAttribute(){
		return $this->getBasePath() . ($this->slug ?? $this->id) . '/edit';
	}



	/* END RESTful Path Methods */

}
