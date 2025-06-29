<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flags Quiz: Training</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css"
    >
    
    <style>
        .flag-img {
            width: 240px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #666;
            border-radius: 8px;
            margin: 20px auto;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin: 30px 0;">Flags Quiz - Training</h1>
        <h2 style="text-align: center;">What's the flag of <span class="pico-color-pink-500">{{ $country->name }}</span>?</h2>

        <img src="{{ asset('assets/flags/' . $country->alpha2Code . '.png') }}"
            alt="Flag of {{ $country->name }}"
            class="flag-img" style="margin: 50px auto;"
        >

        <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 2rem;">
            <a href="{{ route('home') }}">
                <button class="secondary">Home</button>
            </a>
            
            <form method="GET" action="{{ route('flagquiz.training') }}">
                <button type="submit" style="width:20vw;">Next</button>
            </form>

            <a href="{{ route('flag-quiz.pick') }}">
                <button class="secondary">Quiz</button>
            </a>
        </div>
    </div>
</body>
</html>
