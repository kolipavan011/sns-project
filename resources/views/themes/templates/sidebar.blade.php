<aside id="sidebar" class="my-4">
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">Category</h2>
        @php
        $category = App\Models\Category::query()->latest()->get(['slug','title']);
        @endphp
        <div class="widget__content">
            @forelse ($category as $cat)
            <a href="{{ route('cat.single',['slug'=>$cat->slug]) }}" title="{{ $cat->title }}" type="button" class="btn btn-primary mb-2">{{ $cat->title}}</a>
            @empty
            <div class="my-4 text-secondary">
                <p>There’s no content to show here yet.</p>
            </div>
            @endforelse
        </div>
    </div>
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">Tags</h2>
        @php
        $tags = App\Models\Tag::query()->latest()->get(['slug','title']);
        @endphp
        <div class="widget__content">
            @forelse ($tags as $tag)
            <a href="{{ route('tag.single',['slug'=>$tag->slug]) }}" type="button" class="btn btn-primary mb-2" title="{{ $tag->title }}">{{ $tag->title}}</a>
            @empty
            <div class="my-4 text-secondary">
                <p>There’s no content to show here yet.</p>
            </div>
            @endforelse
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
                    <a class="text-dark fs-6" href="/pages/disclaimer">Disclaimer</a>
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