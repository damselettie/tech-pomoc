<!DOCTYPE html>
<html>
<head>
    <title>Zgłoś problem</title>
</head>
<body>
    <h1>Zgłoś problem techniczny</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/report">
        @csrf
        <label for="room">Sala:</label>
        <select name="room_id" required>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
        </select><br><br>

        <label>Tytuł:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Opis:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Twój email:</label><br>
        <input type="email" name="reported_by" required><br><br>

        @php
    use App\Models\User;

    $users = User::whereIn('role', ['sprzątacz', 'dyrektor', 'informatyk'])->get();
@endphp
    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>


        <button type="submit">Wyślij zgłoszenie</button>
    </form>
</body>
</html>
