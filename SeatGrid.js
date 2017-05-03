var Grid = function(seats){
    
    seats = $(seats);
    var rows = 19;
    var columns = 25;
    var squareSize = 35;
    var gridArray = new Array();
    var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R'];
    var counterRow = 1;
    
    for (var k = 0; k < rows; k++){
        gridArray.push([]);
    }
    
    for (var i = 0; i < columns; i++){
        //counter that gets incremented to label the first column with letters of the alphabet
        alphcounter = 0;
        for (var j = 0; j < rows; j++){
            var square = document.createElement("div");
            seats.append(square);
            if (i == 0 && j == 0){
                //do nothing, blank square
            }
            //very first row, each square labeled from 1-24
            else if (j == 0){
                square.innerHTML = counterRow;
                square.style.fontSize = "15px";
                square.style.fontWeight = "900";
                counterRow++;
            }
            //very first column, each square labeled A-R
            else if (i == 0){
                square.innerHTML = alphabet[alphcounter];
                square.style.fontSize = "15px";
                square.style.fontWeight = "900";
                alphcounter++;
            }
            else if (i == 4 || i == 5 || i == 20 || i == 21){
                //do nothing. aisles don't have ids
            }
            //every other square is a seat, give each seat element id
            else{
                var sid = alphabet[j-1] + "_" + (i);
                //square.id = sid;
                square.id = sid;
            }
            var topPosition = j * squareSize;
            var leftPosition = i * squareSize;
            square.style.top = topPosition + 'px';
            square.style.left = leftPosition + 'px';
            square.style.right = 2 * leftPosition + 'px';
            square.style.bottom = 2 * topPosition + 'px';
            //colors in the aisles white, avoids first row since those are labels
            if ((i == 4 || i == 5 || i == 20 || i == 21) && j != 0){
                square.style.background = 'white';
            }
            //colors rest of seats grey, while avoiding first row and column since those are labels
            else if (i != 0 && j != 0) {
                square.style.background = 'grey';
            }
            //set aisles of array to X
            if ((i == 3 || i == 4 || i == 19 || i == 20) && j < rows - 1){
                gridArray[j][i] = 'X';
            }
            //set seats of array to O
            else if (i < columns - 1 && j < rows - 1) {
                gridArray[j][i] = 'O';
            }
        }
    }
//checking if gridArray is filled correctly
/**
  for (var l = 0; l < columns - 1; l++){
    for (var m = 0; m < rows - 1; m++){
      var gridSquare = document.getElementById("s" + "_"+ m + "_" + l);
      if(gridArray[m][l] == 'O'){
        gridSquare.style.background = 'white';
      }
      else if (gridArray[m][l] == 'X') {
        gridSquare.style.background = 'grey';
      }
    }
  }
**/
}