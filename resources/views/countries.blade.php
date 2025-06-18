<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeoQuiz</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

</head>
<body>
    <div class="container" style="margin: 45px 0; margin-left: auto; margin-right: auto;">
        <h1 style="text-align: center; margin-bottom: 50px; font-size: 2.6rem">Countries</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Code</th>
                    <th>Region</th>
                    <th>Flag</th>
                </tr>
            </thead>
            <tbody>

                @foreach($countries as $country)

                <tr>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->capital }}</td>
                    <td>{{ $country->alpha3Code }}</td>
                    <td>{{ $country->region }}</td>
                    <td><img src="assets/flags/{{ $country->alpha2Code }}.png" alt="Flag Images"></td>
                </tr>

                @endforeach

            </tbody>
        </table>

        <a href="{{ route('home') }}" style="margin-left: 1rem;">
            <button class="secondary" style="margin:auto; display:block;">QUIT</button>
        </a>
    </div>
</body>
</html>