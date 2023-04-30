<?php

namespace App\Repositories\Contact;

use App\Http\Requests\Contacts\CreateContactRequest;
use App\Models\Contact;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ContactRepository implements ContactRepositoryInterface
{
    private $model;

    public function __construct( Contact $model )
    {
        $this->model = $model;
    }

    public function create( CreateContactRequest $request )
    {
        $contactExists = Contact::where( 'user_id', auth()->user()->getAuthIdentifier() )->where( 'number', $request->post( 'phone' ) )->first();
        if ( $contactExists )
        {
            throw new \Exception( 'Contact already exists with the phone number' );
        }

        $fileUrl = null;
        if ( $request->hasFile( 'file' ) )
        {
            $fileUrl = ImageService::uploadImage( $request->file( 'file' ), 'contact-avatars', 200, 200, 80 );
        }

        $contact = new Contact();
        $contact->setAttribute( 'name',        $request->post( 'name' ) );
        $contact->setAttribute( 'email',       $request->post( 'email' ) );
        $contact->setAttribute( 'file',        $fileUrl );
        $contact->setAttribute( 'number',      $request->post( 'phone' ) );
        $contact->setAttribute( 'category_id', $request->post( 'category' ) );
        $contact->setAttribute( 'user_id',     auth()->user()->getAuthIdentifier() );
        $contact->setAttribute( 'lat',         $request->post( 'lat' ) );
        $contact->setAttribute( 'long',        $request->post( 'long' ) );

        return $contact->save();
    }

    public function update(int $id, CreateContactRequest $request )
    {

        $contact = $this->find( $id );
        if ( $request->hasFile( 'file' ) )
        {
            $contact->setAttribute( 'file', ImageService::uploadImage(  $request->file( 'file' ), 'contact-avatars', 200, 200, 80 ) );
        }
        $contact->setAttribute( 'name',        $request->post( 'name' ) );
        $contact->setAttribute( 'email',       $request->post( 'email' ) );
        $contact->setAttribute( 'number',      $request->post( 'phone' ) );
        $contact->setAttribute( 'category_id', $request->post( 'category' ) );
        $contact->setAttribute( 'lat',         $request->post( 'lat' ) );
        $contact->setAttribute( 'long',        $request->post( 'long' ) );

        return $contact->save();
    }

    public function delete(int $id)
    {
        $contact = $this->find( $id );
        return $contact->delete();
    }

    public function find(int $id, mixed $key = null, $value = null)
    {
        if ( ! empty( $key ) && ! empty( $value ) )
        {
            return $this->model->where( 'user_id', auth()->user()->getAuthIdentifier() )->where( $key, $value )->firstOrFail();
        }

        return $this->model->where( 'user_id', auth()->user()->getAuthIdentifier() )->findOrFail( $id );
    }

    public function findAll( Request $request )
    {
        $category = $request->get( 'category' );
        $keyword  = $request->get( 'keyword' );
        if ( $category || $keyword )
        {
            $contacts   = Contact::where( [
                'user_id' => auth()->user()->getAuthIdentifier()
            ] );
            if ( ! empty( $category ) )
            {
                $contacts->where( 'category_id', $category );
            }
            if ( ! empty( $keyword ) )
            {
                $contacts->where( 'name', 'like', '%' . $keyword . '%' )
                    ->orWhere( 'email', 'like', '%' . $keyword . '%' )
                    ->orWhere( 'number', 'like', '%' . $keyword . '%' );
            }

            return $contacts->get();
        }

        return $this->model->where( 'user_id', auth()->user()->getAuthIdentifier() )->with( 'category' )->get();
    }

    public function searchBy(array $fields)
    {
        return $this->model->where( 'user_id', auth()->user()->getAuthIdentifier() )->where( $fields )->get();
    }

}
