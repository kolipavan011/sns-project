<div class="header">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Storynstatus</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#websiteNavbar" aria-controls="websiteNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="websiteNavbar">
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" aria-current="page" href="/">Home</a>
                    </li>
                    @php
                    $category = App\Models\Category::query()
                    ->latest()
                    ->limit(5)
                    ->get(['slug','title']);
                    @endphp
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @foreach ($category as $item)
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" aria-current="page" href="#">{{$item->title}}</a>
                        </li>
                        @endforeach
                </div>
            </div>
        </nav>
    </header>
</div>