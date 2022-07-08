@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Questa è la mia CRUD</h1>

    @if (session('post_cancellato'))
        <div class="alert alert-success" role="alert">
            {{session('post_cancellato')}}
        </div>
    @endif

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Categoria</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)

                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category ? $post->category->name : '-' }}</td>
                    <td><a class="btn btn-success" href="{{route('admin.posts.show', $post)}}">Show</a>
                        <a class="btn btn-primary" href="{{route('admin.posts.edit', $post)}}">Edit</a>
                        <form class="d-inline" action="{{route('admin.posts.destroy',$post)}}" method="POST" onsubmit="return confirm('confermi l\'eliminazione di :{{$post->title}}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </tr>

            @endforeach
        </tbody>
    </table>
    {{$posts->links()}}

    <div>
        @foreach ($categories as $category )
        <h2>{{$category->name}}</h2>
        <ul>
            @forelse ($category->posts as $post)
                <li>
                    <a href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a>
                </li>
            @empty
                <li>Non sono presenti post</li>
            @endforelse
        </ul>
        @endforeach
    </div>

</div>
@endsection
