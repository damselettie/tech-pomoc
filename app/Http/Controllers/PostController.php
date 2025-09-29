<?php 

use App\Models\Post;

class PostController extends Controller
{
    public function store()
    {
        $post = new Post();
        

        // Ustawiamy tłumaczenia pola 'title' (tytuł)
        $post->setTranslations('title', [
            'pl' => 'Tytuł po polsku',
            'en' => 'Title in English',
            'de' => 'Titel auf Deutsch',
        ]);

        // Ustawiamy tłumaczenia pola 'content' (treść)
        $post->setTranslations('content', [
            'pl' => 'Treść po polsku',
            'en' => 'Content in English',
            'de' => 'Inhalt auf Deutsch',
        ]);

        $post->save(); // zapisujemy do bazy

        return 'Post został zapisany!';
    }

    public function show(Post $post)
{
    return view('posts.show', compact('post'));
}
}
