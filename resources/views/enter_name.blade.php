<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capitals Quiz - Start</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Enter your name to begin the quiz</h2>

        <form action="{{ route('quiz.show') }}" method="GET">
            <label for="player_name">Your name:</label>
            <input type="text" id="player_name" name="player_name" required>

            <div style="margin-top: 1rem; display: flex; gap: 1rem;">
                <a href="{{ route('home') }}"><button type="button">Home</button></a>
                <button type="submit">Start</button>
            </div>
        </form>
    </main>
</body>
</html>