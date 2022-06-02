<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerQuestion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerQuestionController extends Controller
{
    //admin 
    public function adminView()
    {
        return view('admin.customer.customer-question');
    }

    public function adminReply($id)
    {
        $question = CustomerQuestion::where('id', $id)->with('user', 'product.productImage')->first();
        return view('admin.customer.reply', compact('question'));
    }

    public function reply(CustomerQuestion $id, Request $request)
    {
        $request->validate([
            'reply' => 'required|max:255'
        ]);
        $id->update([
            'reply' => $request->reply
        ]);
        return redirect(route('customerQuestion.adminView'));
    }

    public function massDelete(Request $request)
    {
        $ids = $request->get('ids');
        $questions = CustomerQuestion::whereIn('id', $ids)->get(['id']);
        foreach ($questions as $order) {
            $order->delete();
        }
        Alert::toast('Removed', 'success');
        return redirect(route('customerQuestion.adminView'));
    }

    //for users
    public function index()
    {
        $questions = auth()->user()->questions()->with('product')->paginate(20);
        return view('admin.customer-question.index')->with([
            'questions' => $questions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'question' => 'required|max:255'
        ]);
        auth()->user()->questions()->create([
            'product_id' => $request->product_id,
            'question' => $request->question
        ]);
        Alert::toast('Question sent', 'success');
        return redirect(route('customerQuestion.index'));
    }

    public function destroy($id)
    {
        auth()->user()->questions()->where('id', $id)->delete();
        Alert::toast('Deleted!', 'success');
        return redirect(route('customerQuestion.index'));
    }
}
