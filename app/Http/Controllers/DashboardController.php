<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $itemCount = Item::count();
        $totalPurchases = Purchase::sum('amount');

        // Calculate the number of times each item has been sold
        $itemsSoldCount = Item::leftJoin('purchases', 'items.id', '=', 'purchases.item_id')
            ->select('items.id', 'items.item_name', 'items.price', DB::raw('count(purchases.id) as sold_count'))
            ->groupBy('items.id', 'items.item_name', 'items.price')
            ->get();

        return view('dashboard', compact('userCount', 'itemCount', 'totalPurchases', 'itemsSoldCount'));
    }
}
