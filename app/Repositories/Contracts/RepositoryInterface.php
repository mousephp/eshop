<?php 

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);



	// public function destroy($id);
 //    public function lists($column, $key = null);
 //    public function paginate($limit = null, $columns = ['*']);
 //    public function findOrFail($id, $columns = ['*']);
    
}
