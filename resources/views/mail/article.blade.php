<x-mail::message>
# Новая статья
Добавлена новая статья  с заголовком:
<x-mail::panel>
{{$article->title}}
</x-mail::panel>

Добавлен текст:
<x-mail::panel>
{{$article->text}}
</x-mail::panel>

Автор статьи: {{ $author }}.
<x-mail::button :url="'http://127.0.0.1:8000/article/' . $article->id">
Посмотреть статью:
</x-mail::button>

</x-mail::message>