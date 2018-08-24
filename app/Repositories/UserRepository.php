<?php

namespace App\Repositories;

use App\RepositoryInterface;
use App\User;

class UserRepository implements RepositoryInterface {

	public function all()
	{
		return User::all();
	}
 
    public function paginate($perPage = 20)
    {
    	return User::paginate($perPage);
    }

    public function simplePaginate($perPage = 20)
    {
    	return User::simplePaginate($perPage);
    }
 
    public function create(array $data)
    {
    	return User::create($data);
    }
 
    public function make(array $data)
    {
        return User::make($data);
    }
 
    public function update($id, array $data);
    {
    	return User::find($id)->update($data);
    }

    public function delete($id)
    {
    	User::destroy($id);
    }
 
    public function find($id)
    {
    	return User::find($id);
    }

}