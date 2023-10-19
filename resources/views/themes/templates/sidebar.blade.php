<aside class="my-4">
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
                    <a class="text-dark fs-6">Privacy Policy</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6">Term & Condition</a>
                </li>
                <li class="list-group-item border-0 px-0">
                    <a class="text-dark fs-6">DMCA policy</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar__widget mb-4">
        <h2 class="widget__title mb-3">About</h2>
        <ul class="list-group list-group-flush">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus nam optio debitis obcaecati amet eveniet, eos recusandae suscipit ratione molestias hic officia pariatur at quisquam adipisci! Blanditiis dignissimos soluta quae.</p>
    </div>
    </div>
</aside>