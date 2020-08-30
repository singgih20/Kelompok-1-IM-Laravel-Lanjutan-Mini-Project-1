<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getrole = Auth::user()->roles; 
        if ($getrole == 'admin') {
            $orders = Order::all();
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->get();
        }
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'book_id' => ['required', 'exists:books,id'],
            'quantity' => ['numeric', 'required', 'min:1']
        ]);
        $getbook = Book::find(request('book_id'))->first();
        if(request('quantity') > $getbook->stock){
            return response()->json(['status' => 'error', 'message' => 'Jumlah stock tidak mencukupi']);
        }
        $total_price = request('quantity') * $getbook->price;
        $invoice = $this->generateInvoice();

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'book_id' => request('book_id'),
            'quantity' => request('quantity'),
            'total_price' => $total_price,
            'invoice_number' => $invoice,
            'status' => 'SUBMIT'
        ]);
        
        if($order){
            $updateQty = Book::find(request('book_id'));
            $updateQty->stock = $getbook->stock - request('quantity');
            $updateQty->save();
        }
        return response()->json(['status' => 'success', 'data' => $order]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $getrole = Auth::user()->roles; 
        $action = strtoupper(request('action'));
        // status order 'SUBMIT', 'PROCESS', 'FINISH', 'CANCEL'

        // rules
        // 1. aksi untuk update status order hanya PROCESS, FINISH & CANCEL
        if(!in_array($action,['PROCESS', 'FINISH', 'CANCEL'])){
            // sebenarnya sudah dibatasi dari tipe data di table menggunakan enum
            return response()->json(['message'=>'Aksi tidak dikenali'], 400);
        }
        // 2. hanya admin yang bisa merubah jadi process
        if ($getrole != 'admin' && $action == "PROCESS") {
            return response()->json(['message'=>'Anda tidak diijinkan melakukan aksi PROCESS'], 401);
        }
        // 3. syarat order di cancel hanya jika statusnya masih SUBMIT
        if($action=='CANCEL' && $order->status=='SUBMIT') {
            $qty  = $order->quantity;
            $book_id  = $order->book_id;
            // kembalikan stock jika order di cancel
            $updateQty = Book::find($book_id)->first();
            $updateQty->stock = $updateQty->stock + $qty;
            $updateQty->save();

            $order->update([
                "status" => $action
            ]);
            return response()->json(['message'=>'Order '.$order->invoice_number.' Berhasil di cancel'], 200);
        } 
        // 4. hirarki syarat rubah status process jika awalnya submit, rubah finish jika awalnya sudah di process
        if(($action=='PROCESS' && $order->status=='SUBMIT') || ($action=='FINISH' && $order->status=='PROCESS')) {
            $order->update([
                "status" => $action
            ]);
            return response()->json(['message'=>'Order '.$order->invoice_number.' Berhasil di '.strtolower($action)], 200);
        } else {
            return response()->json(['message'=>'Terjadi kesalahan dalam perubahan status order Anda'], 406);
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
        //
    }

    private function generateInvoice() {
        $number = uniqid(); // unique ID based on the microtime
        $date = Carbon::now()->format('my');
        $invoice = "INV-$date-$number";
        // call the same function if the barcode exists already
        if ($this->invoiceExists($invoice)) {
            return $this->generateInvoice();
        }
    
        // otherwise, it's valid and can be used
        return $invoice;
    }

    private function invoiceExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Order::whereInvoice_number($number)->exists();
    }
}
