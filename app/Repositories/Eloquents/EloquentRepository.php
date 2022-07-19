<?php 

namespace App\Repositories\Eloquents;
use Illuminate\Database\Eloquent\Model; 

class EloquentRepository 
{
	protected $model;
  
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->all();
    }

    public function create($attributes){
        return $this->model->create($attributes);
    }

    public function find($id){
        $result = $this->model->find($id);
        return $result;
    }

    public function update($id, $attributes){
        $result = $this->model->find($id);
        if($result){
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id){
        $result = $this->model->find($id);
        if($result){
            $result->delete($id);
            return true;
        }
        return false;
    }

}




