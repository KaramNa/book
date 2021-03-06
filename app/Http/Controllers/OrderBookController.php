<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class OrderBookController extends Controller
{
    public function index()
    {
        return view("order-book");
    }

    public function showOrders()
    {
        $suggestions = Suggestion::all();
        return view("show-orders",[
            "suggestions" => $suggestions
        ]);
    }

    public function store()
    {
        $details = request()->validate([
            "book_name" => "required",
            "book_url" => "required",
            "orderer_name" => "required",
            "orderer_email" => "required|email",
        ]);

        $details["notes"] = request("notes");

        if (Suggestion::create($details))
            return back()->with("success", "Thank you, Your order has been submit successfully");
        else
            return back()->with("failed","Sorry, something got wrong please try again");
    }

    public function delete($id){
        $suggestion = Suggestion::find($id);
        $suggestion->delete();
        return back();
    }
    public function done($id){
        $suggestion = Suggestion::find($id);
        $suggestion->update(["status" => 1]);
        return back();
    }
}
