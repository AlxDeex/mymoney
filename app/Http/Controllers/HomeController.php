<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;

class HomeController extends Controller
{
    const TYPE_SPEND = 1;
    const  TYPE_GAIN = 2;

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
     * @return \Illuminate\Http\Response
     */

    public function spend()
    {
        return view('spend_gain', $this->prepareData(self::TYPE_SPEND));
    }

    public function gain()
    {
        return view('spend_gain', $this->prepareData(self::TYPE_GAIN));
    }

    protected function prepareData($type = self::TYPE_SPEND)
    {
        $transactions = [];

        $sheet = [
            self::TYPE_SPEND => 0,
            self::TYPE_GAIN => 0,
        ];

        foreach (Transaction::where('user_id', Auth::id())->get() as $transaction) {
            $sheet[$transaction['type']] += $transaction['sum_amount'];
            if ($transaction['type'] == $type) {
                $transactions[$transaction['category_id']]['items'][] = $transaction;
                if (!isset($transactions[$transaction['category_id']]['sum'])) {
                    $transactions[$transaction['category_id']]['sum'] = $transaction['sum_amount'];

                } else {
                    $transactions[$transaction['category_id']]['sum'] += $transaction['sum_amount'];

                }
            }
        }

        return [
            'type' => $type,
            'categories' => Category::where('type', $type)->orderBy('name')->get(['id', 'name'])->keyBy('id'),
            'transactions_by_category' => $transactions,
            'sheet' => $sheet,
        ];

    }
}
