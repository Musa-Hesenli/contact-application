<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function create( array $data );
    public function edit( int $id, array $data );
    public function delete( int $id );
    public function find( int $id );
    public function findAll( );
}
