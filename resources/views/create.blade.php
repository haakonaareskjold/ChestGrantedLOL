@extends('base')

@section('content')
    <div class="item">
    <h3>Submit your summoner ID here:</h3>
    </div>
    <div class="form">
    <form method="POST" enctype="multipart/form-data" action="{{ route('store') }}">
        @csrf
        <label>
            <input type="text" class="form-control" name="username" autocomplete="off" autofocus required placeholder="username">
        </label>

        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="server" value="euw1"  autocomplete="off" checked>EUW
            </label>

            <label class="btn btn-secondary">
                <input type="radio" name="server" value="na1" autocomplete="off">NA
            </label>
        </div>
        <div class="item">
        <button class="btn btn-primary btn-lg" type="submit" formmethod="POST">Submit</button>
        </div>
    </form>
    <p style="color: red">@error('username') {{$message}} @enderror</p>
    <p style="color: red">@error('server') {{$message}} @enderror</p>
    </div>

    <div class="info">
        <h5>
            Submit in your Summoner ID to see how many chests you have available left this season.
            <br>
            <br>
            The API may show  incorrectly if:<br>
            1. You do not own every champion.<br>
            2. You have not played every champion at least once, ever.<br>
        </h5>
    </div>
@endsection
