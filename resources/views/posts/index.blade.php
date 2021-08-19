@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <th>
                <td>ID</td>
                <td>Title</td>
                <td>Body</td>
            </th>
            @forelse ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No post yet</td>
            </tr>
            @endforelse
        </table>
    </div>
@endsection
