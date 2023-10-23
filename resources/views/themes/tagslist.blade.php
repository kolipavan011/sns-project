@extends('themes.layout')

@section('content')
<div class="my-4">
    <div class="mb-4">
        <header>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tag</li>
                </ol>
            </nav>
            <h1 class="mb-3">Explore Whatsapp Status Videos Tags</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita quaerat officia eaque, molestias, neque adipisci aperiam officiis harum molestiae repudiandae porro accusamus quibusdam, illo quod hic deleniti voluptas maxime.</p>
        </header>
    </div>
    <div class="entries__section mb-4">
        <div class="row @if(count($posts) > 0) d-flex row-cols-1 g-3 row-cols-md-2 @endif">
            @forelse ($posts as $post)
            <div class="col">
                <div class="card">
                    @isset($post->featured_image)
                    <a href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                        <img width="300px" height="200px" src="{{ asset($post->featured_image) }}" class="card-img-top featured__image" alt="{{ $post->title }}">
                    </a>
                    @endisset
                    <div class="card-body">
                        <a class="text-decoration-none text-dark" href="{{ route('tag.single',['slug'=> $post->slug]) }}">
                            <h2 class="card-title h4">{{$post->meta['title']}}</h2>
                        </a>
                        <p class="card-text">{{$post->summary}}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">No posts found</h5>
                        <p class="card-text">No posts found here. Stay tooned for new update till explore new whatsapp status videos</p>
                        <a href="/" class="btn btn-primary">Go To Home</a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <div class="pagination__section">
        {{ $posts->onEachSide(1)->links() }}
    </div>
</div>
@endsection