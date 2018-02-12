<?php

namespace App\Http\Controllers;

use App\Note;
use App\NoteLine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::orderBy('id', 'desc')->paginate();
        return view('notes.list', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $note = new Note();
        return view('notes.edit', ["note" => $note]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note();
        $this->save($note, $request);
        return redirect()->route('notes.show', [$note->id])->with('status', 'Albarán guardado!');
    }

    private function save(Note &$note, Request &$request, $save = true)
    {
        $request->validate([
            'user_id' => 'required',
            'client_id' => 'required',
            'weight' => 'required',
            'price' => 'required'
        ]);
        $note->user_id = $request->user_id;
        $note->client_id = $request->client_id;
        $note->weight = $request->weight;
        $note->price = $request->price;
        $note->close_date = Carbon::createFromFormat('d/m/Y', $request->close_date);
        $note->delivery_date = Carbon::createFromFormat('d/m/Y', $request->delivery_date);

        $note->signed = $request->signed;
        $note->invoiced = $request->invoiced;
        $note->paid = $request->paid;

        if ($save) $note->save();

        foreach($request->note_lines as $note_line_item){
            if($note_line_item["id"]){
                $note_line = NoteLine::find($note_line_item["id"]);
            }
            else{
                $note_line = new NoteLine();
            }
            $note_line->product_id = $note_line_item["product_id"];
            $note_line->note_id = $note->id;
            $note_line->quantity = $note_line_item["quantity"];
            $note_line->description = $note_line_item["description"];
            $note_line->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Note $note
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function show(Note $note)
    {
        return view('notes.show', ['Note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Note $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit', ['Note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Note $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->save($note, $request);
        return redirect('/notes/' . $note->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('status', 'Notee eliminado!');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = Note::query();
        if($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if($request->filled('nif')) {
            $query->where('nif', 'like', '%'.$request->nif.'%');
        }
        if($request->filled('phone')) {
            $query->where('phone1', 'like', '%'.$request->phone.'%');
        }

        $notes = $query->orderBy('name')->paginate(20);

        return view('notes.list', compact('notes'));
    }
}
