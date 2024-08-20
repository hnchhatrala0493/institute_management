<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function getProfile() {
        $title = 'Profile';
        $getProfile = User::find( Auth::user()->id );
        return view( 'profile.profile', [ 'title'=> $title, 'profile'=> $getProfile ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function updateProfile( Request $request ) {
        $user = User::find( Auth::user()->id );
        $this->validate( $request, [
            'fullname'=>[ 'required', 'string', 'max:255' ],
            'email'=>[ 'required', 'email', 'unique:users,email,'.$user->id ],
            'phone'=>[ 'required', 'string', 'unique:users,phone,'.$user->id ]
        ], [
            'fullname.required'=>'Name is required',
            'email.required'=>'Email is required',
            'phone.required'=>'Phone is require'
        ] );
        $userArray = [
            'fullname'=> $request->input( 'fullname' ),
            'email'=> $request->input( 'email' ),
            'phone'=> $request->input( 'phone' ),
            'gender'=>$request->input( 'gender' )
        ];
        $userDetail = User::where( 'id', Auth::user()->id )->update( $userArray );
        if ( $userDetail ) {
            return redirect()->route( 'profile' )->with( 'message', 'Profile Updated.' );
        } else {
            return redirect()->route( 'profile', [ 'user'=> $user->id ] );
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function ChangePassword( Request $request ) {
        $title = 'Change Password';
        $profile = User::find( Auth::user()->id );
        return view( 'profile.changepassword', compact( 'title', 'profile' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function UpdatePassword( Request $request, $id ) {
        $this->validate( $request, [
            'old_password'=>[ 'required' ],
            'new_password'=>[ 'required' ],
            'confirm_password'=>[ 'required' ]
        ], [
            'old_password.required'=>'Old Password is required',
            'new_password.required'=>'New Password is required',
            'confirm_password.required'=>'Confirm Password is required'
        ] );
        if ( $request->new_password != $request->confirm_password ) {
            return redirect()->route( 'password.changepassword' )->with( 'validate', 'New password and confirm password do not match.' );
        }
        $user = User::find( $id );
        $oldPassword = $request->old_password;
        if ( Hash::check( $oldPassword, $user->password ) ) {
            $userCreadials = [
                'password'=> Hash::make( $request->get( 'new_password' ) ),
            ];
            $user = User::where( 'id', $id )->update( $userCreadials );
            if ( $user ) {
                return redirect()->route( 'home' )->with( 'message', 'Password successfully changed!' );
            }
        } else {
            return redirect()->route( 'password.changepassword' )->with( 'validate', 'Password failed' );
        }

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function ResetPassword() {
        return view( 'profile.resetpassword' );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function CustomPassword( Request $request ) {
        $this->validate( $request, [
            'password'=>[ 'required' ],
            'password_confirmation'=>[ 'required' ]
        ], [
            'password.required'=>'Old Password is required',
            'password_confirmation.required'=>'New Password is required'
        ] );
        $id = Auth::user()->id;
        $user = User::find( $id );
        // database store password
        $oldPassword = $user->password;
        // get request password
        $newpassword = $request->password;
        if ( !Hash::check( $newpassword, $oldPassword ) ) {
            $userCreadials = [
                'last_logged_at'=> date( 'Y-m-d H:i:s', strtotime( 'now' ) ),
                'password'=> Hash::make( $request->get( 'password' ) ),
            ];
            $user = User::where( 'id', $id )->update( $userCreadials );
            if ( $user ) {
                return redirect()->route( 'home' )->with( 'message', 'Password successfully changed!' );
            }
        } else {
            return redirect()->route( 'password.resetpassword' )->with( 'validate', 'Password failed' );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
