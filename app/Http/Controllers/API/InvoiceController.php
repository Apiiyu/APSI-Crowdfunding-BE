<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceNumber = request()->input('invoice_number');
        $customerName = request()->input('customer_name');
        $campaignTitle = request()->input('campaign_title');
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 10);

        $invoice = Invoice::query();

        if ($invoiceNumber) {
            $invoice->where('invoice_number', 'like', '%' . $invoiceNumber . '%');
        }

        if ($customerName) {
            $invoice->whereHas('customer', function ($query) use ($customerName) {
                $query->where('name', 'like', '%' . $customerName . '%');
            });
        }

        if ($campaignTitle) {
            $invoice->whereHas('campaign', function ($query) use ($campaignTitle) {
                $query->where('title', 'like', '%' . $campaignTitle . '%');
            });
        }

        if ($page) {
            $invoice->skip(($page - 1) * $limit);
        }

        // ? Show relationship data
        $invoice->with(['customer', 'campaign']);

        return ResponseFormatter::success(
            $invoice->paginate($limit),
            'Data list invoice berhasil',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'campaign_id' => 'required|integer',
            'invoice_number' => 'required|string',
            'amount' => 'required|integer',
            'status' => 'required|string',
            'payment_date' => 'date',
            'note' => 'string',
        ]);

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'campaign_id' => $request->campaign_id,
            'invoice_number' => $request->invoice_number,
            'amount' => $request->amount,
            'status' => $request->status,
            'due_date' => now()->addDay(),
            'payment_date' => $request->payment_date,
            'note' => $request->note,
        ]);

        if ($invoice->save()) {
            return ResponseFormatter::success($invoice, 'Invoice berhasil ditambahkan');
        } else {
            return ResponseFormatter::error([
                'message' => 'Failed to add invoice'
            ], 'Invoice Failed', 500);
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
        $invoice = Invoice::with(['customer', 'campaign'])->find($id);

        if ($invoice) {
            return ResponseFormatter::success($invoice, 'Data invoice berhasil ditemukan');
        } else {
            return ResponseFormatter::error([
                'message' => 'Data invoice tidak ditemukan'
            ], 'Invoice Not Found', 404);
        }
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
        $invoice = Invoice::find($id);

        if ($invoice) {
            $request->validate([
                'customer_id' => 'required|integer',
                'campaign_id' => 'required|integer',
                'invoice_number' => 'required|string',
                'amount' => 'required|integer',
                'status' => 'required|string',
                'due_date' => 'required|date',
                'payment_date' => 'date',
                'note' => 'string',
            ]);

            $invoice->update([
                'customer_id' => $request->customer_id,
                'campaign_id' => $request->campaign_id,
                'invoice_number' => $request->invoice_number,
                'amount' => $request->amount,
                'status' => $request->status,
                'due_date' => $request->due_date,
                'payment_date' => $request->payment_date,
                'note' => $request->note,
            ]);

            return ResponseFormatter::success($invoice, 'Invoice berhasil diperbarui');
        } else {
            return ResponseFormatter::error([
                'message' => 'Data invoice tidak ditemukan'
            ], 'Invoice Not Found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->delete();

            return ResponseFormatter::success(null, 'Invoice berhasil dihapus');
        } else {
            return ResponseFormatter::error([
                'message' => 'Data invoice tidak ditemukan'
            ], 'Invoice Not Found', 404);
        }
    }
}
