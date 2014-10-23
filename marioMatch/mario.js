//create variables for sounds
var intro = new Audio("sounds/intro.mp3");
var toad = new Audio("sounds/toad.mp3");
var sfxmatch = new Audio("sounds/match.wav");
var sfxnomatch = new Audio("sounds/nomatch.wav");
var win = new Audio("sounds/win.wav");
var coin = new Audio("sounds/coin.wav");
var mushroom = new Audio("sounds/mushroom.wav");
var up1 = new Audio("sounds/up1.wav");
var flower = new Audio("sounds/flower.wav");

//variable for time (in seconds)
var time = 0;

//variable for score (out of 8)
var score = 0;

//var to store clicked image's class
var flip;

//var to store the timer's setInterval reference, so you can stop the timer later.
var interval;

//vars to store references to the first card flipped, and the second.
var flippedFirst = "";
var flippedSecond = "";

//var to store whether clicked img is 1st or 2nd clicked.
var flipped = 0;

//var to store when first item was clicked.
var timeClicked = 0;

//doc ready function
$(document).ready(function(){
    
    //sets all imgs to matched=false and flipped=false.
    $("img").attr({matched: "false",
                   flipped: "false"});
    
    //hide the win window.
    $(".win").hide();
    
    //hides scoreboard
    $("#scoreboard").hide();
    
    //plays intro music.
    intro.play();   
    
    //shuffle the cards and assign them as classes to each img
    shuffleCards();       
    
    //make the retry button refresh the page on click.
    $("#retry").click(function(){
       location.reload(); 
    });      
});

//function that is called when the start game button is clicked. begins the game.
function initializeGame() {
    
    //reveal all the cards so the player can try to memorize img placement
    reveal(); 
    
    //pause the intro music.
    intro.pause();    
        
    //hide both the intro panel and the start button.
    $(".intro, #start").hide();
    
    //show the scoreboard.
    $("#scoreboard").show();
    
    //begin counting down the timer.
    startTimer();
    
    //add the function to all imgs that controls flipping.
    $("img").click(function(e){
        //pass the event target to flip card, so we know what card we're flippin'
        flipCard(e.target);
    });
}

//function to handle all that happens when you flip a card
function flipCard(e) {
    //if this img isn't already flipped...
        if($(e).attr("flipped") == "false"){
            
            
            //increment the number of flipped cards
            flipped++;
            
            //and change this imgs flipped attr to true
            $(e).attr("flipped", "true");
            
            //if e the 3rd (or fourth, etc) flipped card...            
            if(flipped >2){
                //flip all cards back over
                flipUnmatched();
                //and reset flipped to 1 (since the third card selected is 
                //technically also the first of the new cards.
                flipped = 1;
            }

            //if this is the first flipped card...
            if(flipped == 1){
                timeClicked = time;
                //then assign flippedFirst the class of this img
                flippedFirst = $(e).attr("class");
            }
            //if this is the second flipped card...
            if(flipped == 2){
                //then assign flippedSecond the class of this img...
                flippedSecond = $(e).attr("class");

                //and if they are equal (a match!)
                if(flippedFirst == flippedSecond){
                    //play the matched sfx
                    playMatchSfx(e);
                    
                    //assign the matched imgs matched attribute to true
                    $("." + flippedFirst).attr("matched", "true");
                    //increment the score by one.
                    score++;
                    //and update this on screen.
                    updateScore();
                    
                    //if score is 8 (win condition)...
                    if(score == 8){
                        //stop the timer...
                        stopTimer();
                        //and display the winning message
                        showWin();
                    }
                }
                //otherwise, they aren't equal...
                else{
                    //so play the nomatch sfx
                    sfxnomatch.play();
                    //and after .7 seconds,
                    setTimeout(function(){
                        //flip all unmatched cards back over.
                        flipUnmatched();
                    }, 700);
                }
            }

            //assigns flip the class of the clicked img
            flip = $(e).attr("class");
            //and changes the img's src to "flip".png
            $(e).attr("src", "images/" + flip + ".png");
        }           
}

//function to play the correct sfx depending on card matched.
function playMatchSfx(e) {
    //var to store matched card's class
    var matchedCard = $(e).attr("class");

    //depending on the class, play different sfx
    switch(matchedCard) {
        case "coins10":
        case "coins20":
        case "coins50":
        case "coins100":
            coin.play();
            break;
        case "flower":
            flower.play();
            break;
        case "mushroom":
            mushroom.play();
            break;
        case "star":
            sfxmatch.play();
            break;
        case "up1":
            up1.play();
            break;
    }
}


//function to initially reveal all cards, then hide them.
function reveal() {
    
    //on each img...
    $("img").each(function(){
        //assign this img's class to flip.
        flip = $(this).attr("class");
        //then assign an image based on that class.
        $(this).attr("src", "images/" + flip + ".png");
    });
    
    //wait 1.5 seconds, then flip all unmatched cards over.
    setTimeout(function(){
         flipUnmatched();
    }, 1500);
}

//function to display a message when the game is won
function showWin() {
    //play the win sfx
    win.play();
    //and show the .win window
    $(".win").show();
}

//function to update the score on screen.
function updateScore(){
    //assign the score to the #score's html.
    $("#score").html(score);
}

//function to start the timer
function startTimer() {
    
    //runs count every 1000ms (1 second).
    interval = setInterval(function(){
       count(); 
    }, 1000);
}

//function to post time, then increment.
function count() {
    
    //var to store amt of time that has passed since first card was selected
    var timePassed = time-timeClicked;
    //if 3 seconds have gone by without clicking a second card...
    if(timePassed == 2){
        //flip over the card
        flipUnmatched();
    }
    
    //updates time in the scoreboard.
    $("#time").html(time);
    
    //increments the time.
    time++;    
}

//function to stop the timer.
function stopTimer(){
    //clears the interval of startTimer's setInterval
    clearInterval(interval);
}

//function to flip all cards that aren't matched or flipped already.
function flipUnmatched(){
    $("img[matched='false']").attr({
        src: "images/spade.png",
        flipped: "false"});
    //reset flipped count to 1. (zero does weird things)
    flipped = 0;
}

//function to shuffle the cards before the game begins
function shuffleCards() {
    //array of possible cards
    var cards = [
        "coins10", "coins10",
        "coins20", "coins20",
        "coins50", "coins50",
        "coins100", "coins100",
        "flower", "flower",
        "mushroom", "mushroom",
        "star", "star",
        "up1", "up1"];
    
    //shuffle the array of cards
    shuffle(cards);
    
    //for loop to assign cards to each <img> tag with id=#[1-16]
    for(i=1; i <= 16; i++){
        $("#" + i).attr("class", cards[i-1]);   
    }        
}

//Fisher-Yates shuffle tinyurl.com/o5uk3t
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}