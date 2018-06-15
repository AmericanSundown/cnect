@extends('layout.base')

@section('content')
    <div class="flex justify-center text-3xl mb-2 mt-2">
        R3 Scoreboard
    </div>


    <current-match></current-match>


    <div class="container mx-auto">


        <table class="table">
            <thead class="bg-blue text-white">
            <tr>

                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Right Winner & Right Score</th>
                <th scope="col">Right Winner & Right Score Difference</th>
                <th scope="col">Right Winner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)

                <tr class="{{$member->css()}}">
                    <td>{{$member->rank}}</td>
                    <td>
                        <div class="flex">
                            @if($member->type == "Robot")
                                <div class="leading-none mr-2">
                                    <img src="{{asset('img/robot24.png')}}" height="20px" alt=""/>
                                </div>
                            @endif
                            <div class="align-bottom">
                                {{$member->nickname}}
                            </div>
                        </div>


                    </td>
                    <td>{{$member->total}}</td>
                    <td>{{$member->score1}}</td>
                    <td>{{$member->score2}}</td>
                    <td>{{$member->score3}}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <div class="float-right mb-8">
            Updated {{$updated_at}}
        </div>
    </div>
@endsection