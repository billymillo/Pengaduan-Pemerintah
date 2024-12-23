@extends('layout.index')

@section('content')
<div class="">
    <div class="flex justify-center items-center w-full h-screen">
        <div class="container px-4 mx-auto">
            <div class="p-6 m-20 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    </div>
</div>
@endsection
