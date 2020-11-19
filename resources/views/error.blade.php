@extends('base')

@section('code', $exception->getCode())
@section('title', __('Error' . ': ' . $exception->getCode() ))

@section('content')
    <div class="return">
        <button type="button" class="btn btn-dark">
            <a href="{{ route('create') }}">Return</a>
        </button>
    </div>

<div class="error">
    <h1>Code: {{ $exception->getCode() }}</h1>
</div>
    <div style="align-self: center">
        <h3>
            An error has occurred please try again later.
        </h3>
    </div>
@endsection
