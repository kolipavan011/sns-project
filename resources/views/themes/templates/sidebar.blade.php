<aside id="sidebar" class="my-4">
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">Category</h2>
        @php
        $tags = App\Models\Tag::query()->latest()->get(['slug','title']);
        @endphp
        <div class="widget__content">
            @foreach ($tags as $tag)
            <a title="{{ $tag->title }}" type="button" class="btn btn-primary mb-2">{{ $tag->title}}</a>
            @endforeach
        </div>
    </div>
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">Tags</h2>
        <div class="widget__content">
            @foreach ($tags as $tag)
            <a type="button" class="btn btn-primary mb-2">{{ $tag->title}}</a>
            @endforeach
        </div>
    </div>
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">Pages</h2>
        <div class="widget__content">
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/posts">All Posts</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/category">All Category</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/tags">All Tags</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/pages/privacy-policy">Privacy Policy</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/pages/term-and-condition">Term & Condition</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6" href="/pages/dmca-policy">DMCA policy</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">About</h2>
        <ul class="list-group list-group-flush">
            <p><a href="/">STORYNSTATUS.COM</a> - Best Collection Status in Hindi, Latest Whatsapp Status, Motivational Status Video, fullscreen Whatsapp Status, Whatsapp Love Images, Hindi Whatsapp Status, Good Morning status Video and Whatsapp Status wishes, Good Night Status video Wishes.</p>
    </div>
    </div>
</aside>