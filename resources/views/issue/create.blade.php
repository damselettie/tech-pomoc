<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dodaj nowe zgłoszenie</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tło formularza na jasnoszare */
        form {
            background-color: #f0f4f8; /* jasnoszary-niebieski */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(100, 120, 150, 0.2);
        }

        /* Pole formularza z niebieską ramką */
        .form-control {
            border: 1px solid #5a7dba; /* niebieskawy odcień */
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        /* Pole formularza - ramka zmienia kolor przy focusie */
        .form-control:focus {
            border-color: #3b5998; /* ciemniejszy niebieski */
            box-shadow: 0 0 5px rgba(59, 89, 152, 0.5);
        }

        /* Przycisk z szaro-niebieskim tłem */
        .btn-primary {
            background-color: #5a7dba;
            border-color: #5a7dba;
            transition: background-color 0.3s ease;
        }

        /* Przycisk - kolor zmienia się po najechaniu */
        .btn-primary:hover {
            background-color: #3b5998;
            border-color: #3b5998;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h1 class="card-title mb-4">Dodaj nowe zgłoszenie</h1>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('issue.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Nazwa</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Opis</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="room_number" class="form-label">Numer sali</label>
                        <input type="text" class="form-control" id="room_number" name="room_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="computer_number" class="form-label">Numer komputera</label>
                        <input type="text" class="form-control" id="computer_number" name="computer_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="reporter_name" class="form-label">Imię zgłaszającego</label>
                        <input type="text" class="form-control" id="reporter_name" name="reporter_name" required>
                    </div>

                    @php
                        use App\Models\User;
                        $users = User::whereIn('role', ['sprzątacz', 'dyrektor', 'informatyk'])->get();
                    @endphp

                    <div class="mb-3">
                        <label for="recipients" class="form-label">Wyślij do</label>
                        <select name="recipients[]" id="recipients" class="form-control" multiple required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Przytrzymaj Ctrl (lub Cmd), by zaznaczyć wielu odbiorców.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Wyślij zgłoszenie</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcjonalnie, do komponentów jak modale) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
