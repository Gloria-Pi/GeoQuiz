<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoQuiz - Leaderboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">

    <h1>High Scores</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Player</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($highScores as $index => $score)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $score->player_name }}</td>
                    <td>{{ $score->score }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No scores yet!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('home') }}">
        <button class="secondary">Home</button>
    </a>
</div>
</body>
</html>
