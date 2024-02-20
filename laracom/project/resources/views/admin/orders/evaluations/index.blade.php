@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($evaluations)
            <div class="box">
                <div class="box-body">
                    <h2>レビュー</h2>
                    @include('layouts.search', ['route' => route('admin.evaluation.index')])
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">日時</td>
                                <td class="col-md-3">商品ID</td>
                                <td class="col-md-2">ユーザー(ID)</td>
                                <td class="col-md-2">評価</td>
                                <td class="col-md-2">コメント</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td>{{ date('Y年m月d日', strtotime($evaluation->created_at)) }}</td>
                                <td><a href="{{ route('admin.products.show', [$evaluation->product_id]) }}">{{ $evaluation->product_id }}</a></td>
                                <td><a href="{{ route('admin.customers.show', [$evaluation->customer_id]) }}">{{$evaluation->customer_name}}({{ $evaluation->customer_id }})</a></td>
                                <td>{{ $evaluation->evaluat }}</td>
                                <td>{{ $evaluation->comment }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection