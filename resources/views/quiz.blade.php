<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capitals Quiz</title>

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
        
        <h1 style="text-align: center;">Capitals Quiz</h1>
        <h2 style="text-align: center;">What is the capital of {{ $country->name }}?</h2>

        <!-- Timer -->
        <div id="timer" style="font-weight: bold; font-size: 1.2rem; color: orange; margin: 25px 0;">
            &#x23F1; Time left: <span id="countdown">8</span> seconds
        </div>

        <!-- Quiz -->
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

        <p style="font-weight: thin; font-size: 0.9rem; text-align: right;">Question {{ $questionNumber }} of 10</p>

        @if(!empty($answerChecked))
            <div style="margin-top: 2rem;">

                @if(!empty($timeout))
                    <p style="color: orange;">
                        <strong>Time is up!</strong> (╯°□°）╯︵ ┻━┻ <br>
                        The correct capital is <strong>{{ $correctCapital }}</strong>. 
                    </p>
                @else
                    @if($isCorrect)
                        <p><strong>Correct!</strong> (＾▽＾)</p>
                    @else
                        <p>
                            <strong>Wrong!</strong> You chose "{{ $selected }}".<br>
                            The correct capital is <strong>{{ $correctCapital }}</strong>.  (╭ರ_•́)
                        </p>
                    @endif            
                @endif            
            </div>

            <form method="GET" action="{{ route('quiz.show') }}">
                <button type="submit">Continue</button>
            </form>
        @endif
        
        <a href="{{ route('home') }}" >
            <button class="secondary" style="margin-top:30px; font-size: 0.9rem; width: 30%">
                QUIT</button>
        </a>
            
    </div>

    <!-- end of body -->
    <script>
        // Debug: mostra in console la risposta corretta
        console.log("Correct answer: {{ $country->capital }}");
    </script>
    
    <!-- Timer -->
    <!-- Esegue lo script solo se non c’è una risposta già verificata -->
    @if (empty($answerChecked))
        <script src="{{ asset('js/main.js') }}"></script>
    @endif
</body>
</html>
