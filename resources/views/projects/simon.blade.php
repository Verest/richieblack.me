@extends('layout.main')

@section('title')
    Simon Game
@endsection

@section('css')
    <link href="{{url("/assets/css/simon.css")}}" rel="stylesheet">
@endsection

@section('content')
    <div class='simon-container'>
        <div class='content' id='click'>
            <div class='box tl dark-green' id='tl'>
                <audio loop id='tLAudio'><source src='{{url("/assets/audio/sound1.ogg")}}' type='audio/mpeg'></audio>
            </div>
            <div class='box tr dark-red' id='tr'>
                <audio loop id='tRAudio'><source src='{{url("/assets/audio/sound2.ogg")}}' type='audio/mpeg'></audio>
            </div>
            <div class='box bl dark-yellow' id='bl'>
                <audio loop id='bLAudio'><source src='{{url("/assets/audio/sound3.ogg")}}' type='audio/mpeg'></audio>
            </div>
            <div class='box br dark-blue' id='br'>
                <audio loop id='bRAudio'><source src='{{url("/assets/audio/sound4.ogg")}}' type='audio/mpeg'></audio>
            </div>

        </div> <!-- added -->

        <div class='box mid'>
            <div class="on-off-container float col-3">
                <div class="onOffIndicator" id="powerLight"></div>
                <button type="button" class="power" id='powerButton'>on/off</button><br>
            </div>

            <div class="start-container float col-3">
                <!-- <div class="invisibleIndicator"></div><br> -->
                <button type="button" class="start" id='startButton'>start</button><br>
            </div>

            <div class="strict-container float col-3">
                <div class="onOffIndicator" id="strictLight"></div>
                <button type="button" class="strict" id='strictButton'>strict</button><br>
            </div>
            <!-- </div> -->
            <div class='score-container center '>
                <p id="display">00</p>
            </div>
        </div> <!-- end box mid -->

    </div>
    <!--Simon End -->
@endsection

@section('js')
    <script>
        var mode, sequence, phase, currentNum, round;
        var tLCell,tRCell,bLCell,bRCell,powerInd,strictInd,display;
        var tLSound,tRSound,bLSound,bRSound;
        var locationFlag;
        var allDelays;
        var errorFlag;

        //done
        function toggleBackgroundColor(n){
            if(n===0){
                if(tLCell.className.match(/(?:^|\s)dark-green(?!\S)/)){
                    tLCell.className=tLCell.className.replace("dark",'light');
                }else{
                    tLCell.className=tLCell.className.replace("light",'dark');
                }
            }else if(n===1){
                if(tRCell.className.match(/(?:^|\s)dark-red(?!\S)/)){
                    tRCell.className=tRCell.className.replace("dark",'light');
                }else{
                    tRCell.className=tRCell.className.replace("light",'dark');
                }
            }else if(n===2){
                if(bLCell.className.match(/(?:^|\s)dark-yellow(?!\S)/)){
                    bLCell.className=bLCell.className.replace("dark",'light');
                }else{
                    bLCell.className=bLCell.className.replace("light",'dark');
                }
            }else if(n===3){
                if(bRCell.className.match(/(?:^|\s)dark-blue(?!\S)/)){
                    bRCell.className=bRCell.className.replace("dark",'light');
                }else{
                    bRCell.className=bRCell.className.replace("light",'dark');
                }
            }
        }

        //done
        function checkInsideCircle(e,x0,y0,rad){
            //separating this out to be easier to read, number of variables is still small
            //idRef technically unneeded as everything should be the same size, yet keeping here for now
            var x=e.offsetX;
            var y=e.offsetY;
            var largeRadSquared=Math.pow(rad,2);
            var smallRadSquared=Math.pow(rad/2,2);
            var lhs=Math.pow(x-x0,2)+Math.pow(y-y0,2);

            return (lhs<largeRadSquared && lhs >= smallRadSquared)
        }
        //done, mouse down only
        function clickTL(e){
            if(errorFlag === 0){
                var x0=tLCell.offsetWidth;
                var y0=x0;
                var rad=tLCell.offsetWidth;
                if(checkInsideCircle(e,x0,y0,rad) && phase==2){
                    locationFlag=0;
                    playSound(0);
                    toggleBackgroundColor(0);
                }
            }
        }

        //done
        function clickTR(e){
            if(errorFlag === 0){
                var x0=0;
                var y0=tRCell.offsetHeight;
                var rad=tLCell.offsetWidth;
                if(checkInsideCircle(e,x0,y0,rad) && phase==2){
                    locationFlag=1;
                    playSound(1);
                    toggleBackgroundColor(1);
                }
            }

        }

        //done
        function clickBL(e){
            if(errorFlag === 0 ){
                var x0=bLCell.offsetWidth;
                var y0=0;
                var rad=bLCell.offsetWidth;
                if(checkInsideCircle(e,x0,y0,rad) && phase==2){
                    locationFlag=2;
                    playSound(2);
                    toggleBackgroundColor(2);
                }
            }

        }

        //done
        function clickBR(e){
            if(errorFlag === 0 ){
                var x0=0;
                var y0=0;
                var rad=bRCell.offsetWidth;
                if(checkInsideCircle(e,x0,y0,rad) && phase==2){
                    locationFlag=3;
                    playSound(3);
                    toggleBackgroundColor(3);
                }
            }
        }

        //working, n mouse up
        function releaseClick(){
            if(errorFlag === 0){
                if(locationFlag===0){
                    stopSound();
                    toggleBackgroundColor(0);
                }else if(locationFlag===1){
                    stopSound();
                    toggleBackgroundColor(1);
                }else if(locationFlag===2){
                    stopSound();
                    toggleBackgroundColor(2);
                }else if(locationFlag===3){
                    stopSound();
                    toggleBackgroundColor(3);
                }

                if(locationFlag!==-1){
                    //check accuracy or what not here
                    if(locationFlag===sequence[round]){//correct input
                        if(round+1===currentNum){//last round
                            phase=3;
                            if(round===19){//won
                                updateCounter('Win!'); //need to make this flash at some point
                                resetGame();
                                setTimeout(function(){clickStart();},1000);
                            }else{
                                setTimeout(function(){getNextInSequence();},1000);
                            }
                            round=0;//reset round
                        }else{
                            round++;
                        }
                    }else{//incorrect input
                        //need some error sound or something...
                        errorFlag=1;
                        round = 0;
                        updateCounter('!!');//need to make this flash at some point
                        if(mode===0){
                            setTimeout(function(){playSequence();},1000);//play sequence again after 1 second
                        }else{
                            resetGame();
                            setTimeout(function(){clickStart();},1000);
                        }

                    }
                    locationFlag=-1;
                }
            }
        }

        //working
        function powerOn(){
            //change color of strict to red (for not on)
            strictInd.style.backgroundColor='#ff0000';
            //change color of power button to green
            powerInd.style.backgroundColor='#00ff00';

            phase=1;
        }

        //working, needs testing
        function clearAllTimeouts(){
            var i;
            for(i=0;i<allDelays.length;i++){
                clearTimeout(allDelays[i]);
            }
            allDelays=[];
        }

        //working
        function shutdown(){
            clearAllTimeouts();
            stopSound();
            updateCounter(0);

            if(tLCell.className.match(/(?:^|\s)light-green(?!\S)/)){
                toggleBackgroundColor(0);
            }
            if(tRCell.className.match(/(?:^|\s)light-red(?!\S)/)){
                toggleBackgroundColor(1);
            }
            if(bLCell.className.match(/(?:^|\s)light-yellow(?!\S)/)){
                toggleBackgroundColor(2);
            }
            if(bRCell.className.match(/(?:^|\s)light-blue(?!\S)/)){
                toggleBackgroundColor(3);
            }

            //changed strict color to off color
            strictInd.style.backgroundColor='#330000';

            //change power button color to off color
            powerInd.style.backgroundColor='#330000';

            mode=0;
            sequence=[];
            phase=0;
            currentNum=0;
            errorFlag = 0;
        }

        //working
        function clickPower(){
            if(phase===0){
                powerOn();
            }else{
                shutdown();
            }

        }

        //working
        function clickStart(){
            if(phase===1){
                phase=3;
                getNextInSequence();
            }
        }

        //working
        function resetGame(){
            clearAllTimeouts();
            phase=1;
            round=0;
            currentNum=0;
            errorFlag = 0;
            sequence=[];
        }

        //working
        function clickChangeMode(){
            if(phase===1 || phase===2){
                resetGame();
                if(mode===0){
                    strictInd.style.backgroundColor='#00ff00';
                    mode=1;
                }else{
                    strictInd.style.backgroundColor='#ff0000';
                    mode=0;
                }
            }
        }

        //working
        function getNextInSequence(){
            var rnd=Math.floor(Math.random()*4);
            currentNum++;
            updateCounter(currentNum);
            sequence[sequence.length]=rnd;
            playSequence();
        }

        //working
        function playDelay(n,lastFlag){
            allDelays[allDelays.length]= setTimeout(function(){playSound(sequence[n]);toggleBackgroundColor(sequence[n]);},n*1000);
            allDelays[allDelays.length]= setTimeout(function(){stopSound();toggleBackgroundColor(sequence[n]);},n*1000+800);
            if(lastFlag===1){
                allDelays[allDelays.length]= setTimeout(function(){phase=2; updateCounter(currentNum);},(n+1)*1000);
                errorFlag = 0;
            }
        }

        //working
        function playSequence(){
            var i, lastFlag=0;
            for(i=0;i<sequence.length;i++){
                if(i===sequence.length-1){
                    lastFlag=1;
                }
                playDelay(i,lastFlag);
            }

        }

        //done, although audio files crap atm
        function playSound(cell){
            //cell being 0 for TL, 1 for TR, 2 for BL, 3 for BR
            if(cell===0){
                tLSound.play();
            }
            else if(cell===1){
                tRSound.play();
            }
            else if(cell===2){
                bLSound.play();
            }
            else if(cell===3){
                bRSound.play();
            }
        }

        //done
        function stopSound(){
            //will stop all sounds being played
            tLSound.pause();
            tRSound.pause();
            bLSound.pause();
            bRSound.pause();
        }

        //done
        function updateCounter(n){
            //n being the value to replace it with
            if(n===parseInt(n,10)){//check if integer
                if(n<10){
                    display.innerHTML="0"+n;
                }else{
                    display.innerHTML=n;
                }
            }else{
                display.innerHTML=n;
            }
        }

        function playWin(){

        }
        //done
        function initializeButtons(){
            var powerB=document.getElementById('powerButton');
            var startB=document.getElementById('startButton');
            var strictB=document.getElementById('strictButton');

            powerB.onclick=function(){clickPower();};
            startB.onclick=function(){clickStart();};
            strictB.onclick=function(){clickChangeMode();};
        }

        function touchStart(e){
            e.preventDefault();

            if(e.target === tLCell){
                clickTL(e);
            }else if(e.target === tRCell){
                clickTR(e);
            }else if(e.target === bLCell){
                clickBL(e);
            }else if(e.target === bRCell){
                clickBR(e);
            }
        }

        function touchEnd(e){
            e.preventDefault();
            if(e.target === tLCell || e.target === tRCell || e.target === bLCell || e.target === bRCell){
                releaseClick();
            }
        }

        //done
        function initializeClicks(){


            document.addEventListener('touchstart', touchStart);
            document.addEventListener('touchstart', touchEnd);

            // tLCell.addEventListener('touchstart',clickTL);
            // tRCell.addEventListener('touchstart',clickTR);
            // bLCell.addEventListener('touchstart',clickBL);
            // bRCell.addEventListener('touchstart',clickBR);
            //
            //
            // tLCell.addEventListener('touchend',releaseClick);
            // tRCell.addEventListener('touchend',releaseClick);
            // bLCell.addEventListener('touchend',releaseClick);
            // bRCell.addEventListener('touchend',releaseClick);

            tLCell.addEventListener('mousedown',clickTL);
            tRCell.addEventListener('mousedown',clickTR);
            bLCell.addEventListener('mousedown',clickBL);
            bRCell.addEventListener('mousedown',clickBR);
            window.addEventListener('mouseup',releaseClick);
        }

        //working
        function initializeGlobals(){
            tLCell= document.getElementById('tl');
            tRCell= document.getElementById('tr');
            bLCell= document.getElementById('bl');
            bRCell= document.getElementById('br');
            powerInd= document.getElementById('powerLight');
            strictInd= document.getElementById('strictLight');
            display= document.getElementById('display');

            tLSound= document.getElementById('tLAudio');
            tRSound= document.getElementById('tRAudio');
            bLSound= document.getElementById('bLAudio');
            bRSound= document.getElementById('bRAudio');

            errorFlag = 0;
            mode=0;//0 for normal, 1 for strict
            sequence=[];//will hold current sequence
            phase=0;//0 off (ignore input, dont play anything), 1 on but not started, 2 waiting for input, 3 playing sequence (ignore input)
            currentNum=0;//refers to the current "turn" e.g. 1 through 20 (0 means game not started yet)
            round=0;//referes to the current round of the turn e.g. if on turn 19 this will range between 0 and 18 (0 based as used as index)

            locationFlag=-1;//-1 means mouse not held down, 0-3 means mouse held down on cell (0 tl, 1 tr, 2 bl, 3 br)

            allDelays=[];
        }

        //working
        function initialize(){
            initializeButtons();
            initializeGlobals();
            initializeClicks();
        }

        window.onload=initialize;

    </script>
@endsection
