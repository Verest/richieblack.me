var canvas, ctx, height, fontBaseSize;
var phase, numPlayers, onePSide, turn;
var gameContents, winRow;
var rowKey=[[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
var drawWinKey;
var xoCoorKey;
var cellKey;

//done
function initializeCanvas(){
  canvas = document.getElementById('ticTacToeCanvas');
  ctx = canvas.getContext('2d');

  //fix size of canvas element & get height
  canvas.style.height = canvas.offsetWidth + 'px';
  canvas.height = canvas.offsetHeight;
  canvas.width = canvas.offsetWidth;
  height = canvas.height;

  //base font size
  fontBaseSize=height/10;

  //link clinking function
  canvas.addEventListener('click',clickCanvasEvent,false);
}
//done
function drawLine(x1,y1,x2,y2){
  ctx.beginPath();
  ctx.strokeStyle = '#555555';
  ctx.lineWidth = height*0.012;
  ctx.moveTo(x1,y1);
  ctx.lineTo(x2,y2);
  ctx.stroke();
}
//done
function drawBoard(){
  ctx.fillStyle="#EAE3EA";
  ctx.fillRect(0,0,height,height);

  drawLine(0,height/3,height,height/3);
  drawLine(0,2*height/3,height,2*height/3);
  drawLine(height/3,0,height/3,height);
  drawLine(2*height/3,0,2*height/3,2*height);
}

//done
function initializeButtons(){
  var rB=document.getElementById('resetButton');
  rB.onclick=function(){resetGame();};
}

//done
function clearCanvas(){
  ctx.fillStyle="#FFFFFF";
  ctx.fillRect(0,0,height,height);
}

//done
function drawPhase0(){
  clearCanvas();

  ctx.textAlign="center";
  ctx.font=fontBaseSize+'px Arial';
  ctx.lineWidth = height*0.012;
  ctx.strokeStyle = '#555555';


  //1Player Button
  ctx.fillStyle="#EAE3EA";
  ctx.fillRect(height/6,height/12,2*height/3,height/3);
  ctx.fillStyle="#000000";
  ctx.beginPath();
  ctx.rect(height/6,height/12,2*height/3,height/3);
  ctx.stroke();
  ctx.fillText("1-P",height/2,height/4+fontBaseSize/3);
  //2Player Button
  ctx.fillStyle="#EAE3EA";
  ctx.fillRect(height/6,7*height/12,2*height/3,height/3);
  ctx.fillStyle="#000000";
  ctx.beginPath();
  ctx.rect(height/6,7*height/12,2*height/3,height/3);
  ctx.stroke();
  ctx.fillText("2-P",height/2,3*height/4+fontBaseSize/3);
  phase=0;
}

//done
function drawPhase1(){
  clearCanvas();

  ctx.textAlign="center";

  ctx.fillStyle="#EAE3EA";
  ctx.fillRect(height/12,height/3,height/3,height/3);
  ctx.fillRect(7*height/12,height/3,height/3,height/3);

  ctx.beginPath();
  ctx.rect(height/12,height/3,height/3,height/3);
  ctx.rect(7*height/12,height/3,height/3,height/3);
  ctx.stroke();

  ctx.fillStyle="#000000";
  ctx.font=fontBaseSize*3+'px Arial';
  ctx.fillText("X",height/4,height/2+fontBaseSize);
  ctx.fillText("O",3*height/4,height/2+fontBaseSize);

  ctx.font=fontBaseSize*2+'px Arial';
  ctx.fillText("Choose",height/2,height/6+fontBaseSize/1.5);

  ctx.font=fontBaseSize+'px Arial';
  ctx.fillText("X Always Goes First",height/2,5*height/6+fontBaseSize/3);
  ctx.fillText("or",height/2,height/2+fontBaseSize/3);

  phase=1;
}

//done
function drawPhase2or3(){
  clearCanvas();
  drawBoard();

  phase=numPlayers+1;
}

function drawPhase4(n){
  phase=4;

  ctx.textAlign="center";
  ctx.font=fontBaseSize*2+'px Arial';

  ctx.fillStyle='#ffffff';
  ctx.fillRect(1*height/18,7*height/18,8*height/9,2*height/9);

  ctx.fillStyle="#000000";
  ctx.beginPath();
  ctx.rect(1*height/18,7*height/18,8*height/9,2*height/9);
  ctx.stroke();
  if(n===0){//o win
    ctx.fillText("O Wins!",height/2,height/2+fontBaseSize/1.5);
  }else if(n==1){//x win
    ctx.fillText("X Wins!",height/2,height/2+fontBaseSize/1.5);
  }else{//tie
    ctx.fillText("Tie!",height/2,height/2+fontBaseSize/1.5);
  }

  setTimeout(function(){drawPhase2or3();startGame();},2000);
}

//done
function drawXorO(n){
  if(turn!=10){
    if(turn%2!==0){//X turn
      drawX(xoCoorKey[n][0],xoCoorKey[n][1],3);
      gameContents[n]=1;
    }else{//O turn
      drawO(xoCoorKey[n][0],xoCoorKey[n][1],3);
      gameContents[n]=4;
    }
  }
   setTurn(turn+1);
   checkWin();
}
//done
function drawX(x,y,size){
  ctx.fillStyle="#339933";
  ctx.font=size*fontBaseSize+'px Arial';
  ctx.fillText("X",x,y+size*fontBaseSize/3);
}

//done
function drawO(x,y,size){
  ctx.fillStyle="#990000";
  ctx.font=size*fontBaseSize+'px Arial';
  ctx.fillText("O",x,y+size*fontBaseSize/3);
}

//working
function clearCell(n){
  //clears background for animation of win condition
  //n being integer 0 through 8
  var x=cellKey[n][0]+height/60;
  var y=cellKey[n][1]+height/60;
  ctx.fillStyle="#EAE3EA";
  ctx.fillRect(x,y,height/3-height/30,height/3-height/30);
}

//done
function click1P(){
  numPlayers=1;
  drawPhase1();
}

//done
function click2P(){
  numPlayers=2;
  drawPhase1();
}

//done
function clickX(){
  onePSide=1;//1 for X
  drawPhase2or3();
  startGame();
}

//done
function clickO(){
  onePSide=0; //0 for O
  drawPhase2or3();
  startGame();
}
//done
function isValid(cell,compFlag){//check if players turn and if spot not taken
  if(gameContents[cell]===0){
    if(compFlag===1){
      return true;
    }
    if(numPlayers==1){
      if((onePSide==1 && turn%2!==0)||(onePSide===0 && turn%2===0)){
        return true;
      }
    }else{
      return true;
    }
  }
  return false;
}

//done
function clickCell0(){
  var n=0;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell1(){
  var n=1;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell2(){
  var n=2;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell3(){
  var n=3;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell4(){
  var n=4;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell5(){
  var n=5;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell6(){
  var n=6;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCell7(){
  var n=7;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}

//done
function clickCell8(){
  var n=8;
  if(isValid(n,0)){
    drawXorO(n);
    setTimeout(function(){compTurn();},500);
  }
}
//done
function clickCanvasEvent(e){
  var x=e.offsetX;
  var y=e.offsetY;
 if(phase===0){
  if(x>height/6&&x<5*height/6&&y>height/12&&y<5*height/12){
    click1P();
  }else if(x>height/6&&x<5*height/6&&y>7*height/12&&y<11*height/12){
    click2P();
  }
 }else if(phase===1){
  if(x>height/12&&x<5*height/12&&y>height/3&&y<2*height/3){
    clickX();
  }else if(x>7*height/12&&x<11*height/12&&y>height/3&&y<2*height/3){
    clickO();
  }

 }else if(phase===2 || phase===3){
    if(x<height/3){
      if(y<height/3){
        clickCell0();
      }else if(y<2*height/3){
        clickCell1();
      }else if(y>2*height/3){
        clickCell2();
      }
    }else if(x<2*height/3){
      if(y<height/3){
        clickCell3();
      }else if(y<2*height/3){
        clickCell4();
      }else if(y>2*height/3){
        clickCell5();
      }
    }else if(x>2*height/3){
      if(y<height/3){
        clickCell6();
      }else if(y<2*height/3){
        clickCell7();
      }else if(y>2*height/3){
        clickCell8();
      }
    }
 }
}

//done
function startGame(){
  gameContents=[0,0,0,0,0,0,0,0,0];
  setTurn(1);
  if(numPlayers==1&&onePSide===0){
    compTurn();
  }
}

function resetGame(){
  if(phase<=3){
    drawPhase0();
  }
}
//done
function sumCheck(a,b,c,valCheck,pos){
  if(a+b+c===valCheck){
    winRow=pos;//winning row posistion
    return true;
  }
  return false;
}
//working
function checkWin(){
  //largely defining these for making the next section shorter...
  var n0=gameContents[0], n1=gameContents[1];
  var n2=gameContents[2], n3=gameContents[3];
  var n4=gameContents[4], n5=gameContents[5];
  var n6=gameContents[6], n7=gameContents[7];
  var n8=gameContents[8];
  var i;
  //checking if X won
  i=3;
  if (sumCheck(n0,n1,n2,i,0)||sumCheck(n3,n4,n5,i,1)||sumCheck(n6,n7,n8,i,2)||sumCheck(n0,n3,n6,i,3)||sumCheck(n1,n4,n7,i,4)||sumCheck(n2,n5,n8,i,5)||sumCheck(n0,n4,n8,i,6)||sumCheck(n2,n4,n6,i,7)){
    drawWin(winRow,1);
    phase=3.5;
    setTimeout(function(){drawPhase4(1);},2000);
    return;
  }
  //checking if O won
  i=12;
  if (sumCheck(n0,n1,n2,i,0)||sumCheck(n3,n4,n5,i,1)||sumCheck(n6,n7,n8,i,2)||sumCheck(n0,n3,n6,i,3)||sumCheck(n1,n4,n7,i,4)||sumCheck(n2,n5,n8,i,5)||sumCheck(n0,n4,n8,i,6)||sumCheck(n2,n4,n6,i,7)){
    drawWin(winRow,0);
    phase=3.5;
    setTimeout(function(){drawPhase4(0);},2000);
    return;
  }

  //check if tie
  if(turn>9){
    phase=3.5;
    setTimeout(function(){drawPhase4(2);},500);
  }
}
//done
function sum(a,b,c){
  return a+b+c;
}
//done
function compTurn(){
  var n0=gameContents[0], n1=gameContents[1];
  var n2=gameContents[2], n3=gameContents[3];
  var n4=gameContents[4], n5=gameContents[5];
  var n6=gameContents[6], n7=gameContents[7];
  var n8=gameContents[8];
  var bestOptionCount=[[0,[]],[0,[]],[0,[]]];//first is # possible options, second is list of win location
  var i,n,rnd,validPos=[];
  var sumContents=[sum(n0,n1,n2),sum(n3,n4,n5),sum(n6,n7,n8),sum(n0,n3,n6),sum(n1,n4,n7),sum(n2,n5,n8),sum(n0,n4,n8),sum(n2,n4,n6)];
  var playerWinCond, compWinCond;

  //set values for win conditions
  if(phase==2){
    if(onePSide===1){//player is X
      playerWinCond=2;
      compWinCond=8;
    }else{//player is O
      playerWinCond=8;
      compWinCond=2;
    }
    //sum up best game options (win >block win > prevent/set second > random)
    for(i=0;i<8;i++){
      if(sumContents[i]==compWinCond){//comp wins
        bestOptionCount[0][0]++;
        bestOptionCount[0][1].push(i);
      }else if(sumContents[i]==playerWinCond){//comp needs to block win
        bestOptionCount[1][0]++;
        bestOptionCount[1][1].push(i);
      }else if(sumContents[i]==1 || sumContents[i]==4){
        bestOptionCount[2][0]++;
        bestOptionCount[2][1].push(i);
      }
    }

    //decide move and place down

    if(bestOptionCount[0][0]>0){//comp wins
      n=rowKey[bestOptionCount[0][1][0]];//array of three relevant posistions
      for(i=0;i<3;i++){
        if(isValid(n[i],1)){
          drawXorO(n[i]);
          break;
        }
      }
    }else if(bestOptionCount[1][0]>0){//comp blocks one possible win
      n=rowKey[bestOptionCount[1][1][0]];//array of three relevant posistions
      for(i=0;i<3;i++){
        if(isValid(n[i],1)){
          drawXorO(n[i]);
          break;
        }
      }
    }else if(bestOptionCount[2][0]>0){//comp randomly chooses to block or move toward win
      //chose random row/column/diag
      rnd=Math.floor(Math.random()*bestOptionCount[2][0]);
      n=rowKey[bestOptionCount[2][1][rnd]];
      //chose random starting pos for checking valid cell
      rnd=Math.floor(Math.random()*2);
      if(rnd===0){
        for(i=0;i<3;i++){
          if(isValid(n[i],1)){
            drawXorO(n[i]);
            break;
          }
        }
      }else{
          for(i=2;i>=0;i--){
            if(isValid(n[i],1)){
              drawXorO(n[i]);
              break;
            }
          }
        }
    }else{
      for(i=0;i<9;i++){
        if(isValid(i,1)){
          validPos.push(i);
        }
      }
      rnd=Math.floor((Math.random()*(validPos.length-1)));
      drawXorO(validPos[rnd]);
    }
  }
}
//working
function doSetTimeout(cells,side,baseTime,i,j){
  //cells array w/ 3 cell indicies
  //side is 1 for x, 0 for 0
  //base time is added to the delay
  //i used for delay
  //j used for sizing
  setTimeout(function(){
    clearCell(cells[0]);
    if(side===1){
      drawX(xoCoorKey[cells[0]][0],xoCoorKey[cells[0]][1],3*(1+j/190));
    }else{
      drawO(xoCoorKey[cells[0]][0],xoCoorKey[cells[0]][1],3*(1+j/190));
    }
  },i*10+baseTime);

  setTimeout(function(){
    clearCell(cells[1]);
    if(side===1){
      drawX(xoCoorKey[cells[1]][0],xoCoorKey[cells[1]][1],3*(1+j/190));
    }else{
      drawO(xoCoorKey[cells[1]][0],xoCoorKey[cells[1]][1],3*(1+j/190));
    }
  },i*10+250+baseTime);

  setTimeout(function(){
    clearCell(cells[2]);
    if(side===1){
      drawX(xoCoorKey[cells[2]][0],xoCoorKey[cells[2]][1],3*(1+j/190));
    }else{
      drawO(xoCoorKey[cells[2]][0],xoCoorKey[cells[2]][1],3*(1+j/190));
    }
  },i*10+500+baseTime);
}
//working
function drawWin(n,side){//draws win+
  //n is the win row
  //side is 1 for x, 0 for O (winning side)
  var cells=[rowKey[n][0],rowKey[n][1],rowKey[n][2]];
  var i;
  for(i=1;i<=50;i++){
    //increase size
    doSetTimeout(cells,side,0,i,i);
    //decrease size
    doSetTimeout(cells,side,500,i,Math.abs(i-51));
  }
}
//done
function setTurn(n){
  turn=n;
}
//done
function initialize() {
  initializeCanvas();
  //keyForX/O Coor placement
  xoCoorKey=[[height/6,height/6],[height/6,height/2],[height/6,5*height/6],[height/2,height/6],[height/2,height/2],[height/2,5*height/6],[5*height/6,height/6],[5*height/6,height/2],[5*height/6,5*height/6]];
  //clear cell location key
  cellKey=[[0,0],[0,height/3],[0,2*height/3],[height/3,0],[height/3,height/3],[height/3,2*height/3],[2*height/3,0],[2*height/3,height/3],[2*height/3,2*height/3]]
  initializeButtons();
  drawPhase0();
}
window.onload = initialize;
