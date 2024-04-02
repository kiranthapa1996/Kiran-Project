<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ask a Question</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    #question-container {
        text-align: center;
        margin-top: 200px;
    }
    #result {
        display: none;
        margin-top: 20px;
        font-weight: bold;
    }
    #button-container {
        display: inline-block;
    }
    button {
        margin: 0 10px;
        padding:10px 20px;
        background-color: green;
        border:2px solid black;
        border-radius:10px;
    }
    #no-btn {
        position: relative;
        background-color: red;
    }
    @keyframes moveAround {
        0% { transform: translate(0, 0); }
        25% { transform: translate(20px, 20px); }
        50% { transform: translate(40px, 0); }
        75% { transform: translate(20px, -20px); }
        100% { transform: translate(0, 0); }
    }
</style>
</head>
<body>

<div id="question-container">
    <h2>Are You A Chudail..??</h2>
    <div id="button-container">
        <button onclick="showResult(true)">Yes</button>
        <button id="no-btn" onclick="showNoMessage()">No</button>
    </div>
    <div id="result"></div>
</div>

<script>
    function showResult(isYes) {
        var resultDiv = document.getElementById("result");
        if (isYes) {
            resultDiv.textContent = "Great! you accepted that you are a Chudail..😄😄😄";
        } else {
            resultDiv.textContent = "Oh no! that means you are Dalit";
        }
        resultDiv.style.display = "block";
    }

    function showNoMessage() {
        var resultDiv = document.getElementById("result");
        resultDiv.textContent = "OK fine, Then you are a panda..😄😄😄";
        resultDiv.style.display = "block";
    }
</script>

</body>
</html>
