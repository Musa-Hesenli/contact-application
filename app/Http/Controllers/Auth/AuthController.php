<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct( UserRepositoryInterface $userRepository )
    {
        $this->userRepository = $userRepository;
    }

    public function login( LoginRequest $request )
    {
        try {
            $user = User::where( 'email', $request->post( 'email' ) )->first();
            if ( ! $user )
            {
                return redirect()->route( 'login' )
                    ->withInput()
                    ->withErrors( [
                        'general_error' => 'We could not find record with the given credentials'
                    ] );
            }

            $is_password_correct = Hash::check( $request->post( 'password' ), $user->password );
            if ( ! $is_password_correct )
            {
                return redirect()->route( 'login' )
                    ->withInput()
                    ->withErrors( [
                        'general_error' => 'We could not find record with the given credentials'
                    ] );
            }
            Auth::login( $user );
            return redirect()->route( 'home-page' );
        } catch ( \Exception $exception )
        {
            return redirect()->route( 'login' )
                ->withInput()
                ->withErrors( [
                    'general_error' => $exception->getMessage()
                ] );
        }
    }

    public function register( RegisterRequest $request )
    {
        try {
            $user = $this->userRepository->create( [
                'name'     => $request->post( 'name' ),
                'email'    => $request->post( 'email' ),
                'password' => Hash::make( $request->post( 'password' ) )
            ] );
            Auth::login( $user );
            return redirect()->route( 'home-page' );
        }
        catch ( \Exception $exception )
        {
            return redirect()->route( 'register' )
                ->withInput()
                ->withErrors( [
                    'general_error' => $exception->getMessage()
                ] );
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route( 'login' );
    }
}
