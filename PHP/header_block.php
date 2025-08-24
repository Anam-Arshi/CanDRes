
	
<link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
<style>
/********** loading style ********************/
	.ring
{
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  width:110px;  //150px
  height:110px;
  background:transparent;
  border:3px solid #3c3c3c;
  border-radius:50%;
  text-align:center;
  line-height:111px;  //150px
  font-family:sans-serif;
  font-size:16px;
  color:#fff000;
  letter-spacing:4px;
  text-transform:uppercase;
  text-shadow:0 0 10px #fff000;
  box-shadow:0 0 20px rgba(0,0,0,.5);
  display: none;
  
}
.ring:before
{
  content:'';
  position:absolute;
  top:-3px;
  left:-3px;
  width:100%;
  height:100%;
  border:3px solid transparent;
  border-top:3px solid #fff000;
  border-right:3px solid #fff000;
  border-radius:50%;
  animation:animateC 2s linear infinite;
  
  
}
.spanL
{
  
  position:absolute;
  top:calc(50% - 2px);
  left:50%;
  width:50%;
  height:4px;
  background:transparent;
  transform-origin:left;
  animation:animate 2s linear infinite;
}
.spanL:before
{
  content:'';
  position:absolute;
  width:16px;
  height:16px;
  border-radius:50%;
  background:#fff000;
  top:-6px;
  right:-8px;
  box-shadow:0 0 20px #fff000;
}
@keyframes animateC
{
  0%
  {
    transform:rotate(0deg);
  }
  100%
  {
    transform:rotate(360deg);
  }
}
@keyframes animate
{
  0%
  {
    transform:rotate(45deg);
  }
  100%
  {
    transform:rotate(405deg);
  }
}


 #loadingmsg {
        /* color: black;
        background: #fff; */
        padding: 10px;
        position: fixed;
        top: 50%;
        left: 46%;
        z-index: 100;
        margin-right: -25%;
        margin-bottom: -25%;
    }

    #loadingover {
        background: black;
        z-index: 99;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
        filter: alpha(opacity=80);
        -moz-opacity: 0.8;
        -khtml-opacity: 0.8;
        opacity: 0.8;
    } 

/********************************/
	
	
	
	body{
		width: 80%;
		background: grey; /* #e1d9d994  */
		margin: auto;
		/* max-width: 80%; */
		font-family: verdana, sans-serif;
		
	}
	.inav {
    padding-right: 35px;
    /* box-shadow: 0 6px 5px 0 gray; */
    /* border: 1px solid #a5bbd2; */
    width: 54%;
	display: inline-block;
	} 

.header {
    margin: auto;
    display: block;
    
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
    
}

.nbtn {
    color: #04203D;
    background-color: white;
    
    height: 25px;
    border: 0px;
 /*    border-left: 2px solid #0d1f3d; */
    font-weight: bold;
    width: 13%;
    font-size: 15px;
}
	
	.nbtn:hover{
		background: #0d1f3d;
		color: white;
		cursor: pointer;
	}
	
	.inav button:first-child {
  
		border: 0;
		
}
.inav span{
	font-weight: bold;
	font-size: larger;
}

	.logo{
		/* border-bottom: solid 2px #0d1f3d; */
		/* padding: 2px; */
		padding-left: 18px;
		padding-bottom: 36px; 
		margin-top: 0;
		width: 40%;
		font-family: "TIMES NEW ROMAN";
		display: inline-block;
		
	}
	.cand{
		margin-bottom: 4px;
		font-size: 40px;
		/* text-shadow: 0 0 2px #0d1f3d; */
		font-weight: bold;
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
		width:100%;
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
	
/* Media query for screens smaller than 600px */
@media screen and (max-width: 600px) {
  body {
    font-size: 14px; /* Decrease font size for smaller screens */
	max-width: 40%;
  }
}

/* Media query for screens between 600px and 900px */
@media screen and (min-width: 600px) and (max-width: 900px) {
  body {
    font-size: 16px; /* Increase font size for medium screens */
	max-width: 80%;
  }
}

/* Media query for screens larger than 900px */
@media screen and (min-width: 900px) {
  body {
    /* font-size: 20px;  Increase font size even more for large screens */
	max-width: 85%;
  }
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
	<span>|</span><button type="button" class="nbtn" onclick="window.location.href='index.php'"><i class="fa fa-home" ></i>  Home</button><span>|</span>
	<button type="button" class="nbtn" onclick="window.location.href='browse.php'"><i class="fa-solid fa-gear" ></i>&nbsp;Browse</button><span>|</span>
	  <!--- <button type="button" class="nbtn"><i class="fa-solid fa-wrench" ></i>&nbsp;Tools</button><span>|</span>---->
	  <button type="button" class="nbtn" onclick="window.location.href='links.php'"><i class="fa-solid fa-link" ></i>&nbsp;Links</button><span>|</span>
	  
	  <button type="button" class="nbtn" onclick="window.location.href='stats.php'"><i class="fa-solid fa-square-poll-vertical" ></i>&nbsp;Statistics</button><span>|</span>
	  <button type="button" class="nbtn" onclick="window.location.href='Help_Page.pdf'"><i class="fa-solid fa-circle-question" ></i>&nbsp;Help</button><span>|</span>
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


