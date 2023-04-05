<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();
        $type=$user->type;
        if($type!="Staff" && $type!="Driver"){
            return User::where('type' ,'!=', 'Customer')->orderByRaw('created_at', 'Desc')->paginate(5);
        }

        return User::orderByRaw('created_at', 'Desc')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'type' => 'required',
            'password' => 'required|string|min:8',
            'branch' => 'required'
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
            'branch' => $request['branch'],
            'photo' => $request['photo']
        ]);
    }

    public function search()
    {
        if($search = \Request::get('q')){
            return User::where(function($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'Like', "%$search%")
                ->orWhere('type', 'Like', "%$search%");
            })->paginate(5);

        }else{
            return User::where('type' ,'!=', 'Customer')->latest()->paginate(5);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function Profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {

        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'photo' => 'required',
            'address1' => 'required|string|max:191',
            'address2' => 'required|string|max:191',
            'postcode' => 'required|string',
            'city' => 'required|string|max:191',
            'province' => 'required|string|max:191',
            'country' => 'required|string|max:191',
        ]);

        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto) {


            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            Image::make($request->photo)->save(public_path('img/profile/') . $name);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            if (file_exists($userPhoto)) {
                if ($userPhoto != public_path('img/profile/profile.png')) {
                    @unlink($userPhoto);
                }
            }
        }

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'bio' => $request['bio'],
            'photo' => $name,
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'province' => $request['province'],
            'country' => $request['country'],
        ]);
        return ['message' => 'success'];
        // return['message' => 'Successful'];
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'type' => 'required',
            'password' => 'sometimes|min:8',
            'branch' => 'required'
        ]);

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
            'branch' => $request['branch'],
            'photo' => $request['photo']
        ]);

        return ['message' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->delete();
        //delete the user

        return ['message' => 'User Deleted'];
    }
}
