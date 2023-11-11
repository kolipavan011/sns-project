@extends('themes.layout')

@section('hero')
<div class="container-fluid">
    <div class="row bg-primary">
        <div class="col-12">
            <di class="d-flex justify-content-center">
                <header class="hero__section">
                    <h1 class="mb-4">Whatsapp Status Video Download, Best Whatsapp Status Videos</h1>
                    <p>Welcome to our Whatsapp Status Video Website! We have inspiring Videos to lift your spirits and motivate you, Shayari Status Video to express your feeling and Whatsapp Status for share emotion on social media. Explore our collection, find daily inspiration and share the power of video status with others. Let's explore on this collection of enlightenment together!</p>
                </header>
            </di>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="my-4">
    <!-- Posts List-->
    <div class="entries__section mb-5">
        <div class="row @if(count($posts) > 0) d-flex row-cols-1 g-3 row-cols-md-2 @endif">
            @forelse ($posts as $post)
            <div class="col">
                <article id="post-{{$post->id}}">
                    <div class="card">
                        @isset($post->featured_image)
                        <a href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                            <img width="300px" height="200px" src="{{ asset($post->featured_image) }}" class="card-img-top featured__image" alt="{{ $post->title }}">
                        </a>
                        @endisset
                        <div class="card-body">
                            <header>
                                <a class="text-decoration-none text-dark" href="{{ route('posts.single',['slug'=> $post->slug]) }}">
                                    <h2 class="card-title h4">{{$post->title}}</h2>
                                </a>
                            </header>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">No posts found</h5>
                        <p class="card-text">No posts found here. Stay tooned for new update till explore new whatsapp status videos</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <div class="pagination__section mb-4">
        {{ $posts->onEachSide(1)->links() }}
    </div>
    <!-- Content -->
    <h2 class="h4">Storynstatus: Best Whatsapp Status Videos and Trending Status Video</h2>
    <p>In this 21st century, Social media is the most important part of our life. We keep sharing all kind of moment and feeling in Whatsapp, Facebook, Instagram, etc. People are generally express their mood and feeling like Happy, In Love, Sad - lonely, Friendship, Motivation, Cool, Funny, etc..etc. <a title="Whatsapp status video" href="https://storynstatus.com">Whatsapp status</a> is good for unwinding your feelings, Whatsapp Video status is thousand times good. So that way expressing feeling through love status videos are millions of million time better to express status lovers feeling. In this mindset, we developed the beautiful and unique collection of <a title="whatsapp video status videos" href="https://storynstatus.com">best WhatsApp video status</a>.</p>
    <br>
    <h2 class="h4">Trending Whatsapp Status Video Download</h2>
    <p>The WhatsApp status video is in trend these days, lots of young boy/girls are searching out the best Whatsapp status videos download. As we recognize that 30 seconds short video status is a craze amongst Indian adolescents and as spreading 30sec. video status in Whatsapp, we create this beautiful website has to video status categories like video status for love status video, sad status video, motivational status video, good night status video, good morning status video, 30 sec video status, short funny moment videos for sharing in Whatsapp and Facebook.</p>
    <br>
    <h2 class="h4">Whatsapp Status videos for daily</h2>
    <p>Motivational status video are effective and also helpful for us. Inspirational Status Video and sayings have brilliant potential to change the manner we feel about life.</p>
    <br>
    <p>Indian people are always joyful in all festivals celebrations so they find most of the related best whatsapp status video. So mainly we baked this whole content for you as useful blog-post. Keep your all cheers with us and find good free whatsapp status video download at <a href="storynstatus.com">storynstatus.com</a></p>
    <p>This website isn't Affiliated to Whatsapp Inc. in any manner. There are no any copyrights for sharing or set a status video to social media applications. So, freely share whatsapp video status with your friends, lovers, etc and enjoy!</p>
</div>
@endsection