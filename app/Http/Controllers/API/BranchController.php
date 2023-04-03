<?php

namespace App\Http\Controllers\API;

use App\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Branch::orderByRaw('created_at', 'Desc')->paginate(5);
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
            'branch' => 'required',
            'btype' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'postcode' => 'required|max:5',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required'
        ]);

        return Branch::create([
            'branch' => $request['branch'],
            'type' => $request['btype'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'province' => $request['province'],
            'country' => $request['country'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if($search = \Request::get('q')){
            $users = Branch::where(function($query) use ($search){
                $query->where('branch', 'LIKE', "%$search%")
                ->orWhere('type', 'Like', "%$search%")
                ->orWhere('country', 'Like', "%$search%")
                ->orWhere('province', 'Like', "%$search%")
                ->orWhere('city', 'Like', "%$search%");
            })->paginate(5);

        }else{
            $users = Branch::latest()->paginate(5);
        }
        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findorFail($id);
        $this->validate($request, [
            'branch' => 'required',
            'btype' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'postcode' => 'required|max:5',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required'
        ]);

        $branch->update([
            'branch' => $request['branch'],
            'type' => $request['btype'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'province' => $request['province'],
            'country' => $request['country'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::findorFail($id);
        $branch->delete();
        return['message' => 'Branch Deleted'];
    }
}
