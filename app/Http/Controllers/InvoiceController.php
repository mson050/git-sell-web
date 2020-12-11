<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $query = Invoice::query();
        $invoices = $query->paginate(5);
        return view('invoice.index',compact('invoices'));
    }
}
