@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{$type == 1 ? 'active' : ''}}" href="/home/spend">Расходы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{$type == 2 ? 'active' : ''}}" href="/home/gain">Доходы</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="modal {{ $errors->any() ? 'modal-error' : '' }}" id="addModal" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @if ($errors->any())
                                        <div class="errors col-12">
                                            <ul class="list-unstyled">
                                                @foreach($errors->all() as $error)
                                                    <li class="text-danger">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="add-spend-gain" action="/transaction/add" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="type" value="{{ $type }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="category-spend">Категория</label>
                                                <select class="form-control" name="category" id="category-spend">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="date-spend-gain">Дата</label>
                                                <input id="date-spend-gain" name="date" type="text" readonly
                                                       class="form-control datepicker" value="{{ date('d.m.Y') }}">

                                                <label for="sum-spend-gain">сумма</label>
                                                <input id="sum-spend-gain" name="sum" type="text" class="form-control"
                                                       placeholder="Например 1000" value="">

                                                <label for="comment-spend-gain">Комментарий</label>
                                                <input id="comment-spend-gain" name="comment" type="text"
                                                       class="form-control" value="">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Отмена
                                            </button>
                                            <input type="submit" class="btn btn-primary" value="Сохранить">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @if (isset($transactions_by_category) && count($transactions_by_category) > 0)
                            @foreach($transactions_by_category as $id_category => $transactions)
                                <div class="row pb-3">
                                    <div class="col-4 col-sm-2">
                                        <button type="button"
                                                class="btn btn-primary col-sm-12">{{ $categories[$id_category]['name'] }}</button>
                                    </div>
                                    <div class="col-8 col-sm-10">
                                        <div class="progress position-relative" data-toggle="collapse" href="#category{{ $id_category }}"
                                             role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="progress-bar  progress-bar-striped" role="progressbar"
                                                 style="width: {{ ceil($transactions['sum'] / ($sheet[$type] / 100)) }}%"
                                                 aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                            <div class="progress-sum position-absolute w-100 text-center text-black-50">{{ $transactions['sum'] }}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="collapse col-sm-10" id="category{{ $id_category }}">
                                        <div class="card card-body border-top-0 rounded-0 transactions">
                                            <table class="table col-12 text-primary">
                                                <thead class="text-primary">
                                                <tr>
                                                    <th scope="col">Сумма</th>
                                                    <th scope="col">Комментарий</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($transactions['items'] as $transaction)
                                                    <tr class="transaction text-black-50" title="{{ date('d.m.Y', strtotime($transaction['date'])) }}"
                                                    data-date="{{ date('d.m.Y', strtotime($transaction['date'])) }}">
                                                        <td>{{ $transaction['sum_amount'] }}</td>
                                                        <td>{{ $transaction['comment'] }}
                                                            <a type="button" class="close bg-danger del-transaction" href="/transaction/del/{{ $transaction['id'] }}/{{ $type }}">
                                                                <span aria-hidden="true">&times;</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-12 col-sm-3">
                                <button type="button" class="btn btn-primary col-12" data-toggle="modal"
                                        data-target="#addModal">Добавить
                                </button>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 col-sm-8 col-sm">
                                <table class="table col-12 text-primary">
                                    <thead class="bg-primary text-white">
                                    <tr>
                                        <th colspan="2" scope="col">ИТОГО</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Доходы</th>
                                        <td class="text-success">{{ $sheet[2] }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Расходы</th>
                                        <td class="text-danger">{{ $sheet[1] }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Баланс</th>
                                        <td class="{{ $sheet[2] - $sheet[1] < 0 ? 'text-danger' : 'text-success'  }}">{{ $sheet[2] - $sheet[1] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
