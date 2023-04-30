<?php

namespace App\Repositories\Contact;

use App\Http\Requests\Contacts\CreateContactRequest;
use Illuminate\Http\Request;

interface ContactRepositoryInterface
{
    public function create( CreateContactRequest $request );
    public function update( int $id, CreateContactRequest $request );
    public function delete( int $id );

    public function find( int $id, mixed $key = null, mixed $value = null );

    public function findAll( Request $request );

    public function searchBy( array $fields );
}
