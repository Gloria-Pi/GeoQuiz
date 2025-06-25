<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flag Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <style>
    .correct {
        border: 3px solid green;
    }
    .wrong {
        border: 3px solid red;
    }
    .flag-img {
        width: 160px;
        height: 100px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 6px;
        margin: 10px;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Flag Quiz</h1>
        <h2 style="text-align: center;">What is the flag of <strong>{{ $optionNames[$correctCode] }}</strong>?</h2>

        <!-- Timer -->
        <div id="timer" style="font-weight: bold; font-size: 1.2rem; color: orange; margin: 25px 0;">
            &#x23F1; Time left: <span id="countdown">8</span> seconds
        </div>

        <!-- Quiz -->
        <form method="POST" action="{{ route('flagquiz.check') }}">
            @csrf
            <input type="hidden" name="country_code" value="{{ $country->alpha2Code }}">
            @foreach ($options as $opt)
                <input type="hidden" name="options[]" value="{{ $opt }}">
            @endforeach

            <div style="display: flex; flex-wrap: wrap; justify-content: center;">
            @foreach ($options as $option)
                @php
                    $class = '';
                    if (!empty($answerChecked)) {
                        if ($option === $correctCode) {
                            $class = 'correct';
                        } elseif ($option === $selected) {
                            $class = 'wrong';
                        }
                    }
                @endphp
                
                <button type="submit"
                        name="answer"
                        value="{{ $option }}"
                        style="background: none; border: none; padding: 0;"
                        @if(!empty($answerChecked)) disabled @endif>
                    <img src="{{ asset('assets/flags/' . $optionFlags[$option] . '.png') }}"
                         alt="{{ $option }}"
                         class="flag-img {{ $class }}">
                </button>
            @endforeach
            </div>
        </form>

        <p style="text-align: right;">Question {{ $questionNumber }} of 10</p>

        @if(!empty($answerChecked))
            <div style="margin-top: 2rem;">
                @if(!empty($answerChecked))
                    @if($timeout)
                        <p style="color: orange;">
                            <strong>Time is up!</strong> (ノಠ益ಠ)ノ彡┻━┻ <br>
                            The correct flag was:
                        </p>
                        <img src="{{ asset('assets/flags/' . $optionFlags[$correctCode] . '.png') }}"
                            alt="Correct flag"
                            class="flag-img correct-flag" />
                    @elseif($isCorrect)
                        <p style="color: green;"><strong>Correct!</strong> ٩(｡•́‿•̀｡)۶</p>
                    @else
                        <p style="color: orange;">
                            <strong>Wrong!</strong> You chose <strong>{{ $optionNames[$selected] ?? 'nothing' }}</strong>.
                        </p>
                        <p>The correct flag was:</p>
                        <img src="{{ asset('assets/flags/' . $optionFlags[$correctCode] . '.png') }}"
                            alt="Correct flag"
                            class="flag-img correct-flag"
                            style="display: block; margin:auto; margin-bottom:50px"/>
                    @endif
                @endif

                <form method="GET" action="{{ route('flagquiz.show') }}">
                    <button type="submit">Continue</button>
                </form>
            </div>
        @endif

        <a href="{{ route('home') }}">
            <button class="secondary" style="margin-top:30px;">Quit</button>
        </a>
    </div>

    <!-- Timer JS -->
    @if (empty($answerChecked))
        <script src="{{ asset('js/main.js') }}"></script>
    @endif
</body>
</html>
