@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <form action="{{ route('home') }}" class="d-flex gap-1" method="GET">
                    <select name="rate" class="form-select w-auto">
                        <option value="all">All</option>
                        <option value="5" {{ $rateFilter == '5' ? 'selected' : '' }}>5 stars</option>
                        <option value="4" {{ $rateFilter == '4' ? 'selected' : '' }}>4 stars</option>
                        <option value="3" {{ $rateFilter == '3' ? 'selected' : '' }}>3 stars</option>
                        <option value="2" {{ $rateFilter == '2' ? 'selected' : '' }}>2 stars</option>
                        <option value="1" {{ $rateFilter == '1' ? 'selected' : '' }}>1 star</option>
                    </select>
                    <button type="submit" class="btn btn-outline-success">Filter</button>
                </form>
                <div class="text-success">
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="d-flex" width="120">Rate</th>
                            <th scope="col" width="120">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Experience</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>
                                    @for($i = 0; $i < $feedback->rate; $i++)
                                        <img src="{{ asset('img/star.png') }}" alt="">
                                    @endfor
                                </td>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ $feedback->experience }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $feedbacks->links('vendor.pagination.bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
