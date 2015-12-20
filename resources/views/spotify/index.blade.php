@extends('welcome')

@section('content')

<table>
    <thead>
        <tr>
            <td>
            Artist
            </td>
            <td>
            Song
            </td>
            <td>
            Actions
            </td>
        </tr>
    </thead>
    @foreach ($array as $track)
    <tr>
    <td>
        {{$track['track']['artists'][0]['name']}}
    </td>
    <td>
        {{$track['track']['name']}}
    </td>
    <td>
        <a href='/spotify/delete/{{$track['track']['uri']}}'>Delete</a>
    </td>
    </tr>
        @endforeach
</table>

@stop