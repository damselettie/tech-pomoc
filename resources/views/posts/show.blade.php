<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
</head>
<body>

    <div>
        <!-- Prosty wybór języka -->
        <a href="{{ route('setLocale', ['locale' => 'pl']) }}">Polski</a> |
        <a href="{{ route('setLocale', ['locale' => 'en']) }}">English</a> |
        <a href="{{ route('setLocale', ['locale' => 'de']) }}">Deutsch</a>
    </div>

    <h1>{{ $post->title }}</h1>

    <div>
        {!! $post->content !!}
    </div>

</body>
</html>
