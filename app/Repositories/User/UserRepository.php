<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct( User $model )
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create( $data );
    }

    public function edit( int $id, array $data )
    {
        $user = $this->find( $data->id );
        $user->update( $data );

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->find( $id );
        return $user->delete();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail( $id );
    }

    public function findAll()
    {
        return $this->model->all();
    }

}
