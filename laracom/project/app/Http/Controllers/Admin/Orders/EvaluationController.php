<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Shop\Products\Evaluation;
use App\Shop\Products\Requests\EvaluatedRequest;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Evaluation モデルを使用して全ての評価を取得
        $evaluations = Evaluation::all();

        // 評価の一覧を表示するビューへデータを渡す
        return view('admin.orders.evaluations.index', compact('evaluations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EvaluatedRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(EvaluatedRequest $request)
    {
        $productId = $request->input('product');
        $customerId = auth()->user()->getAuthIdentifier();
        $evaluat = $request->input('evaluat');
        $comment = $request->input('comment');
        $data = [
            'product_id' => $productId,
            'customer_id' => $customerId,
            'evaluat' => $evaluat,
            'comment' => $comment
        ];
        
        Evaluation::create($data);

        session()->flash('success', '評価とコメントを登録しました');
        return back();
    }

    // 他のリソースコントローラーメソッド (show, edit, update, destroy) があればここに追加
}
