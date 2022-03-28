<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie5</title>
    <link rel="stylesheet" href="custom.css">
</head>
<body>

<h1>Výpočtíky</h1>
<hr>

<div class="row">
    <div class="column">
        <h2>y=sin(ax)*sin(ax)</h2>
        <p id="sin"></p><br>
        <button id="sinButton"> Turn on/off</button>
        <div id="dotSin"></div>
    </div>
    <div class="column">
        <h2>y=cos(ax)*cos(ax)</h2>
        <p id="cos"></p><br>
        <button id="cosButton">Turn on/off</button>
        <div id="dotCos"></div>
    </div>
    <div class="column">
        <h2>y=sin(ax)*cos(ax)</h2>
        <p id="sin_cos"></p><br>
        <button id="sinCosButton">Turn on/off</button>
        <div id="dotSinCos"></div>
    </div>
</div>

<div class="slidecontainer">
    <label for="myRange">Lambda: </label>    <output id="amount" name="amount" for="rangeInput">1</output>
    <input type="range" min="-50" max="50" value="1" class="slider" id="myRange" oninput="sendValue()">
</div>

<div id="json"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="custom.js">
    </script>
</body>
</html>