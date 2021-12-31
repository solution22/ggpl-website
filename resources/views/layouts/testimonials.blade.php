                <style>
                    
                    /*.testim {
                    		width: 100%;
                    		-webkit-transform: translatey(-50%);
                    		-moz-transform: translatey(-50%);
                    		-ms-transform: translatey(-50%);
                    		-o-transform: translatey(-50%);
                    		transform: translatey(-50%);
                    }
                    
                    .testim .wrap {
                        position: relative;
                        width: 100%;
                        max-width: 1020px;
                        padding: 40px 20px;
                        margin: auto;
                    }*/
                    
                    .testim .arrow {
                        display: block;
                        position: absolute;
                        color: #eee;
                        cursor: pointer;
                        font-size: 2em;
                        top: 50%;
                        -webkit-transform: translateY(-50%);
                    		-ms-transform: translateY(-50%);
                    		-moz-transform: translateY(-50%);
                    		-o-transform: translateY(-50%);
                    		transform: translateY(-50%);
                        -webkit-transition: all .3s ease-in-out;    
                        -ms-transition: all .3s ease-in-out;    
                        -moz-transition: all .3s ease-in-out;    
                        -o-transition: all .3s ease-in-out;    
                        transition: all .3s ease-in-out;
                        padding: 5px;
                        z-index: 222;
                    }
                    
                    .testim .arrow:before {
                    		cursor: pointer;
                    }
                    
                    .testim .arrow:hover {
                        color: #ea830e;
                    }
                        
                    
                    .testim .arrow.left {
                        left: 10px;
                    }
                    
                    .testim .arrow.right {
                        right: 10px;
                    }
                    
                    .testim .dots {
                        text-align: center;
                        position: absolute;
                        width: 100%;
                        bottom: 60px;
                        left: 0;
                        display: block;
                        z-index: 333;
                    		height: 12px;
                    }
                    
                    .testim .dots .dot {
                        list-style-type: none;
                        display: inline-block;
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                        border: 1px solid #eee;
                        margin: 0 10px;
                        cursor: pointer;
                        -webkit-transition: all .5s ease-in-out;    
                        -ms-transition: all .5s ease-in-out;    
                        -moz-transition: all .5s ease-in-out;    
                        -o-transition: all .5s ease-in-out;    
                        transition: all .5s ease-in-out;
                    		position: relative;
                    }
                    
                    .testim .dots .dot.active,
                    .testim .dots .dot:hover {
                        background: #ea830e;
                        border-color: #ea830e;
                    }
                    
                    .testim .dots .dot.active {
                        -webkit-animation: testim-scale .5s ease-in-out forwards;   
                        -moz-animation: testim-scale .5s ease-in-out forwards;   
                        -ms-animation: testim-scale .5s ease-in-out forwards;   
                        -o-animation: testim-scale .5s ease-in-out forwards;   
                        animation: testim-scale .5s ease-in-out forwards;   
                    }
                        
                    .testim .cont {
                        position: relative;
                    		overflow: hidden;
                    }
                    
                    .testim .cont > div {
                        text-align: center;
                        position: absolute;
                        top: 0;
                        left: 0;
                        padding: 0 0 70px 0;
                        opacity: 0;
                    }
                    
                    .testim .cont > div.inactive {
                        opacity: 1;
                    }
                        
                    
                    .testim .cont > div.active {
                        position: relative;
                        opacity: 1;
                    }
                        
                    
                    .testim .cont div .img img {
                        display: block;
                        width: 100px;
                        height: 100px;
                        margin: auto;
                        border-radius: 50%;
                    }
                    
                    .testim .cont div h2 {
                        color: #4eb92d;
                        font-size: 1em;
                        margin: 15px 0;
                    }
                    
                    .testim .cont div p {
                        font-size: 1.15em;
                        color: #000;
                        width: 80%;
                        margin: auto;
                    }
                    
                    .testim .cont div.active .img img {
                        -webkit-animation: testim-show .5s ease-in-out forwards;            
                        -moz-animation: testim-show .5s ease-in-out forwards;            
                        -ms-animation: testim-show .5s ease-in-out forwards;            
                        -o-animation: testim-show .5s ease-in-out forwards;            
                        animation: testim-show .5s ease-in-out forwards;            
                    }
                    
                    .testim .cont div.active h2 {
                        -webkit-animation: testim-content-in .4s ease-in-out forwards;    
                        -moz-animation: testim-content-in .4s ease-in-out forwards;    
                        -ms-animation: testim-content-in .4s ease-in-out forwards;    
                        -o-animation: testim-content-in .4s ease-in-out forwards;    
                        animation: testim-content-in .4s ease-in-out forwards;    
                    }
                    
                    .testim .cont div.active p {
                        -webkit-animation: testim-content-in .5s ease-in-out forwards;    
                        -moz-animation: testim-content-in .5s ease-in-out forwards;    
                        -ms-animation: testim-content-in .5s ease-in-out forwards;    
                        -o-animation: testim-content-in .5s ease-in-out forwards;    
                        animation: testim-content-in .5s ease-in-out forwards;    
                    }
                    
                    .testim .cont div.inactive .img img {
                        -webkit-animation: testim-hide .5s ease-in-out forwards;            
                        -moz-animation: testim-hide .5s ease-in-out forwards;            
                        -ms-animation: testim-hide .5s ease-in-out forwards;            
                        -o-animation: testim-hide .5s ease-in-out forwards;            
                        animation: testim-hide .5s ease-in-out forwards;            
                    }
                    
                    .testim .cont div.inactive h2 {
                        -webkit-animation: testim-content-out .4s ease-in-out forwards;        
                        -moz-animation: testim-content-out .4s ease-in-out forwards;        
                        -ms-animation: testim-content-out .4s ease-in-out forwards;        
                        -o-animation: testim-content-out .4s ease-in-out forwards;        
                        animation: testim-content-out .4s ease-in-out forwards;        
                    }
                    
                    .testim .cont div.inactive p {
                        -webkit-animation: testim-content-out .5s ease-in-out forwards;    
                        -moz-animation: testim-content-out .5s ease-in-out forwards;    
                        -ms-animation: testim-content-out .5s ease-in-out forwards;    
                        -o-animation: testim-content-out .5s ease-in-out forwards;    
                        animation: testim-content-out .5s ease-in-out forwards;    
                    }
                    
                    @-webkit-keyframes testim-scale {
                        0% {
                            -webkit-box-shadow: 0px 0px 0px 0px #eee;
                            box-shadow: 0px 0px 0px 0px #eee;
                        }
                    
                        35% {
                            -webkit-box-shadow: 0px 0px 10px 5px #eee;        
                            box-shadow: 0px 0px 10px 5px #eee;        
                        }
                    
                        70% {
                            -webkit-box-shadow: 0px 0px 10px 5px #ea830e;        
                            box-shadow: 0px 0px 10px 5px #ea830e;        
                        }
                    
                        100% {
                            -webkit-box-shadow: 0px 0px 0px 0px #ea830e;        
                            box-shadow: 0px 0px 0px 0px #ea830e;        
                        }
                    }
                    
                    @-moz-keyframes testim-scale {
                        0% {
                            -moz-box-shadow: 0px 0px 0px 0px #eee;
                            box-shadow: 0px 0px 0px 0px #eee;
                        }
                    
                        35% {
                            -moz-box-shadow: 0px 0px 10px 5px #eee;        
                            box-shadow: 0px 0px 10px 5px #eee;        
                        }
                    
                        70% {
                            -moz-box-shadow: 0px 0px 10px 5px #ea830e;        
                            box-shadow: 0px 0px 10px 5px #ea830e;        
                        }
                    
                        100% {
                            -moz-box-shadow: 0px 0px 0px 0px #ea830e;        
                            box-shadow: 0px 0px 0px 0px #ea830e;        
                        }
                    }
                    
                    @-ms-keyframes testim-scale {
                        0% {
                            -ms-box-shadow: 0px 0px 0px 0px #eee;
                            box-shadow: 0px 0px 0px 0px #eee;
                        }
                    
                        35% {
                            -ms-box-shadow: 0px 0px 10px 5px #eee;        
                            box-shadow: 0px 0px 10px 5px #eee;        
                        }
                    
                        70% {
                            -ms-box-shadow: 0px 0px 10px 5px #ea830e;        
                            box-shadow: 0px 0px 10px 5px #ea830e;        
                        }
                    
                        100% {
                            -ms-box-shadow: 0px 0px 0px 0px #ea830e;        
                            box-shadow: 0px 0px 0px 0px #ea830e;        
                        }
                    }
                    
                    @-o-keyframes testim-scale {
                        0% {
                            -o-box-shadow: 0px 0px 0px 0px #eee;
                            box-shadow: 0px 0px 0px 0px #eee;
                        }
                    
                        35% {
                            -o-box-shadow: 0px 0px 10px 5px #eee;        
                            box-shadow: 0px 0px 10px 5px #eee;        
                        }
                    
                        70% {
                            -o-box-shadow: 0px 0px 10px 5px #ea830e;        
                            box-shadow: 0px 0px 10px 5px #ea830e;        
                        }
                    
                        100% {
                            -o-box-shadow: 0px 0px 0px 0px #ea830e;        
                            box-shadow: 0px 0px 0px 0px #ea830e;        
                        }
                    }
                    
                    @keyframes testim-scale {
                        0% {
                            box-shadow: 0px 0px 0px 0px #eee;
                        }
                    
                        35% {
                            box-shadow: 0px 0px 10px 5px #eee;        
                        }
                    
                        70% {
                            box-shadow: 0px 0px 10px 5px #ea830e;        
                        }
                    
                        100% {
                            box-shadow: 0px 0px 0px 0px #ea830e;        
                        }
                    }
                    
                    @-webkit-keyframes testim-content-in {
                        from {
                            opacity: 0;
                            -webkit-transform: translateY(100%);
                            transform: translateY(100%);
                        }
                        
                        to {
                            opacity: 1;
                            -webkit-transform: translateY(0);        
                            transform: translateY(0);        
                        }
                    }
                    
                    @-moz-keyframes testim-content-in {
                        from {
                            opacity: 0;
                            -moz-transform: translateY(100%);
                            transform: translateY(100%);
                        }
                        
                        to {
                            opacity: 1;
                            -moz-transform: translateY(0);        
                            transform: translateY(0);        
                        }
                    }
                    
                    @-ms-keyframes testim-content-in {
                        from {
                            opacity: 0;
                            -ms-transform: translateY(100%);
                            transform: translateY(100%);
                        }
                        
                        to {
                            opacity: 1;
                            -ms-transform: translateY(0);        
                            transform: translateY(0);        
                        }
                    }
                    
                    @-o-keyframes testim-content-in {
                        from {
                            opacity: 0;
                            -o-transform: translateY(100%);
                            transform: translateY(100%);
                        }
                        
                        to {
                            opacity: 1;
                            -o-transform: translateY(0);        
                            transform: translateY(0);        
                        }
                    }
                    
                    @keyframes testim-content-in {
                        from {
                            opacity: 0;
                            transform: translateY(100%);
                        }
                        
                        to {
                            opacity: 1;
                            transform: translateY(0);        
                        }
                    }
                    
                    @-webkit-keyframes testim-content-out {
                        from {
                            opacity: 1;
                            -webkit-transform: translateY(0);
                            transform: translateY(0);
                        }
                        
                        to {
                            opacity: 0;
                            -webkit-transform: translateY(-100%);        
                            transform: translateY(-100%);        
                        }
                    }
                    
                    @-moz-keyframes testim-content-out {
                        from {
                            opacity: 1;
                            -moz-transform: translateY(0);
                            transform: translateY(0);
                        }
                        
                        to {
                            opacity: 0;
                            -moz-transform: translateY(-100%);        
                            transform: translateY(-100%);        
                        }
                    }
                    
                    @-ms-keyframes testim-content-out {
                        from {
                            opacity: 1;
                            -ms-transform: translateY(0);
                            transform: translateY(0);
                        }
                        
                        to {
                            opacity: 0;
                            -ms-transform: translateY(-100%);        
                            transform: translateY(-100%);        
                        }
                    }
                    
                    @-o-keyframes testim-content-out {
                        from {
                            opacity: 1;
                            -o-transform: translateY(0);
                            transform: translateY(0);
                        }
                        
                        to {
                            opacity: 0;
                            transform: translateY(-100%);        
                            transform: translateY(-100%);        
                        }
                    }
                    
                    @keyframes testim-content-out {
                        from {
                            opacity: 1;
                            transform: translateY(0);
                        }
                        
                        to {
                            opacity: 0;
                            transform: translateY(-100%);        
                        }
                    }
                    
                    @-webkit-keyframes testim-show {
                        from {
                            opacity: 0;
                            -webkit-transform: scale(0);
                            transform: scale(0);
                        }
                        
                        to {
                            opacity: 1;
                            -webkit-transform: scale(1);       
                            transform: scale(1);       
                        }
                    }
                    
                    @-moz-keyframes testim-show {
                        from {
                            opacity: 0;
                            -moz-transform: scale(0);
                            transform: scale(0);
                        }
                        
                        to {
                            opacity: 1;
                            -moz-transform: scale(1);       
                            transform: scale(1);       
                        }
                    }
                    
                    @-ms-keyframes testim-show {
                        from {
                            opacity: 0;
                            -ms-transform: scale(0);
                            transform: scale(0);
                        }
                        
                        to {
                            opacity: 1;
                            -ms-transform: scale(1);       
                            transform: scale(1);       
                        }
                    }
                    
                    @-o-keyframes testim-show {
                        from {
                            opacity: 0;
                            -o-transform: scale(0);
                            transform: scale(0);
                        }
                        
                        to {
                            opacity: 1;
                            -o-transform: scale(1);       
                            transform: scale(1);       
                        }
                    }
                    
                    @keyframes testim-show {
                        from {
                            opacity: 0;
                            transform: scale(0);
                        }
                        
                        to {
                            opacity: 1;
                            transform: scale(1);       
                        }
                    }
                    
                    @-webkit-keyframes testim-hide {
                        from {
                            opacity: 1;
                            -webkit-transform: scale(1);       
                            transform: scale(1);       
                        }
                        
                        to {
                            opacity: 0;
                            -webkit-transform: scale(0);
                            transform: scale(0);
                        }
                    }
                    
                    @-moz-keyframes testim-hide {
                        from {
                            opacity: 1;
                            -moz-transform: scale(1);       
                            transform: scale(1);       
                        }
                        
                        to {
                            opacity: 0;
                            -moz-transform: scale(0);
                            transform: scale(0);
                        }
                    }
                    
                    @-ms-keyframes testim-hide {
                        from {
                            opacity: 1;
                            -ms-transform: scale(1);       
                            transform: scale(1);       
                        }
                        
                        to {
                            opacity: 0;
                            -ms-transform: scale(0);
                            transform: scale(0);
                        }
                    }
                    
                    @-o-keyframes testim-hide {
                        from {
                            opacity: 1;
                            -o-transform: scale(1);       
                            transform: scale(1);       
                        }
                        
                        to {
                            opacity: 0;
                            -o-transform: scale(0);
                            transform: scale(0);
                        }
                    }
                    
                    @keyframes testim-hide {
                        from {
                            opacity: 1;
                            transform: scale(1);       
                        }
                        
                        to {
                            opacity: 0;
                            transform: scale(0);
                        }
                    }
                    
                    @media all and (max-width: 300px) {
                    	body {
                    		font-size: 14px;
                    	}
                    }
                    
                    @media all and (max-width: 500px) {
                    	.testim .arrow {
                    		font-size: 1.5em;
                    	}
                    	
                    	.testim .cont div p {
                    		line-height: 25px;
                    	}
                    
                    }
                </style>
                
                <div class="col-lg-12">
                    <section id="testim" class="testim">
                        <div class="wrap">
            
                            <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                            <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                            <ul id="testim-dots" class="dots">
                                @if(count($testimonials) > 0)
                                    @foreach($testimonials as $testimonial)
                                        <li class="dot "></li>
                                    @endforeach
                                @endif
                            </ul>
                            <div id="testim-content" class="cont">
                                
                                @if(count($testimonials) > 0)
                                    @foreach($testimonials as $testimonial)
                                        <div class="">
                                            <div class="img">
                                                <img src="data:image/jpeg;base64,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" alt=""></div>
                                            <h2>{{$testimonial->name}}</h2>
                                            <p>{!!$testimonial->description!!}</p>                    
                                        </div>
                                    @endforeach
                                @endif
                                
                            </div>
            
                        </div>
                    </section>
                    <script src="https://use.fontawesome.com/1744f3f671.js"></script>
                </div>
                
                <script>
                    // vars
                    'use strict'
                    var	testim = document.getElementById("testim"),
                    		testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
                        testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
                        testimLeftArrow = document.getElementById("left-arrow"),
                        testimRightArrow = document.getElementById("right-arrow"),
                        testimSpeed = 4500,
                        currentSlide = 0,
                        currentActive = 0,
                        testimTimer,
                    		touchStartPos,
                    		touchEndPos,
                    		touchPosDiff,
                    		ignoreTouch = 30;
                    ;
                    
                    window.onload = function() {
                    
                        // Testim Script
                        function playSlide(slide) {
                            for (var k = 0; k < testimDots.length; k++) {
                                testimContent[k].classList.remove("active");
                                testimContent[k].classList.remove("inactive");
                                testimDots[k].classList.remove("active");
                            }
                    
                            if (slide < 0) {
                                slide = currentSlide = testimContent.length-1;
                            }
                    
                            if (slide > testimContent.length - 1) {
                                slide = currentSlide = 0;
                            }
                    
                            if (currentActive != currentSlide) {
                                testimContent[currentActive].classList.add("inactive");            
                            }
                            testimContent[slide].classList.add("active");
                            testimDots[slide].classList.add("active");
                    
                            currentActive = currentSlide;
                        
                            clearTimeout(testimTimer);
                            testimTimer = setTimeout(function() {
                                playSlide(currentSlide += 1);
                            }, testimSpeed)
                        }
                    
                        testimLeftArrow.addEventListener("click", function() {
                            playSlide(currentSlide -= 1);
                        })
                    
                        testimRightArrow.addEventListener("click", function() {
                            playSlide(currentSlide += 1);
                        })    
                    
                        for (var l = 0; l < testimDots.length; l++) {
                            testimDots[l].addEventListener("click", function() {
                                playSlide(currentSlide = testimDots.indexOf(this));
                            })
                        }
                    
                        playSlide(currentSlide);
                    
                        // keyboard shortcuts
                        document.addEventListener("keyup", function(e) {
                            switch (e.keyCode) {
                                case 37:
                                    testimLeftArrow.click();
                                    break;
                                    
                                case 39:
                                    testimRightArrow.click();
                                    break;
                    
                                case 39:
                                    testimRightArrow.click();
                                    break;
                    
                                default:
                                    break;
                            }
                        })
                    		
                    		testim.addEventListener("touchstart", function(e) {
                    				touchStartPos = e.changedTouches[0].clientX;
                    		})
                    	
                    		testim.addEventListener("touchend", function(e) {
                    				touchEndPos = e.changedTouches[0].clientX;
                    			
                    				touchPosDiff = touchStartPos - touchEndPos;
                    			
                    				console.log(touchPosDiff);
                    				console.log(touchStartPos);	
                    				console.log(touchEndPos);	
                    
                    			
                    				if (touchPosDiff > 0 + ignoreTouch) {
                    						testimLeftArrow.click();
                    				} else if (touchPosDiff < 0 - ignoreTouch) {
                    						testimRightArrow.click();
                    				} else {
                    					return;
                    				}
                    			
                    		})
                    }
                </script>