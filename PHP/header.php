
	
<link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
<style>

	
	
	
	body{
		/* width: 80%; */
		background: grey; /* #e1d9d994  */
		margin: auto;
		/* max-width: 80%; */
		font-family: verdana, sans-serif;
		max-width: 1400px;
			width: 100%;
			transform: scale(1);
            transform-origin: 0 0;
	}
	

.header {
    margin: auto;
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
    /* background-image: url('images/Gemini_Generated_Image.jpeg'); */
    /* background-color: #94afcbba; */
    /* background-blend-mode: lighten; */
    background-position: top;
    /* box-shadow: 4px 7px 27px #94afcbba; */
    background-repeat: repeat;
    /* background-image: linear-gradient(140deg, #EADEDB 0%, #BC70A4 50%, #BFD641 75%); */
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);
    background: white;
    height: 125px;
    width: 100%;
    flex-direction: row;
    align-content: flex-end;
}

.inav {
    display: flex;
    justify-content: flex-end;  /* Align items to the right */
    align-items: center;
    padding: 10px 35px;
    width: 100%;
    gap: 6px; /* Adds spacing between buttons */
    flex-wrap: wrap; /* Prevents overflow on small screens */
}

.nbtn {
    color: #04203D;
    background-color: white;
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 15px;
    padding: 8px 15px;  /* Adjusted padding */
    line-height: 1.5; /* Ensures text is centered */
    height: auto;  /* Allows the button to adjust height automatically */
    border: none;
    border-radius: 5px;  /* Softer edges */
    cursor: pointer;
    transition: background 0.3s ease, color 0.3s ease; /* Smooth hover effect */
}

.nbtn:hover {
    background: #0d1f3d;
    color: white;
}

.inav span {
    font-size: larger;
    font-weight: bold;
}


	.logo{
		/* border-bottom: solid 2px #0d1f3d; */
		/* padding: 2px; */
		padding-left: 18px;
		padding-bottom: 36px; 
		margin-top: 0;
		width: 40%;
		font-family: "TIMES NEW ROMAN" !important;
		
	}
	.cand{
		margin-bottom: 4px;
		font-size: 40px;
		/* text-shadow: 0 0 2px #0d1f3d; */
		font-weight: bold;
		font-family: "TIMES NEW ROMAN" !important;
	}
	
	.ff-cand {
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";
    font-size: large;
    font-weight: bold;
    /* background: #ffffff4d; */
    /* -webkit-text-stroke: 0px #f3e5e5; */
    text-shadow: 0 0 12px #ffffff;
}
	
	.purple{
		color: #04468f;  /* #1a518b #0d1f3d */
	}	
	
	a{
		text-decoration: none;
		
	}
	
	.main{
		background: white;
		margin-top: 5px;
		padding: 10px 25px;
		
	}
	
	.foot{
		border-bottom: solid 2px #0d1f3d;
		/* border-top: solid 2px navy; */
		
		box-shadow: 0 4px 5px 0 gray;
		/*padding: 2px;*/
		margin: auto;
		
	
		font-family: Arial, "sans-serif";
		height: 110px;
		font-size: 13px;
	    display: flex;
        align-items: center;
        justify-content: center;
	    background-color: white;
		width: 100%;
		margin-top: 5px;
		
	}
	.foot a{
		color: #04203D;
	}
	
	
	.content{
		padding: 15px;
			
		font-family: Verdana, "sans-serif";
	}
	
	.h4{
	font-family: Verdana, 'sans-serif'; 
	background: #d1d6db; 
	color: black; 
	height: 45px;
	display: flex;
    align-items: center;
   justify-content: center;
	margin: 0px;
	margin-bottom: 20px;
	}
	.red{
		color: #7c0303; /* #FF0000  #c90101*/
	}
	
	#homeLink{
		color: black;
		cursor: pointer;
		text-decoration: none;

	}
	

/********** loading style ********************/
/* Add a unique container for the loader */
#loader-container .ring {
  position: fixed; /* Use fixed instead of absolute for better positioning */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 110px;
  height: 110px;
  background: transparent;
  border: 3px solid #3c3c3c;
  border-radius: 50%;
  text-align: center;
  line-height: 111px;
  font-family: sans-serif;
  font-size: 16px;
  color: #fff000;
  letter-spacing: 4px;
  text-transform: uppercase;
  text-shadow: 0 0 10px #fff000;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
  z-index: 1000; /* Ensure it's above other elements */
}

#loader-container .ring:before {
  content: '';
  position: absolute;
  top: -3px;
  left: -3px;
  width: 100%;
  height: 100%;
  border: 3px solid transparent;
  border-top: 3px solid #fff000;
  border-right: 3px solid #fff000;
  border-radius: 50%;
  animation: animateC 2s linear infinite;
  background: transparent; /* Ensure the span background is transparent */
}

#loader-container .spanL {
  position: absolute;
  top: calc(50% - 2px);
  left: 50%;
  width: 50%;
  height: 4px;
  background: transparent;
  transform-origin: left;
  animation: animate 2s linear infinite;
  background: transparent; /* Ensure the span background is transparent */
}

#loader-container .spanL:before {
  content: '';
  position: absolute;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #fff000;
  top: -6px;
  right: -8px;
  box-shadow: 0 0 20px #fff000;
}

@keyframes animateC {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate {
  0% {
    transform: rotate(45deg);
  }
  100% {
    transform: rotate(405deg);
  }
}

#loader-container #loadingmsg {
  color: white;
  background: transparent;
  padding: 10px;
  position: fixed;
  top: 50%;
  left: 46%;
  z-index: 1001; /* Above the ring */
  margin-right: -25%;
  margin-bottom: -25%;
}

#loader-container #loadingover {
  background: black;
  z-index: 999; /* Below the ring */
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  opacity: 0.8;
}
/********************************/


.highlight {
        color: green;
        cursor: pointer;
        position: relative;
    }

    .highlight:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        white-space: pre-wrap; /* Allows multi-line text */
        width: 110px; /* You can adjust the width as per your need */
        text-align: center;
		font-weight: bold;
    }
	
	 .highlight:hover {
        text-decoration: underline; /* Underline the link on hover */
    }
	</style>
<!--- <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css"> ---->

<header class="header">
  <div class="logo">
  <a href="index.php" id="homeLink">
		<h1 class="cand"><span class="purple">CanD</span><span class="red">Res</span>&nbsp;<!--<image src="can.png" width="30px" height="30px"> ---></h1>
	  <span class='ff-cand'><span class="purple"><em>Can</em></span><em>dida</em> <span class="purple">D</span>rug <span class="red">Res</span>istance database</span>
	  </a>
	</div>
	
	
	<div class="inav" align="right">
	<span>|</span><button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/index.php'"><i class="fa fa-home" ></i>  Home</button><span>|</span>
	<button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/browse.php'"><i class="fa-solid fa-gear" ></i>&nbsp;Browse</button><span>|</span>
	<button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/mutation-plot.php'" style="width: fit-content;"><i class="fa-solid fa-chart-simple"></i>&nbsp;&nbsp;Mutation Plot</button><span>|</span>
	  <!--- <button type="button" class="nbtn"><i class="fa-solid fa-wrench" ></i>&nbsp;Tools</button><span>|</span>---->
	  
	  
	  <button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/stats.php'"><i class="fa-solid fa-square-poll-vertical" ></i>&nbsp;Statistics</button><span>|</span>
	  
	  <button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/login.php'"><i class="fa-solid fa-link" ></i>&nbsp;Submit</button><span>|</span>
	  <button type="button" class="nbtn" onclick="window.location.href='https://candres.bicnirrh.res.in/help_page.php'"><i class="fa-solid fa-circle-question" ></i>&nbsp;Help</button><span>|</span>
    </div>
	
	
</header>

<script>
        document.addEventListener("DOMContentLoaded", function() {
           
            const defaultSearchTerms = document.querySelectorAll(".nbtn");

            defaultSearchTerms.forEach(term => {
                term.addEventListener("click", function(event) {
                    event.preventDefault();
                    
					showLoading();
                    //document.getElementById("search-form").submit();
                });
            });
        });
    </script>

<?php
//  include("loader.php");
?>
