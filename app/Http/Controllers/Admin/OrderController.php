<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
   public function index(Request $request)
   {
    //   $todayDate = Carbon::now();
    //   $orders = Order::whereDate('created_at',$todayDate)->paginate(10);

     $todayDate = Carbon::now()->format('Y-m-d');
     $orders = Order::when($request->date != null,function($q) use ($request){

                           return $q->whereDate('created_at',$request->date);

                         }
                         ,function($q) use ($todayDate){

                            return $q->whereDate('created_at',$todayDate);
                          }
                          )
                         ->when($request->status != null,function($q) use ($request){

                            return $q->where('status_message',$request->status);
                          })
                          ->paginate(10);

      return view('admin.orders.index',compact('orders'));
   }

   public function show(int $orderId)
   {
        $locale = app()->getLocale();

        $order = Order::where('id',$orderId)->first();
        if($order)
        {
            return view('admin.orders.view',compact('order'));
        }else{
            if($locale=='ar'){
            return redirect('admin/orders')->with('message','الطلب غير موجود');
            }
            return redirect('admin/orders')->with('message','Order Id not found');
        }

   }

   public function updateOrderStatus(int $orderId,Request $request)
   {
        $locale = app()->getLocale();

        $order = Order::where('id',$orderId)->first();
        if($order)
        {
            $order->update([
                'status_message'=> $request->order_status
            ]);
            if($locale=='ar'){
                return redirect('admin/orders/'.$orderId)->with('message','تم تحديث حالة الطلب');
            }
            return redirect('admin/orders/'.$orderId)->with('message','Order Status Updated');
        }else{

            if($locale=='ar'){
                return redirect('admin/orders/'.$orderId)->with('message',' رقم الطلب غير موجود');
            }

            return redirect('admin/orders/'.$orderId)->with('message','Order Id not found');
        }
   }

   public function viewInvoice(int $orderId)
   {
        $order = Order::findOrFail($orderId);

        return view('admin.invoice.generate-invoice',compact('order'));
   }

   public function generateInvoice(int $orderId)
   {
        $order = Order::findOrFail($orderId);
        $data=['order'=>$order];

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate=Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
   }

   public function mailInvoice(int $orderId)
   {
        $locale = app()->getLocale();

        try{

            $order = Order::findOrFail($orderId);
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            if($locale=='ar'){
                return redirect('admin/orders/'.$orderId)->with('message','تم إرسال الفاتوره عبر البريد الى '.$order->email);
            }
            return redirect('admin/orders/'.$orderId)->with('message','Invoice Mail has been sent to '.$order->email);


        }catch(\Exception $e){
            return redirect('admin/orders/'.$orderId)->with('message','Somthin Went Wrong!!');

        }


   }

}
