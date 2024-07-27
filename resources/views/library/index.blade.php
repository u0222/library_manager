@extends('main')
@include('sidebar')
@include('footer')
@section('contents')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle"></button>
            <span class="navbar-brand" id="page-title">Book List</span>
        </div>
    </div>
</nav>
<div id="area-book-list" class="area content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Library</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                            </thead>
                            <tbody>
                                @foreach($libraries as $library)
                                    <tr class="">
                                        <td>{{ $library->id }}</td>
                                        <td>{{ $library->name }}</td>
                                        @if($library->user_id === 0)
                                            <td>
                                                <a class="btn btn-info" href="{{ url('library/borrow/'. $library->id) }}">brrow</a>
                                            </td>
                                        @elseif($library->user_id === Auth::user()->id)
                                            <td>
                                                <form action="{{ url('library/return') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">return</button>
                                                    <input type="hidden" name="id" value="{{ $library->id }}">
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <button class="btn btn-success" type="button" disabled>borrowing</button>
                                            </td>
                                        @endif
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
@endsection