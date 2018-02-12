<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceLine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate();
        return view('invoices.list', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        return view('invoices.edit', ["invoice" => $invoice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();
        $this->save($invoice, $request);
        return redirect()->route('invoices.show', [$invoice->id])->with('status', 'Factura guardada!');
    }

    private function save(Invoice &$invoice, Request &$request, $save = true)
    {
        $request->validate([
            'client_id' => 'required',
            'mode' => 'required'
        ]);

        $invoice->client_id = $request->client_id;
        //$invoice->client()->associate(Client::find($request->client_id));
        $invoice->paid = $request->paid;
        $invoice->date_paid = Carbon::createFromFormat('d/m/Y', $request->date_paid);
        $invoice->mode = $request->mode;
        $invoice->base = $request->base;
        $invoice->tax = $request->tax;
        $invoice->paid = $request->paid;
        $invoice->ret = $request->ret;
        $invoice->total = $request->total;

        if ($save) $invoice->save();

        foreach($request->invoice_lines as $invoice_line_item){
            if($invoice_line_item["id"]){
                $invoice_line = InvoiceLine::find($invoice_line_item["id"]);
            }
            else{
                $invoice_line = new InvoiceLine();
            }
            $invoice_line->product_id = $invoice_line_item["product_id"];
            $invoice_line->invoice_id = $invoice->id;
            $invoice_line->quantity = $invoice_line_item["quantity"];
            $invoice_line->description = $invoice_line_item["description"];
            $invoice_line->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', ['Invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', ['Invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->save($invoice, $request);
        return redirect('/invoices/' . $invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('status', 'Invoicee eliminado!');

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = Invoice::query();
        if($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if($request->filled('nif')) {
            $query->where('nif', 'like', '%'.$request->nif.'%');
        }
        if($request->filled('phone')) {
            $query->where('phone1', 'like', '%'.$request->phone.'%');
        }

        $invoices = $query->orderBy('name')->paginate(20);

        return view('invoices.list', compact('invoices'));
    }
}
