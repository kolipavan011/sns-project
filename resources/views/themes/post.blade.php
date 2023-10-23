@extends('themes.layout')

@section('content')
<div class="my-4">
    <article>
        <div class="article__header">
            <header>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/posts">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>
                <h1 class="mb-4">{{ $post->title }}</h1>
                <p>{{ $post->summary }}</p>
                <ul class="list-group list-group-horizontal flex-wrap">
                    <li class="list-group-item border-0 p-0">
                        @foreach ($post->category as $cat)
                        <a rel="tag" href="{{ route('cat.single',['slug'=>$cat->slug]) }}" class="badge bg-primary mb-1">{{$cat->title}}</a>
                        @endforeach
                    </li>
                </ul>
            </header>
        </div>
        <div class="videos__list my-4">
            <div class="row @if(count($videos) > 0) d-flex row-cols-1 g-3 row-cols-md-2 @endif">
                @forelse ($videos as $video)
                <div class="col">
                    <div class="card mb-4">
                        <figure class="mb-0">
                            <video class="article__video bg-light" src="{{ $video->path }}" controls preload="none" poster="{{ $video->preview }}"></video>
                        </figure>
                        <div class="card-body">
                            <a download class="btn btn-primary mb-3" href="{{ $video->path }}">Download Status Video</a>
                            <p>{{$video->name}}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">No Video found</h5>
                            <p class="card-text">No Video found here. Stay tooned for new update till explore new whatsapp status videos</p>
                            <a href="/" class="btn btn-primary">Go To Home</a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="video__pagination mb-4">
            <div class="d-flex justify-content-center">
                {{ $videos->links() }}
            </div>
        </div>
        <!-- similar videos related to tags -->
        <div class="post__tags mb-4">
            <h2 class="mb-3">{{$post->title}} Similar Whatsapp Status</h2>
            <p>This whatsapp status videos belongs to tags given below. Here you can get similar videos related to that tags. explore some of the best whats app videos.</p>
            <ul class="list-group list-group-horizontal flex-wrap">
                <li class="list-group-item border-0 p-0">
                    @foreach ($post->tags as $tag)
                    <a href="{{ route('tag.single',['slug'=>$tag->slug]) }}" class="btn btn-primary mb-2">{{$tag->title}}</a>
                    @endforeach
                </li>
            </ul>
            <div class="row d-flex row-cols-1 row-cols-md-2 g-3 mt-2">
                @foreach ($relatedTag as $post)
                <div class="col">
                    <div class="card">
                        @isset($post->featured_image)
                        <a href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                            <img width="300px" height="200px" src="{{ asset($post->featured_image) }}" class="card-img-top featured__image" alt="{{ $post->title }}">
                        </a>
                        @endisset
                        <div class="card-body">
                            <a class="text-decoration-none text-dark" href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                                <h3 class="card-title h3">{{$post->title}}</h3>
                            </a>
                            <p class="card-text">{{$post->summary}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- similar videos related to category -->
        <div class="post__tags mb-4">
            <h2 class="mb-3">Whatsapp status video Related to {{$post->title}}</h2>
            <p>Explore whatsapp status video related to {{$post->title}}. We hop you find best video status here.</p>
            <ul class="list-group list-group-horizontal flex-wrap">
                <li class="list-group-item border-0 p-0">
                    @foreach ($post->category as $cat)
                    <a href="{{ route('cat.single',['slug'=>$cat->slug]) }}" class="btn btn-primary mb-2">{{$cat->title}}</a>
                    @endforeach
                </li>
            </ul>
            <div class="row d-flex row-cols-1 row-cols-md-2 g-3 mt-2">
                @foreach ($relatedCat as $post)
                <div class="col">
                    <div class="card">
                        @isset($post->featured_image)
                        <a href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                            <img width="300px" height="200px" src="{{ asset($post->featured_image) }}" class="card-img-top featured__image" alt="{{ $post->title }}">
                        </a>
                        @endisset
                        <div class="card-body">
                            <a class="text-decoration-none text-dark" href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                                <h3 class="card-title h4">{{$post->title}}</h3>
                            </a>
                            <p class="card-text">{{$post->summary}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="article__content">
            {!! $post->body !!}
        </div>
    </article>
</div>
@endsection