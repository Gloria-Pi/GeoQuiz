<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoQuiz Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <div class="container" style="margin-top: 40px; margin-bottom: 40px; display:flex; flex-direction:column; justify-content:space-between;">
        <h1 style="text-align: center;  font-size: 2.6rem">End of Quiz!</h1>
        <h3 style="text-align: center; margin-bottom: 60px; margin-top: 30px; background-color: lightgreen; color: black; border-radius: 10px; padding: 20px;">Your score: <strong>{{ $score }}/10</strong></h3>

        <h2>Review Your Answers</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Your Answer</th>
                    <th>Correct Capital</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $index => $entry)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry['country'] }}</td>
                        <td>{{ $entry['userAnswer'] }}</td>
                        <td>{{ $entry['correctAnswer'] }}</td>
                        <td>
                            @if ($entry['isCorrect'])
                                ✅
                            @else
                                ❌
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form method="POST" action="{{ route('quiz.reset') }}" style="display: inline;">
            @csrf
            <button type="submit">Play Again</button>
        </form>

        <a href="{{ route('home') }}">
            <button class="secondary">QUIT</button>
        </a>
    </div>
</body>
</html>
