<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Roller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
            <h1 class="text-center">Dice Roller</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-md-2 content-box text-center">
                <form>
                    <label for="howManyDice">How many dice?</label><br>
                    <input type="number" name="howManyDice" id="howManyDice" value="1" min="1" max="6" required>
                </div>
                <div class="col-md-2 content-box text-center">
                    <label for="howManySides">How many sides?</label><br>
                    <select name="howManySides" id="howManySides">
                        <option value="4" selected>d4</option>
                        <option value="6">d6</option>
                        <option value="8">d8</option>
                        <option value="10">d10</option>
                        <option value="12">d12</option>
                        <option value="20">d20</option>
                    </select>
                </form>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-3 text-center">
                    <input class="btn btn-new" type="submit" value="ROLL" onclick="rollTheDice()">
                </div>
            </div>
            <div id="result" class="row d-flex justify-content-center"></div>
            <p><h1 id="total"></h1></p>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        // alert("Default value is: " + document.getElementById("howManySides").value);
        function rollTheDice() {
            let rollBoxStart = "<div class='col-md-2 content-box text-center'><h1>";
            let rollBoxEnd = "</h1></div>"
            let rollBreak = "";
            document.getElementById("result").innerHTML = "";
            document.getElementById("total").innerHTML = "";
            let howManyDice = document.getElementById("howManyDice").value;
            let howManySides = document.getElementById("howManySides").value;
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    let diceData = JSON.parse(this.responseText);
                    currentRoll = 1;
                    console.log(diceData["rolls"]);
            
                    for (dice in diceData.rolls) {
                        if (currentRoll % 3 == 0) {
                            rollBreak = "<p></p>";
                        } else {
                            rollBreak = "";
                        }
                        console.log(diceData.rolls[dice]);
                        document.getElementById("result").innerHTML += rollBoxStart + diceData.rolls[dice] + rollBoxEnd + rollBreak;;
                        document.getElementById("total").innerHTML = "TOTAL: " + diceData.total;
                        currentRoll += 1;
                    }

                }
            }
            xmlhttp.open("GET", "roll.php?d="+howManyDice+"&s="+howManySides, true);
            xmlhttp.send();
        }


    </script>
</body>
</html>
