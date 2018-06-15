@extends('layout.base')

@section('content')
    <div class="flex justify-center text-3xl mb-2 mt-2">
        Stats
    </div>
    <div class="container mx-auto flex justify-center">
    # of records: {{$total}}
    </div>
@endsection
