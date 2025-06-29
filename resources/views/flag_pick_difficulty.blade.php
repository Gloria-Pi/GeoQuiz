<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capitals Quiz - Pick Difficulty</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <div class="container" style="display:flex; flex-direction:column; align-items: center;">
        <h1 style="margin: 30px 0;">Welcome to the Flags Quiz!</h1>
        <h2 style="margin-bottom: 50px;">Choose your preferred difficulty.</h2>
    </div>

    <div class="container" style="display:flex; flex-direction:row; justify-content:space-evenly;">
        
        <div style="margin-top: 1rem; display: flex;">
            <a href="{{ route('flagquiz.startForm') }}"><button type="button" class="primary" style="padding: 3rem 4rem;">&#127752; <br> Normal Mode</button></a>
        </div>
        <div style="margin-top: 1rem; display: flex;">
            <a href="{{ route('flhard.startForm') }}"><button type="button" class="primary" style="padding: 3rem 4rem;">&#127919; <br> Hard Mode</button></a>
        </div>
    </div>
    <div style="margin-top: 1rem; display: flex; justify-content: center; align-items: center;">
        <a href="{{ route('home') }}"><button type="button" class="secondary" style="text-decoration:none; padding: 1rem 10rem;">Home</button></a>
    </div>
</body>
</html>