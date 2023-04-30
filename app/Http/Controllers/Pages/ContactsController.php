<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\CreateContactRequest;
use App\Models\Contact;
use App\Models\ContactCategory;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactsController extends Controller
{
    private $contactRepository;

    public function __construct( ContactRepositoryInterface $contactRepository )
    {
        $this->contactRepository = $contactRepository;
    }

    public function index( Request $request )
    {
        $contacts   = $this->contactRepository->findAll( $request );
        $categories = $this->getCategories();
        return view( 'pages.home', compact( 'contacts', 'categories' ) );
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view( 'pages.create-contact', compact( 'categories' ) );
    }

    public function store( CreateContactRequest $request )
    {
        try {
            $this->contactRepository->create( $request );
            return redirect()->route( 'home-page' );
        }
        catch ( \Exception $exception )
        {
            return redirect()->back()
                ->withInput()
                ->withErrors( [
                    'general_error' => $exception->getMessage()
                ] );
        }
    }

    public function edit(string $id)
    {
        try {
            $contact    = $this->contactRepository->find( $id );
            $categories = $this->getCategories();
            return view( 'pages.edit', compact( 'contact', 'categories' ) );
        } catch ( \Exception $exception )
        {
            return redirect()->back()
                ->withInput()
                ->withErrors( [
                    'general_error' => $exception->getMessage()
                ] );
        }
    }

    public function update( CreateContactRequest $request, string $id )
    {
        try {
            $this->contactRepository->update( $id, $request );
            return redirect()->route( 'home-page' );
        }
        catch ( \Exception $exception )
        {
            return redirect()->back()
                ->withInput()
                ->withErrors( [
                    'general_error' => $exception->getMessage()
                ] );
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->contactRepository->delete( $id );
            return response()->json( [
                'data' => 'success'
            ] );
        }
        catch ( \Exception $exception )
        {
            return response()->json( [
                'error' => $exception->getMessage()
            ], 400 );
        }
    }

    public function showOnMap( string $id )
    {
        $contact = $this->contactRepository->find( $id );
        return view( 'pages.map-details', compact( 'contact' ) );
    }

    public function export( Request $request )
    {
        $contacts = $this->contactRepository->findAll( $request );
        $headers  = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"'
        ];
        $output = fopen( 'php://output', 'w' );
        fputcsv( $output, [ 'ID', 'Name', 'Email', 'Number', 'Category', 'Avatar', 'Lat', 'Long' ] );
        foreach ( $contacts as $contact )
        {
            $rowData = [
                $contact->id,
                $contact->name,
                $contact->email,
                $contact->number,
                $contact->category->name,
                url( 'storage/' . $contact->file ),
                $contact->lat,
                $contact->long
            ];
            fputcsv( $output, $rowData );
        }
        fclose( $output );
        return response()->make( '', 200, $headers );
    }

    private function getCategories()
    {
        return Cache::remember( 'categories', now()->addMinutes( 15 ), function () {
            return ContactCategory::all();
        } );
    }
}
