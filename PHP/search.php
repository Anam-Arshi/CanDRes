<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search</title>
	<style>
       

        #container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
           /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); */
        }

        #search-box {
            width: 60%;
            padding: 10px;
            font-size: 16px;
        }

        #search-button {
            padding: 10px 13px;
            background-color: #94AFCB;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        #search-button:hover {
            background-color: #0056b3;
        }

        .default-search-term {
            color: #007bff;
            text-decoration: none;
            
        }

        .default-search-term:hover {
            color: black;
			font-weight: bold;
        }
		label{
			padding: 12px 20px;
            background-color: #A5BBD2;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 16px;
		}
		
		li{
			list-style: none;
			display: inline-block;
			background-color: lightgoldenrodyellow;
			padding: 3px;
			font-family:  "Lucida Sans", "DejaVu Sans", Verdana, "sans-serif";
			margin-right: 3px;
		}
		small{
			padding: 10px;
			
		}
		small span{
			
			font-size: 14.5px;
		}
		
    </style>
</head>

<body>
	<?php
	//include("header.php");
	?>
	
	
	
	
    <div id="container" align="center">
	<br>
        <form id="search-form" action="browse-result.php" method="GET" onsubmit="showLoading();">
            <!--- <label for="search-box">CanDRes</label>---->
            <input type="text" id="search-box" name="term" placeholder="Enter search terms separated by comma" />
            <button type="submit" id="search-button"><i class="fa fa-search" style=" color: #04203D; font-weight: bold; font-size: 20px;"></i></button>
        </form>
		
		<p style="margin-left:47%; font-size:14px; padding:0px; color:#04203D; display:inline;"><a href="advancedS.php" style="color:#04203D;">Advanced search</a></p>
		<br>
        <small>
        
			<span>Examples:&nbsp;</span><em>
            <li><a href="#" class="default-search-term">ERG11</a></li>
            <li><a href="#" class="default-search-term">Fluconazole</a></li>
            <li><a href="#" class="default-search-term">Y132F</a></li>
			<li><a href="#" class="default-search-term">C. albicans</a></li>
			</em>
			<!---- <li style="float:right; color:#04203D;"><a href="advancedS.php" style="color:#04203D;">Advanced search</a></li> ------->
			</small>
			
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchBox = document.getElementById("search-box");
            const searchButton = document.getElementById("search-button");
            const defaultSearchTerms = document.querySelectorAll(".default-search-term");

            defaultSearchTerms.forEach(term => {
                term.addEventListener("click", function(event) {
                    event.preventDefault();
                    const termText = this.textContent;
                    searchBox.value = termText;
					showLoading();
                    document.getElementById("search-form").submit();
                });
            });
			
			// Click event for search button
        searchButton.addEventListener("click", function(event) {
            if (searchBox.value.trim() === "") {
                event.preventDefault(); // Stop form submission
                alert("⚠️ Please enter a search term before submitting!");
                searchBox.focus();
            } else {
                showLoading(); // Proceed with submission if not empty
                searchForm.submit();
            }
        });
		
        });
		
		
   
    </script>

	


	
	
	
	
	
	<?php
	//include("foot.php");
	?>
</body>
</html>