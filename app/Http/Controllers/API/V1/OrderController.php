<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{

    public function __construct (public OrderService $orderservice)
    {
    
    }

    /**
     * Display a listing of the resource.
     */
    public function  index(): JsonResponse
    {
        $orders = $this->orderservice->getAll();
        return response()->json($orders);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $user = auth()->user();
        $data = $request->toArray();
        $data['user_id'] = $user->id;
        $order['num_invoice'] = date('Ymd').rand(100,999);
        return $this->orderservice->store($data);
    }
    public function generateInvoice($request)
    {
        
        $order = Order::find($request)->with('user')->first();
        $pdf = PDF::loadView('invoice',['orders'=>$order]);
        return $pdf->download('Facture-' . now() . ".pdf");
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
        $order = Order::find( $id)->with('user')->first();
        return  view('invoice', ["order" => $order]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
