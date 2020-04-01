<html lang="en">
<header>
    <link href="{!! asset('css/app.css') !!}" rel="stylesheet">
</header>
<body>
<div class="container">
    <h1>Posts</h1>
    @foreach($posts as $post)
        <div class="row">
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->format('d/m/Y H:i') }}</h6>
                        <p>{{ $post->excerpt }}</p>
                        <a href="#" class="card-link">read more</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
