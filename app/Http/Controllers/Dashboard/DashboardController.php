<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;

use App\Models\Client;
use App\Models\category;
use App\Models\Products;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index():View
    {
        // $categories_count = category::count();
        // $products_count = Products::count();
        // $clients_count = Client::count();
        // $users_count = User::whereHasRole('admin')->count();
        // $sales_data=Order::select(
        //     DB::raw('YEAR(created_at) AS year'),
        //     DB::raw('MONTH(created_at) AS month'),
        //     DB::raw('sum(total_price) as sum')
        //  )->groupBy('MONTH')->get();

        //  dd($sales_data);


        return view("dashboard.welcome");
    }
}
