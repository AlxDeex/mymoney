@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                        <ul class="nav nav-pills pb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="/home/spend">Расходы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/gain">Доходы</a>
                            </li>
                        </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="modal {{ $errors->any() ? 'modal-error' : '' }}" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form class="add-spend-gain" action="/transaction/add" method="post" >
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
                                                <input id="date-spend-gain" name="date" type="text" readonly class="form-control datepicker"  value="{{ date('d.m.Y') }}">

                                                <label for="sum-spend-gain">сумма</label>
                                                <input id="sum-spend-gain" name="sum" type="text" class="form-control" placeholder="Например 1000"  value="">

                                                <label for="comment-spend-gain">Комментарий</label>
                                                <input id="comment-spend-gain" name="comment" type="text" class="form-control"  value="">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                            <input type="submit" class="btn btn-primary" value="Сохранить">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                        <div class="col-4 col-sm-2"><button type="button" class="btn btn-primary col-sm-12">Авто</button></div>
                        <div class="col-8 col-sm-10">
                            <div class="progress" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="progress-bar  progress-bar-striped" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="position-absolute w-100 text-center text-white">50%</div>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="collapse col-sm-10" id="collapseExample">
                            <div class="card card-body border-top-0 rounded-0">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col-4 col-sm-2"><button type="button" class="btn btn-primary col-sm-12">Авто</button></div>
                        <div class="col-8 col-sm-10">
                            <div class="progress" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="progress-bar  progress-bar-striped" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="position-absolute w-100 text-center text-white">50%</div>
                            </div>
                            <div class="collapse " id="collapseExample">
                                <div class="card card-body border-top-0 rounded-0">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <button type="button" class="btn btn-primary col-12" data-toggle="modal" data-target="#addModal">Добавить</button>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 col-sm-8 col-sm">
                            <table class="table col-12 text-primary">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col" class="text-black-50">ИТОГИ</th>
                                    <th scope="col">Всего</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Расходы</th>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <th scope="row">Доходы</th>
                                    <td>Thornton</td>
                                </tr>
                                <tr>
                                    <th scope="row">Баланс</th>
                                    <td>the Bird</td>
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
