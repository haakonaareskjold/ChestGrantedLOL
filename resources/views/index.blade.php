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
                <a href=https://euw.op.gg/champion/{{$data['id']}}/statistics/ target=_blank>
                     <img alt="{{ $data['name']}}" src="{{ $img . $data['id'] . ".png" }}" />
                    <span class="names border border-dark bg-dark rounded-lg">{{ $data['name'] }}</span>
                </a>
            @endif
        @endforeach
    @endforeach
    </div>
@endsection
