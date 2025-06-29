<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flag Quiz Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        .flag-img {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 40px; margin-bottom: 40px; display:flex; flex-direction:column; justify-content:space-between;">
        <h1 style="text-align: center; font-size: 2.6rem">End of Quiz!</h1>
        <h3 style="text-align: center; margin-bottom: 60px; margin-top: 30px; background-color: lightgreen; color: black; border-radius: 10px; padding: 20px;">
            Your score: <strong>{{ $score }}/10</strong>
        </h3>

        <h2>Review Your Answers</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Your Choice</th>
                    <th>Correct Flag</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($history as $index => $entry)

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry['country'] }}</td>
                        <td>
                            @if (is_null($entry['userAnswer']))
                                <img src="{{ asset('assets/other-imgs/timesup.avif') }}"
                                    alt="You didn't answer in time"
                                    class="flag-img">

                            @else
                                <img src="{{ asset('assets/flags/' . $entry['userAnswer'] . '.png') }}"
                                    alt="Your choice"
                                    class="flag-img">

                            @endif
                        </td>
                        <td>
                            <img src="{{ asset('assets/flags/' . $entry['correctCode'] . '.png') }}"
                                 alt="Correct flag"
                                 class="flag-img">
                        </td>
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

        <form method="POST" action="{{ route('flhard.reset') }}" style="display: inline;">
            @csrf
            <button type="submit">Play Again</button>
        </form>
            
        <form method="POST" action="{{ route('flhard.reset') }}" style="display: inline;">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ route('home') }}">
            <button type="submit" class="secondary">Quit</button>
        </form>
            
        <form method="POST" action="{{ route('flhard.reset') }}" style="display: inline;">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ route('flhard.leaderboard') }}">
            <button type="submit" class="secondary">View Leaderboard</button>
        </form>

    </div>

</body>
</html>
