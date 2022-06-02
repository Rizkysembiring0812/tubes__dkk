@extends('layouts.app')

@section('page-title', 'My Wishlist')

@section('content')
    <br><br>
    <div class="container">
        <div class=" row">
            <div class="col-xl-2 col-md-2 col-sm-12 ml-auto">
                @include('inc.app.user-sidebar')
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Wishlist</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlist as $item)
                                            <tr>
                                                <td>{{ $item->product->title }}</td>
                                                <td>{{ $item->product->price }}</td>
                                                <td>
                                                    <form action="/wishlist/{{ $item->id }}/destroy" method="GET">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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

