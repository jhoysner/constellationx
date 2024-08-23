<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Payment::paginate(10); // Asumiendo que tienes un modelo Transaction
        return view('payments.index', compact('transactions'));
    }


    public function graficos()
    {

        $mostSoldProducts = Product::leftJoin('payments', 'products.id', '=', 'payments.product_id')
            ->select('products.id', 'products.name', DB::raw('count(payments.id) as total'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total', 'asc')
            ->get();

        $dailyIncome = Payment::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $weeklyIncome = Payment::select(DB::raw('YEARWEEK(created_at) as week'), DB::raw('sum(amount) as total'))
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->get();

        $monthlyIncome = Payment::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('sum(amount) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('graficos.index', compact('mostSoldProducts', 'dailyIncome', 'weeklyIncome', 'monthlyIncome'));
    }

    public function top()
    {
        $topClient = Payment::join('users', 'payments.user_id', '=', 'users.id')
        ->select('users.name','users.id', DB::raw('count(payments.id) as total'))
        ->groupBy('users.id', 'users.name')
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();

        return view('top.index', compact('topClient'));
    }
}
