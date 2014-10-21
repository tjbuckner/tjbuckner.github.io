var shot = new Audio('sounds/shot.mp3');
var miss = new Audio('sounds/miss.mp3');
var startRound = new Audio('sounds/startRound.mp3');
var startGame = new Audio('sounds/startGame.mp3');
var win = new Audio('sounds/win.mp3');
var lose = new Audio('sounds/lose.mp3');
var drop = new Audio('sounds/drop.mp3');
var laugh = new Audio('sounds/laugh.mp3');
var winBool = false;

//var flaps = new Audio('sounds/flaps.mp3');


var ammo = 3;
var score = 0;
var deadDuck = false;
var duck = $("#blue-duck");


$(document).ready(function(){
     startGame.play();
});

function AnimateDuck() {
    var duck = $("#blue-duck"),
        playarea = $("#play-area"),
        maxLeft = playarea.width() - duck.width(),
        maxTop = playarea.height() - duck.height(),
        leftPos = Math.floor(Math.random() * maxLeft),
        topPos = Math.floor(Math.random() * maxTop),
        imgRight1 = "images/blueDuckRight.gif",
        imgRight2 = "images/blueDuck2.png",
        imgRight3 = "images/blueDuck3.png",
        imgLeft1 = "images/blueDuckLeft.gif",
        imgLeft2 = "images/blueDuckLeft2.png",
        imgLeft3 = "images/blueDuckLeft3.png",
        frame = 0;
    
    
    
        if (duck.position().left < leftPos) {
            duck.attr("src", imgRight1);
        } else {
            duck.attr("src", imgLeft1);
        }
    
        duck.animate({
            "left": leftPos,
            "top": topPos
        }, 1000, AnimateDuck);    
}

function initializeGame() {
    startGame.pause();
    fadeScreen();
    startRound.play()
    
    dogIntro();
    
    setTimeout(function(){
        AnimateDuck()
        
        $("#play-area").click(function(){
            shoot();
        });
    
        $("#blue-duck").click(function(){
            shootPos();
        });
    
    }, 5000);
}

function dogIntro() {
    
}

function shoot() {
    if(ammo>0 && !deadDuck) {
//        flash();
        miss.play();
        ammo--;
        updateAmmo();
    }
    if(ammo==0 && !deadDuck){
        showLose();
        flyAway();
    }
}

function showLose() {
    $("#dogBushes").attr("src", "images/dogLaughing.gif");
    showDog();
    
    lose.play();
    $('#lose').css('visibility', 'visible'); 
    
    resetGame();
}

function resetGame() {
    setInterval(function(){
        window.location.reload();
    }, 7000);
}

function flyAway() {
    var duck = $("#blue-duck");
    duck.stop();
    duck.attr("src", "images/blueDuckFlyAway.png");
    
    setTimeout(function(){        
        
        duck.animate({
            "top": -105
        }, 2000);
    }, 700);
}

function shootPos() {
    if(ammo>0 && !deadDuck) {
        shot.play();
        ammo--;
        updateAmmo();
        deadDuck = true;
        score += 500;
        updateScore();
        animateDuckDeath();
    }
}

function animateDuckDeath() {
    var duck = $("#blue-duck");
    duck.stop();
    $("#main").attr("src", "images/mainBarWin.gif");
    
    duck.attr("src", "images/blueDuckShot.png");
    
    setTimeout(function(){
        
        duck.attr("src", "images/blueDuckFall.gif");        
        
        duck.animate({
            "top": 500
        }, 2000);      
               
    }, 700);
    
    
    winBool = true;
    showWin();
    
}

function showDog(){
    var dog = $("#dogBushes");
    
    var pos = $("#blue-duck").position().left;
    
    console.log(pos);
    
    if(winBool)
        dog.css("left", pos);
    
    setTimeout(function(){
        dog.animate({
            "top": "65%"
        }, 500);
        
        if(!winBool)
        laugh.play();
    }, 2000);
    
    
    
}

function showWin() {
    showDog();
    win.play();
    
    $('#sky').animate(
        {backgroundColor: '#ffbfb3'}, 3000);
    
    $('#win').css('visibility', 'visible');   
    
    resetGame();
}



function fadeScreen() {
    $("#title").fadeOut(); 
    $("#title").hide(); 
    $("#play-button").hide();
}

function updateAmmo() {
    if(ammo == 3)
        $("#shot").attr("src", "images/3-shot.bmp"); 
    if(ammo == 2)
        $("#shot").attr("src", "images/2-shot.bmp");  
    if(ammo == 1)
        $("#shot").attr("src", "images/1-shot.bmp"); 
    if(ammo == 0)
        $("#shot").attr("src", "images/0-shot.bmp");  
}

function flash() {
       $("#flash").attr("background-color", "white");
}

function updateScore() {
    $("#score-panel").html(zeroPad(score, 6) + "<br>SCORE");
}

function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}