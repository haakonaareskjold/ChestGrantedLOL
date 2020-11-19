@extends('base')

@section('code', $exception->getCode())
@section('title', __('Error' . ': ' . $exception->getCode() ))

@section('content')
    <x-return-home />

<div class="info">
    <h1>Code: {{ $exception->getCode() }}</h1>
</div>
    <div style="align-self: center">
        <h3>
            An error has occurred please try again later.
        </h3>
    </div>
@endsection
