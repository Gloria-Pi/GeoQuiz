<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capitals Quiz: Training</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css"
    >
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin: 30px 0;">Capitals Quiz - Training</h1>
        
        <h2 style="text-align: center;">What is the capital of <span class="pico-color-pink-500">{{ $country->name }}</span>?</h2>
        
        <p style="text-align: center; font-size: 1.5rem; margin: 50px 0;">
            <span class="pico-color-pink-500" style="border:solid grey 2px; border-radius: 10px; padding: 10px;">{{ $country->capital }}</span>
        </p>

        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 2rem;">
            <a href="{{ route('home') }}">
                <button style="width:15vw" class="secondary">Home</button>
            </a>
            
            <a href="{{ route('quiz.training') }}">
                <button style="width:15vw">Next</button>
            </a>

            <a href="{{ route('quiz.start') }}">
                <button style="width:15vw" class="secondary">Start Quiz</button>
            </a>
        </div>
    </div>
</body>
</html>