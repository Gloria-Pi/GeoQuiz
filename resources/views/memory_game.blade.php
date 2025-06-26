<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flag Memory Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        .grid {
            display: grid;
            grid-template-columns: repeat(6, 100px);
            gap: 10px;
            justify-content: center;
        }
        .card {
            width: 100px;
            height: 70px;
            background-color: gray;
            cursor: pointer;
            position: relative;
            border-radius: 6px;
        }
        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
            display: none;
        }
        .card.flipped img {
            display: block;
        }
        .card.matched {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin: 30px 0;"> °❀⋆.ೃ࿔*:･ Memory Game ･:*࿔.ೃ⋆❀° </h1>
        <p style="text-align: center; font-size: 1.2rem;">⏱ Time left: <span id="timer">180</span> seconds</p>
        <div id="message" style="text-align: center; font-weight: bold; font-size: 1.5rem; margin:30px auto; color:orange;"></div>

        <div class="grid" id="game-board">
            @php
                $flags = [];
                foreach ($countries as $country) {
                    $flags[] = $country->alpha2Code;
                    $flags[] = $country->alpha2Code;
                }
                shuffle($flags);
            @endphp

            @foreach ($flags as $code)
                <div class="card" data-flag="{{ $code }}">
                    <img src="{{ asset('assets/flags/' . $code . '.png') }}" alt="Flag {{ $code }}">
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('home') }}"><button class="secondary" style="width:15vw">Quit</button></a>
            <a href="{{ route('memory.show') }}"><button style="width:15vw">Play Again</button></a>
        </div>
    </div>

    <!-- end of body -->
    <script src="{{ asset('js/memory.js') }}"></script>
</body>
</html>
