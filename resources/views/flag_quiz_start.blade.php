<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flag Quiz - Start</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    
    <div class="container">
        
        <h1 style="margin: 30px 0;">Welcome to the Flag Quiz!</h1>
        <h2 style="margin-bottom: 50px;">Enter your name to begin the quiz</h2>
        
        <form action="{{ route('flagquiz.start') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="player_name" class="block text-left font-medium">Enter your name:</label>
                <input type="text" id="player_name" name="player_name" required
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div style="margin-top: 1rem; display: flex; gap: 1rem;">
            
                <a href="{{ route('home') }}">
                    <button class="secondary" type="button">Home</button>
                </a>
                
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Start
                </button>

            </div>

        </form>

    </div>

</body>
</html>
