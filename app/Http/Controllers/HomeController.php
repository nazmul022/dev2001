<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Order;
use App\Product;
use App\Imports\CategoryImport;
use Carbon\Carbon;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
// use App\Http\Controllers\Controller;
use App\Comment;
use Auth;
use App\Review;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

        // $today = Order::wheredate();
    {
        $today = Order::wheredate('created_at', Carbon::now())->count();
        $eightdays_ago = Order::wheredate('created_at', Carbon::now()->subDays(8))->count();
        $yesterday = Order::wheredate('created_at', Carbon::yesterday())->count();
        return view('backend.dashboard',[
            'today' => $today,
            'eightdays_ago' => $eightdays_ago,
            'yesterday' => $yesterday
        ]);
    }
    function users(){
        $user_count = User::count();
        $users = User::orderBy('name','asc')->paginate(3);
        return view('backend.users.users',[
            'users' => $users,
            'user_count' => $user_count
        ]);
    }
    function Orders(){

        return view('backend.orders.orders',[
            'orders'=> Order::latest()->paginate(),
        ]);
    }
    function ExcelDownload(){
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function import(Request $request)
    {

        Excel::import(new  CategoryImport,  $request->file('excel'));

        return redirect('/')->with('success', 'All good!');
    }
    function SelectedDateExcelDawnload(Request $request){
        Order::all();
        $from = $request->start;
        $to = $request->end;

        return  Excel::download(new OrderExport($from, $to), 'orders.xlsx');
    }
    // function SelectedDateExcelDawnload(Request $request){
    // $start = $request->start;
    // $end = $request->end;
    // $reservations = Order::wherebetween('created_at', [$start, $end])->get();
    // return $reservations;

    // }
    function PdfDownload(){
        $orders = Order::all();
        $pdf = Pdf::loadView('exports.pdf',[
            'orders' => $orders
        ]);
        return $pdf->download('invoice.pdf');
    }
    function Comments(Request $request){
        $request->all();
        $comments = new Comment;
        $comments->blog_id = $request->blog_id;
        $comments->user_id = Auth::id();
        $comments->name = $request->name;
        $comments->email = $request->email;
        $comments->status = 2;
        $comments->comment = $request->comment;
        $comments->save();
        return back();
    }
    function UserReview(Request $request){
        if (Review::where('user_id',Auth::id())->where('product_id', $request->product_id)->exists()) {
            return "User already exists comment.";
        } else {
            $reviews = new Review;
            $reviews->user_id = Auth::id();
            $reviews->product_id = $request->product_id;
            $reviews->rating = $request->rating;
            $reviews->name = $request->name;
            $reviews->email = $request->email;
            $reviews->massage = $request->massage;
            $reviews->save();
            return back();
        }
    }
}
