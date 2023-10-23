@extends('themes.layout')

@section('hero')
<div class="container-fluid">
    <div class="row bg-primary">
        <div class="col-12">
            <di class="d-flex justify-content-center">
                <header class="hero__section">
                    <h1 class="mb-4">Explore Quotes, Shayari and Status</h1>
                    <p>Welcome to our Quote, Shayari and Status Website! We have inspiring quotes to lift your spirits and motivate you, Shayari to express your feeling and Status for share emotion on social media. Explore our collection, find daily inspiration and share the power of words with others. Let's explore on this collection of enlightenment together!</p>
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
                        <p class="card-text">{{ $post->summary }}</p>
                    </div>
                </div>
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
    <h2 class="h3">Storynstatus: Best Whatsapp Status, Quotes and 30sec status video</h2>
    <p>In this 21st century, Social media is the most important part of our life. We keep sharing all kind of moment and feeling in Whatsapp, Facebook, Instagram, etc. People are generally express their mood and feeling like Happy, In Love, Sad - lonely, Friendship, Motivation, Cool, Funny, etc..etc. <a title="Whatsapp status" href="https://storynstatus.test/status/">Text status</a> is good for unwinding your feelings, Images status is thousand times good. So that way expressing feeling through lyrical videos are millions of million time better to express status lovers feeling. In this mindset, we developed the beautiful and unique collection of <a title="whatsapp video status" href="https://storynstatus.test/video/">best WhatsApp video song status</a>.</p>
    <br>
    <h3>30-second Status Video Download for Whatsapp</h3>
    <p>The WhatsApp status video is in trend these days, lots of young boy/girls are searching out the best Whatsapp status videos download. As we recognize that 30 seconds short video status is a craze amongst Indian adolescents and as spreading 30sec. video status in Whatsapp, we create this beautiful website has to video status categories like video status for <a title="Love video status" href="https://storynstatus.test/video/love-whatsapp-status-video">cute love</a>, <a title="Sad video status" href="https://storynstatus.test/video/sad-alone-status-video-wp">Breakup/sad WhatsApp video status</a>, <a title="Motivation video status" href="https://storynstatus.test/video/god-whatsapp-status-video">Motivational/God</a> 30 sec video status, short funny moment videos for sharing in Whatsapp and Facebook.</p>
    <br>
    <h3>Best DP Quotes download in hindi, gujarati, english</h3>
    <p><a title="best dp quotes images" href="https://storynstatus.test/quotes/">Quote Images</a> are effective and also helpful for us. Motivational quotes and <a title="best suvichar quotes images" href="https://storynstatus.test/quotes/best-suvichar-quotes">Suvichar</a> sayings have brilliant potential to change the manner we feel about life. This is why we locate them so thrilling and important on our ways to achievement. At <a title="best quotes" href="https://storynstatus.test/quotes/">storynstatus.test/quotes/</a> you will find various categories of quotes images which best includes in morning Suvichar quotes, Hindi Funny saying quotes, <a href="https://storynstatus.test/quotes/love-shayari-quotes" title="shayri quotes images">shayri images</a>, love-sad quotes image and much other rest of quotes. So, our team creates this quote image for you. </p>
    <br>
    <p>Indian people are always joyful in all festivals celebrations so they find most of the related best whatsapp status, quotes, and images. So mainly we baked this whole content for you as useful blog-post. Keep your all cheers with us and find good dp quote images and free download at Video Song Status.</p>
    <p>This website isn't Affiliated to Whatsapp Inc. in any manner. There are no any copyrights for sharing or set a status video to social media applications. So, freely share video, quotes, status with your friends, lovers, etc and enjoy!</p>
</div>
@endsection