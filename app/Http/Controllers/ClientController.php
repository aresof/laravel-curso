<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id','desc')->paginate();
        return view('clients.list',['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client();
        return view('clients.edit', ["client"=>$client]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $this->save($client, $request);
        return redirect()->route('clients.show',[$client->id])->with('status','Cliente guardado!');
    }

    private function save(Client &$client, Request &$request, $save = true)
    {
        $request->validate([
            'name' => 'required',
            'nif' => 'required',
            'address' => 'required'
        ]);
        $client->name = $request->name;
        $client->nif = $request->nif;
        $client->address = $request->address;
        $client->is_company = ($request->is_company == "1")? 1 : 0;
        if ($save) $client->save();
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function show(Client $client)
    {
        return view('clients.show',['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->save($client, $request);
        return redirect('/clients/'.$client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('status','Cliente eliminado!');

    }

    /**
     * @return mixed
     */
    public function search()
    {
        $client = Client::all();


        $search = \Request::get('search');  the param of URI

        $clients = Client::where('name','=','%'.$search.'%')
        ->orderBy('name')
        ->paginate(20);

        return view('home',compact('users'))->withuser($user);
    }

}
