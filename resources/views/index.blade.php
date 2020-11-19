@extends('base')
@section('title', $name)

@section('content')
    <x-return-home />

    <div class="item"><h1>Summoner: {{ $name }}</h1></div>
    <div class="item"><h1>Chests Available: {{ count($available)}}</h1></div>
    <div class="item">
    @foreach( $content['data'] as $data)
        @foreach($available as $item)
            @if($data['key'] == $item['championId'])
                 <img src="{{ $img . $data['id'] . ".png" }}">
            @endif
        @endforeach
    @endforeach
    </div>
@endsection
