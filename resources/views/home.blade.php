<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoQuiz Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1 style="text-align: center;"> &#x1F30E; GeoQuiz  &#x1F30E;</h1>
        <h2 style="text-align: center;">Geography Games for Everyone</h2>
        <h3 style="text-align: center; font-size: 1.2rem; font-style: italic; margin-bottom: 30px;">Are you ready to learn some juicy juicy geography?</h3>
        
        <p>Choose your game:</p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('quiz.start') }}" class="contrast"><button>Capitals Quiz</button></a>
            <a href="#" class="secondary"><button disabled>Flag Quiz (coming soon)</button></a>
            <a href="#" class="secondary"><button disabled>Flag Memory (coming soon)</button></a>
            <a href="{{ route('countries.index') }}"><button>View All Countries</button></a>
            <a href="{{ route('highscores') }}"><button>🏆</button></a>
        </div>
    </main>
</body>
</html>
