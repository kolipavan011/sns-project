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
                            <h3 class="card-title h3">{{$post->title}}</h3>
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
                        <a href="/" class="btn btn-primary">Go To Home</a>
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
    <div class="google-auto-placed ap_container" style="width: 100%; height: auto; clear: both; text-align: center;"><ins data-ad-format="auto" class="adsbygoogle adsbygoogle-noablate" data-ad-client="ca-pub-9218152737562513" data-adsbygoogle-status="done" style="display: none !important; margin: auto; background-color: transparent; height: 0px;" data-ad-status="unfilled">
            <div id="aswift_1_host" tabindex="0" title="Advertisement" aria-label="Advertisement" style="border: none; height: 0px; width: 1140px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block; overflow: hidden; opacity: 0;"><iframe id="aswift_1" name="aswift_1" style="left:0;position:absolute;top:0;border:0;width:1140px;height:280px;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" width="1140" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-9218152737562513&amp;output=html&amp;h=280&amp;adk=1360242989&amp;adf=63614531&amp;pi=t.aa~a.2222670022~i.19~rp.4&amp;w=1140&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1697702453&amp;num_ads=1&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=2386978450&amp;ad_type=text_image&amp;format=1140x280&amp;url=https%3A%2F%2Fstorynstatus.test%2F&amp;fwr=0&amp;pra=3&amp;rh=200&amp;rw=1140&amp;rpe=1&amp;resp_fmts=3&amp;wgl=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiNi4wLjAiLCJ4ODYiLCIiLCIxMDMuMC40OTI4LjM0IixbXSwwLG51bGwsIjY0IixbWyJPcGVyYSIsIjEwMy4wLjQ5MjguMzQiXSxbIk5vdDtBPUJyYW5kIiwiOC4wLjAuMCJdLFsiQ2hyb21pdW0iLCIxMTcuMC41OTM4LjE1MCJdXSwwXQ..&amp;dt=1697702453203&amp;bpp=3&amp;bdt=8820&amp;idt=3&amp;shv=r20231011&amp;mjsv=m202310120101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3Dff09f63d6d3942d6-22a7b158f9e300a7%3AT%3D1695376610%3ART%3D1697702451%3AS%3DALNI_MZgUyAmTPBs6Wo-Ibjb2nPzFBeitw&amp;gpic=UID%3D00000c525979c109%3AT%3D1695376610%3ART%3D1697702451%3AS%3DALNI_Mba_d3m7iC3rAd7fnFsnPD7kwUqlQ&amp;prev_fmts=0x0&amp;nras=2&amp;correlator=2767244063600&amp;frm=20&amp;pv=1&amp;ga_vid=276064108.1695376608&amp;ga_sid=1697702452&amp;ga_hid=1799799965&amp;ga_fc=1&amp;u_tz=330&amp;u_his=2&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=4&amp;adx=-12245933&amp;ady=-12245933&amp;biw=1349&amp;bih=644&amp;scr_x=0&amp;scr_y=0&amp;eid=44759875%2C44759926%2C31077327%2C31078830%2C44805112%2C44805534%2C44805681%2C31078301%2C44806141&amp;oid=2&amp;pvsid=4063456310125063&amp;tmod=1768777068&amp;uas=0&amp;nvt=1&amp;fc=1408&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1364%2C644&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=32896&amp;bc=31&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;xpc=yvzdvGfPev&amp;p=https%3A//storynstatus.test&amp;dtd=19" data-google-container-id="a!2" data-google-query-id="CLXd1rzSgYIDFYHDfAodshsBUA" data-load-complete="true"></iframe></div>
        </ins></div>
    <br>
    <p>This website isn't Affiliated to Whatsapp Inc. in any manner. There are no any copyrights for sharing or set a status video to social media applications. So, freely share video, quotes, status with your friends, lovers, etc and enjoy!</p>
</div>
@endsection