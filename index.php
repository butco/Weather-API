<?php

$weather = "";
$error = "";
$city = "";

if ($_GET["city"]) {
    $city = htmlspecialchars($_GET["city"]);
    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=b669f537d3f51bcd26321458e2d5f3fe");

    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {
        $weather = "The weather in " . $city . " is currently '" . $weatherArray['weather'][0]['description'] . "'. ";

        $tempInCelcius = $weatherArray['main']['temp'] - 273;

        $wind = $weatherArray['wind']['speed'] * 3.6;

        $weather .= "The temperature is " . round($tempInCelcius) . "&deg;C. ";
        $weather .= "The wind speed is " . round($wind) . " km/h.";
    } else {

        $error = "Could not find the city - please try again.";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather Forecast</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style type="text/css">
    html {
        background: url(weather.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    body {
        background: transparent;
    }

    .container {
        text-align: center;
        margin-top: 150px;
        width: 418px;
    }

    input {
        margin: 20px 0;
        text-align: center;
    }

    #weather {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">

        <h1>What's The Weather?</h1>

        <form>
            <div class="form-group">
                <label for="city">Enter the name of a city</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="e.g. London, Tokyo"
                    value="<?php echo $city; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div id="weather">

                <?php

if ($weather) {

    echo '<div class="alert alert-success" role="alert">' . $weather . '</div>';

} else if ($error) {

    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';

}

?>

            </div>
        </form>
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script>
</body>

</html>