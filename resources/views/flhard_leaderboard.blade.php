<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flag Quiz - Leaderboard</title>

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
        h1, h2 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .container {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Flag Quiz High Scores</h1>
        <h2>Hard Mode Ver.</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Player</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topScores as $index => $score)
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

        <div class="container" style="margin-top: 30px; display:flex; flex-direction:column; gap: 20px; align-items:center;">
        
            <a href="{{ route('flagquiz.leaderboard') }}">
                <button>View Normal Mode Scores</button>
            </a>
        
            <a href="{{ route('home') }}">
                <button class="secondary">Home</button>
            </a>
        </div>
    </div>
</body>
</html>
