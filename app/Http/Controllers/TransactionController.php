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

        if ($validated['type'] == HomeController::TYPE_SPEND) {
            return redirect()->to('/home/spend');
        } else {
            return redirect()->to('/home/gain');
        }

    }


    /**
     * @param $transaction_id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($transaction_id, $type)
    {
        Transaction::where(['id' => $transaction_id, 'user_id' => Auth::id()])->delete();

        if ($type == HomeController::TYPE_SPEND) {
            return redirect()->to('/home/spend');
        } else {
            return redirect()->to('/home/gain');
        }
    }
}
