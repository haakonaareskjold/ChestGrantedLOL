@extends('base')
@section('title', $name)

@section('content')
    <x-return-home />
    </div>
    <div class="item"><h1>Chests available for: {{ $name }}</h1></div>
    <div class="item"><h1>amounts of chests: {{ count($available)}}</h1></div>
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
