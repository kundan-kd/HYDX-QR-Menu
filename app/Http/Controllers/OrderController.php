<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        return view('backend.modules.products.order_received');
    }
    public function orderReceivedList(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::select('*')->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('orderid', function ($row) {
                    return $row->orderid ?? '';
                })
                ->addColumn('item_name', function ($row) {
                    return $row->item_name ?? '';
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity ?? '';
                })
                ->addColumn('price', function ($row) {
                    return $row->price ?? '';
                })
                ->addColumn('total_price', function ($row) {
                    return $row->total_price ?? '';
                })
                ->addColumn('status', function ($row) {
                    return $row->status ?? '';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false"><i class="fe fe-more-vertical fs-16"></i></button>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:;" onclick="deleteOrder(' . $row->id . ')"><i class="bx bx-trash mr-1 text-danger"></i> Delete</a>
                            </ul>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy($id)
    {
        $subcatitem = Order::find($id);
        if (!empty($subcatitem)) {
            Order::find($id)->delete();
            return response()->json(['success' => 'Order Deleted Successfully']);
        } else {
            return response()->json(['error_success' => 'Error in deleting Order']);
        }
    }
}
