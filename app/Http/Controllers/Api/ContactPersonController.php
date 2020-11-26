<?php

namespace App\Http\Controllers\Api;

use App\Laravue\Models\ContactPerson;
use App\Http\Resources\ContactPersonResource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ContactPersonController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $ContactPersonQuery = ContactPerson::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $ContactPersonQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $ContactPersonQuery->where('companyemail', 'LIKE', '%' . $keyword . '%');
        }

        return ContactPersonResource::collection($ContactPersonQuery->paginate($limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['rState']);
        unset($data['rContactType']);
        unset($data['rUpperManage']);
        $contactPerson = new ContactPerson($data);
        $contactPerson->save();
        $contactPersonRemote = new ContactPersonRemote($data);
        $contactPersonRemote->save();
        return response()->json($contactPerson);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\\Models\\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function show(ContactPerson $contactPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\\Models\\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPerson $contactPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\\Models\\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactPerson $contactPerson)
    {
        if($contactPerson === null)
        {
            return response()->json(['error' => 'Customer   $data = $request->all(); not found'], 404);
        }
        $data = $request->all();
        unset($data['index']);
        unset($data['key']);
        unset($data['rState']);
        unset($data['rContactType']);
        unset($data['rUpperManage']);
        
        $data['telephone'] = '';
        foreach($data as $key => $item)
        {
            if($data[$key] === null)
            {
                $data[$key] = '';
            }
        }
        if($data['state'] == null)
        {
            $data['state'] = null;
        }
        $contactPerson->update($data);
        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\\Models\\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPerson $contactPerson)
    {
        //
    }
}
