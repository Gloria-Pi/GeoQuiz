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
        
        <h3 style="margin-top:50px">Choose your game:</h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('quiz.start') }}" class="contrast"><button>Capitals Quiz</button></a>
            <a href="{{ route('flagquiz.startForm') }}" class="secondary"><button>Flag Quiz</button></a>
        </div>

        <h3 style="margin-top:50px">Want to practice?</h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('quiz.training') }}" class="contrast"><button>&#129355; Capitals Quiz</button></a>
            <a href="{{ route('flagquiz.training') }}" class="contrast"><button>&#129355; Flag Quiz</button></a>
        </div>

        <h3 style="margin-top:50px;">Check out the previous GeoChampions:</h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('highscores') }}"><button>🏆 Capitals </button></a>
            <a href="{{ route('countries.index') }}"><button>View All Countries</button></a>
            <a href="{{ route('flagquiz.leaderboard') }}"><button>🏆 Flags </button></a>
        </div>

        <h3 style="margin-top:50px;">Take a look at our newest Mini-Games!</h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('memory.show') }}"><button>&#129513; Memory</button></a>
        </div>
    </main>
</body>
</html>
