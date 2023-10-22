@extends('themes.layout')

@section('content')
<div class="my-4">
    <div class="mb-4">
        <header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>
            <h1 class="mb-3">Explore Latest Whatsapp Status Videos</h1>
            <p>Explore our collection of Latest Whatsapp Status, find daily inspiration and share the power of words with others. Whatsapp Status Video to express your feeling and Status for share emotion</p>
        </header>
    </div>
    <div class="entries__section mb-4">
        <div class="row d-flex gy-3 row-cols-1 row-cols-sm-2 row-cols-md-2">
            @foreach ($posts as $post)
            <div class="col">
                <div class="card">
                    @isset($post->featured_image)
                    <a href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                        <img width="300px" height="200px" src="{{ asset($post->featured_image) }}" class="card-img-top featured__image" alt="{{ $post->title }}">
                    </a>
                    @endisset
                    <div class="card-body">
                        <a class="text-decoration-none text-dark" href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                            <h2 class="card-title h4">{{$post->title}}</h2>
                        </a>
                        <p class="card-text">{{$post->summary}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="pagination__section">
        {{ $posts->onEachSide(1)->links() }}
    </div>
</div>
@endsection