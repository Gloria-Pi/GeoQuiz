<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoQuiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <style>
    .correct {
        background-color: green;
        color: white;
    }
    .wrong {
        background-color: red;
        color: white;
    }
    </style>

</head>
<body>
    <div class="container">
        <h1>Geo Quiz</h1>

        <h2>What is the capital of {{ $country->name }}?</h2>

        <form method="POST" action="{{ route('quiz.check') }}">
            @csrf
            <input type="hidden" name="country_code" value="{{ $country->alpha3Code }}">
            @foreach ($options as $opt)
                <input type="hidden" name="options[]" value="{{ $opt }}">
            @endforeach
            
            <input type="hidden" name="country_code" value="{{ $country->alpha3Code }}">
            @foreach($options as $option)
                @php
                    $class = '';
                    if (!empty($answerChecked)) {
                        if ($option === $correctCapital) {
                            $class = 'correct';
                        } elseif ($option === $selected) {
                            $class = 'wrong';
                        }
                    }
                @endphp
                
                <button
                    type="submit"
                    name="answer"
                    value="{{ $option }}"
                    class="{{ $class }}"
                    @if(!empty($answerChecked)) disabled @endif
                >
                    {{ $option }}
                </button><br>
            @endforeach
        </form>

        @if(!empty($answerChecked))
            <div style="margin-top: 2rem;">
                @if($isCorrect)
                    <p><strong>Correct!</strong> (＾▽＾)</p>
                @else
                    <p>
                        <strong>Wrong!</strong> You chose "{{ $selected }}".<br>
                        The correct capital is <strong>{{ $correctCapital }}</strong>.  (╭ರ_•́)
                    </p>
                @endif
            </div>

            <form method="GET" action="{{ route('quiz.show') }}">
                <button type="submit">Continue</button>
            </form>
        @endif
    </div>

    <!-- end of body -->
    <script>
        // Debug: mostra in console la risposta corretta
        console.log("Correct answer: {{ $country->capital }}");
    </script>
</body>
</html>
