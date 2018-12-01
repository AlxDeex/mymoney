<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\TransactionAdd;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    /**
     * @param TransactionAdd $request
     */
    public function create(TransactionAdd $request)
    {
        $validated = $request->validated();

        Transaction::create([
            'type' => $validated['type'],
            'account_id' => Account::where('user_id', Auth::id())->first()->id,
            'category_id' => $validated['category'],
            'user_id' => Auth::id(),
            'sum_amount' => floor($validated['sum'] * 100) / 100,
            'date' => date('Y-m-d', strtotime($validated['date'])),
            'comment' => $validated['comment'] ?: '',
        ]);

        if ($validated['type'] = HomeController::TYPE_SPEND) {
            return redirect()->to('/home/spend');
        } else {
            return redirect()->to('/home/gain');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

        //
    }
}
