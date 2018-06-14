<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div>
    <div class="flex justify-center text-3xl">
        R3 Scoreboard
    </div>
    <div class="container mx-auto">

        <table class="table">
            <thead class="bg-blue text-white">
            <tr>

                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Right Winner & Right Score</th>
                <th scope="col">Right Winner & Right Score Difference</th>
                <th scope="col">Right Winner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{$member->nickname}}</td>
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




</div>
</body>
</html>
