<?php 
session_start();
error_reporting(E_ALL);
//session_start();
include("connect.php");




?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
  var onloadCallback = function() {
   // alert("grecaptcha is ready!");
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
	//KEY ::   6Ld2_IgoAAAAAGc3DySB904JYGmmS0Hisb6my42o
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	

<script>
function validate(form) {
var response = grecaptcha.getResponse();
    
    if (response.length === 0) {
        // reCAPTCHA not verified, show an error message
        alert('Please complete the reCAPTCHA');
        return false;
    } else {
        // reCAPTCHA verified, proceed with form submission
        return true;
    }
	
var e = form.elements, m = '';

var alphaExp = /^[0-9a-zA-Z\s]+$/;
var sps = /^[\s]+$/;

   if(!e['nm'].value) {m += '- Name is required \n';}
	else if(e['nm'].value.match(sps)) {m += '- Name is required.\n';}
	if(!e['nm'].value.match(alphaExp)){ m += '- Name only alphabets allowed.\n';}
  if(!e['aff'].value) {m += '- Affiliation is required.\n';}
  if(!e['title'].value) {m += '- Title is required.\n';}
    if(!e['aim'].value) {m += '- Aim is required.\n';}
	
 if(!e['pub'].value) {m += '- Select if the data is published.\n';}
	else if(e['pub'].value == "yes"){  if(!e['pmid'].value) {m += '- Enter PMID/DOI.\n';}
									 else if(!e['jrn_yp'].value) {m += '- Journal and year is required.\n';} }
	  
	//if(!e['duratn'].value) {m += '- Duration is required.\n';}  
	var stdes = e['st_des[]'];
	
	// Check if at least one study design is selected
		if (!anyCheckboxChecked(stdes)) {
			m += '- At least one study design is required.\n';
		}

// Function to check if at least one checkbox is checked
		function anyCheckboxChecked(checkboxes) {
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].checked) {
					return true; // At least one checkbox is checked
				}
			}
			return false; // No checkbox is checked
		}

	//if(!e['st_des[]'].checked) {m += '- Study design is required.\n';} 
	//if(!e['setup[]'].value) {m += '- Setup is required.\n';} 
	
	var setup = e['setup[]'];
	if (!anyCheckboxChecked(setup)) {
			m += '- At least one setup is required.\n';
		}

	
	if(!e['loca'].value) {m += '- Location is required.\n';} 
	
	 
	var risk = e['risk[]'];
	if (!anyCheckboxChecked(risk)) {
			m += '- Risk factor is required.\n';
		}
	
	var comorb = e['comorb[]'];
	if (!anyCheckboxChecked(comorb)) {
			m += '- Comorbidity is required.\n';
		}
	
	var typcan = e['typ_can[]'];
	if (!anyCheckboxChecked(typcan)) {
			m += '- Type of candidiasis is required.\n';
		}
	
	var niche = e['niche[]'];
	if (!anyCheckboxChecked(niche)) {
			m += '- Niche infected is required.\n';
		}
	
	var symp = e['symp[]'];
	if (!anyCheckboxChecked(symp)) {
			m += '- Symptom is required.\n';
		}
	
	/* 
	if(!e['anti'].value) {m += '- Select if the drug is prescribed.\n';}
	else if(e['anti'].value == "yes"){  if(!e['drug'].value) {m += '- Enter Drugs.\n';} } */
	
	if(!e['age'].value) {m += '- Age is required.\n';}
	
	
	function anyInput(Input) {
			for (var i = 0; i < Input.length; i++) {
				if (Input[i].value) {
					return true; // At least one checkbox is checked
				}
			}
			return false; // No checkbox is checked
		}

	
	/*var gen = e['gender[]'];
	if (!anyInput(gen)) {
			m += '- Gender is required.\n';
		}*/
	
	if(!e['no_pat'].value) {m += '- Number of patients is required.\n';}
	if(!e['no_sam'].value) {m += '- Number of samples is required.\n';}
	if(!e['no_can'].value) {m += '- Number of candida isolates is required.\n';}
	if(!e['inf_pre'].value) {m += '- Infection prevalence is required.\n';}
	if(!e['mortal'].value) {m += '- Mortality is required.\n';}
	
	 /* 
	
	if(!e['sps_pre'].value) {m += '- Species prevalence is required.\n';}
	*/
	
	var ident = e['ident[]'];
	if (!anyCheckboxChecked(ident)) {
			m += '- Species identification method is required.\n';
		}
	
	
 /* if(!e['email'].value) {m += '- Email ID is required.\n';}
  else if(e['email'].value.match(sps)) {m += '- Email ID is required.\n';}
  else if (echeck(e['email'].value)==false){  m += '- Invalid Email ID.\n'; 
  }*/
    	
   
  if(m) {
    alert('The following error(s) occurred:\n\n' + m);
    return false;
	 
  }
else{
  return true;
	
}
	
}

	$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
	</script>

<style>
	main{
		padding: 10px 50px;
	}	
	.submit input{
		box-sizing: border-box;
		border: 2px solid black;
		font-size: medium;
		padding: 5px;
	    	
		width: 400px;
	}
	select{
		background-color: #175161;
        color: white;
        padding: 8px;
        width: 250px;
        border: none;
        font-size: medium;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.2);
       -webkit-appearance: button;
        appearance: button;
        outline: none;
	}
	textarea{
		box-sizing: border-box;
		border: 2px solid black;
		font-size: medium;
		padding: 5px;
		
	}
	.square_btn{
    display: inline-block;
    padding: 0.5em 1em;
    text-decoration: none;
    background: #175161;/*Button Color*/
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
	cursor: pointer;
}
.square_btn:active {/*on Click*/
    -ms-transform: translateY(4px);
    -webkit-transform: translateY(4px);
    transform: translateY(4px);/*Move down*/
    border-bottom: none;/*disappears*/
}
.chkbx input{
	width: auto;
	margin: 5px;
}
	h5{
		color: red;
		display: inline;
	}
	
	/* dropdownCheckbox */
.multiselect {
  width: 60%;
  margin-bottom: 5px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.mySelectOptions {
  display: none;
  border: 0.5px #7c7c7c solid;
  background-color: #ffffff;
  max-height: 150px;
  overflow-y: scroll;
}

.mySelectOptions label {
  display: block;
  font-weight: normal;
  
  white-space: nowrap;
  min-height: 1.5em;
  background-color: #ffffff;
  padding: 0 2.25rem 0 .75rem;
  /* padding: .375rem 2.25rem .375rem .75rem; */
}

.mySelectOptions label:hover {
  background-color: #1e90ff;
}
	.mySelectOptions input{
		width: 20px;
	}
/* ------- */
	.input-container {
    margin-top: 10px;
  }
  
  
	
</style>
	
<link href="phptextcaptcha/css/stylecap.css" rel="stylesheet">

</head>

<body>
<?php
include("header2.php");	
?>
	
<main class="submit">
<h3 align="center">Submit data</h3>
<p><h5>*</h5> - Mandatory</p>

<form method ="POST"  action="user_data.php" name="form1" id="form1" onSubmit="return validate(this);">
<table width="1150px" border="0" cellspacing="2" cellpadding="7">

<tr>

<td width="47%">
<strong>Name of submitter <h5>*</h5></strong>
</td>

<td>
<input type="text" name="nm"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Affiliation of submitter <h5>*</h5></strong>
</td>

<td>
<input type="text" name="aff" ></input>
</td>

</tr>


<tr>

<td width="45%">
<strong>Title of study <h5>*</h5></strong>
</td>

<td>
<input type="text" name="title" size="45" ></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Aim of study <h5>*</h5></strong>
</td>

<td>
<input type="text" name="aim" ></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Is this data published? <h5>*</h5></strong>
</td>

<td>

<?php
(isset($_POST["pub"])) ? $pub = $_POST["pub"] : $pub = ""; 
?>



<input type="radio" value="yes" name="pub" style="display: inline; width: 20px;" onclick="showHide('yes')" />Yes
<input type="radio" value="no" name="pub" style="display: inline; width: 20px;" onclick="showHide('no')"/>No


</td>

</tr>
<tr id="hidden-field" style="display: none;">
<td width="47%">
<strong>PMID/DOI<h5>*</h5></strong>
	
</td>
	
<td>
	
      
<input type="text" name="pmid" placeholder=""></input>

	
	
	</td>

</tr>
<tr id="yop" style="display: none;">

<td width="47%">
<strong>Journal and Year <h5>*</h5></strong>
</td>

<td>
<input type="text" name="jrn_yp"></input>

</td>

</tr>
<script type="text/javascript">
  function showHide(action) {
    let pub = action;
	  
    if (pub == "yes") {
      document.getElementById('hidden-field').style.display = 'table-row';
	  document.getElementById('yop').style.display = 'table-row';
    } else {
      document.getElementById('hidden-field').style.display = 'none';
	  document.getElementById('yop').style.display = 'none';
    }
  }
</script>
<tr>


<td width="47%">
<strong>Start date <h5>*</h5></strong>
</td>

<td>
<input type="date" name="stdate" id="start-date"></input>
</td>

</tr>

<tr>

<td width="47%">
<strong>End date <h5>*</h5></strong>
</td>

<td>
<input type="date" name="enddate" id="end-date"></input>
</td>

</tr>

<tr>

<td width="47%">
<strong>Duration <h5></h5></strong>
</td>

<td>
	<input type="hidden" name="duratn" id='duratn'/>
<p id="result"></p>

<script>

            function calculateDuration() {
            const startDateInput = document.getElementById("start-date");
            const endDateInput = document.getElementById("end-date");
            const resultElement = document.getElementById("result");

            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (!startDateInput.value || !endDateInput.value) {
                resultElement.textContent = "Please enter both start and end dates.";
            } else if (isNaN(startDate) || isNaN(endDate)) {
                resultElement.textContent = "Invalid date(s). Please enter valid dates.";
            } else if (startDate > endDate) {
                resultElement.textContent = "End date must be greater than or equal to start date.";
            } else {
                let years = endDate.getFullYear() - startDate.getFullYear();
        let months = endDate.getMonth() - startDate.getMonth();
        let days = endDate.getDate() - startDate.getDate();

        if (days < 0) {
            months--; // Adjust months if days are negative
            days += new Date(endDate.getFullYear(), endDate.getMonth(), 0).getDate();
        }

        if (months < 0) {
            years--; // Adjust years if months are negative
            months += 12;
        }
       
        let resultText = `Duration: `;
		if (years > 0) {
            resultText += `${years} years`;
        }


        if (months > 0) {
            resultText += ` ${months} months`;
        }

        if (days > 0) {
            resultText += ` and ${days} days`;
        }

        resultElement.textContent = resultText;
		document.getElementById('duratn').value = resultText;
            }
        }

        const startDateInput = document.getElementById("start-date");
        const endDateInput = document.getElementById("end-date");

        startDateInput.addEventListener("input", calculateDuration);
        endDateInput.addEventListener("input", calculateDuration);
</script>

</td>

</tr>
<tr>

<td width="47%">
<strong>Study design <h5>*</h5></strong>
</td>

<td>

<div id="StuDesMultiselect" class="multiselect">
      <div id="StuDes" class="selectBox" onclick="toggleCheckboxAreaStuDes()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="StuDesSelectOptions" class="mySelectOptions">
		  <label for='Prospective'><input type='checkbox' id='Prospective' onchange='checkboxStatusChangeStuDes()' value='Prospective' name='st_des[]' />Prospective</label>
		  <label for='Retrospective'><input type='checkbox' id='Retrospective' onchange='checkboxStatusChangeStuDes()' value='Retrospective' name='st_des[]' />Retrospective</label>
		  <label for='Cross-sectional'><input type='checkbox' id='Cross-sectional' onchange='checkboxStatusChangeStuDes()' value='Cross-sectional' name='st_des[]' />Cross-sectional</label>
		  <label for='Case-control'><input type='checkbox' id='Case-control' onchange='checkboxStatusChangeStuDes()' value='Case-control' name='st_des[]' />Case-control</label>
		  <label for='Longitudinal'><input type='checkbox' id='Longitudinal' onchange='checkboxStatusChangeStuDes()' value='Cross-sectional' name='st_des[]'/>Longitudinal</label>
        <label for='other' ><input type='checkbox' id='otherStuDes' value='other' onClick="showHideStuDes()" name='st_des[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-fieldStuDes" style="display: none;">
      
<input type="text" name="other_StuDes" placeholder="Enter study design" ></input>

</div>

<script type="text/javascript">
  function showHideStuDes() {
    let studdes = document.getElementById('otherStuDes');
	
    if (studdes.checked == true){
      document.getElementById('hidden-fieldStuDes').style.display = 'block';
    } else {
      document.getElementById('hidden-fieldStuDes').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#StuDesMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#StuDesSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeStuDes() {
  var multiselect = document.getElementById("StuDes");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("StuDesSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaStuDes(onlyHide = false) {
  var checkboxes = document.getElementById("StuDesSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
</td>

</tr>
<br/>
<tr>




<td width="47%">
<strong>Setup <h5>*</h5></strong>
</td>

<td>
<div id="SetupMultiselect" class="multiselect">
      <div id="Setup" class="selectBox" onclick="toggleCheckboxAreaSetup()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="SetupSelectOptions" class="mySelectOptions">
		  <label for='Prospective'><input type='checkbox' id='Hospital' name='setup[]' onchange='checkboxStatusChangeSetup()' value='Hospital'  />Hospital</label>
		  <label for='Clinic'><input type='checkbox' id='Clinic' onchange='checkboxStatusChangeSetup()' value='Clinic' name='setup[]'/>Clinic</label>
		  <label for='Laboratory'><input type='checkbox' id='Laboratory' onchange='checkboxStatusChangeSetup()' value='Laboratory' name='setup[]'/>Laboratory</label>
		  <label for='Community'><input type='checkbox' id='Community' onchange='checkboxStatusChangeSetup()' value='Community' name='setup[]'/>Community</label>
		  
        <label for='other' ><input type='checkbox' id='otherSetup' value='other' onClick="showHideSetup()" name='setup[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-fieldSetup" style="display: none;">
      
<input type="text" name="other_Setup" placeholder="Enter setup" ></input>

</div>

<script type="text/javascript">
  function showHideSetup() {
    let setup = document.getElementById('otherSetup');
	
    if (setup.checked == true){
      document.getElementById('hidden-fieldSetup').style.display = 'block';
    } else {
      document.getElementById('hidden-fieldSetup').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#SetupMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#SetupSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeSetup() {
  var multiselect = document.getElementById("Setup");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("SetupSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaSetup(onlyHide = false) {
  var checkboxes = document.getElementById("SetupSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
 


</td>


</tr>
<tr>

<td width="47%">
<strong>Hospital name <h5>*</h5></strong>

</td>
<td>
<input type="text" name="loca"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Ethnicity of patients</strong>
</td>

<td>
<input type="text" name="ethn"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Risk factors <h5>*</h5></strong>
</td>

<td>
<!-- <input type="text" name="risk"></input> ---->
<div id="riskMultiselect" class="multiselect">
      <div id="risk" class="selectBox" onclick="toggleCheckboxArea(this.id)">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="riskSelectOptions" class="mySelectOptions">
		  <?php
		  $riskFactors = array('Pregnancy', 'Oral contraceptives', 'Antibiotic use', 'Hospital stay', 'Alcohol intake', 'Smoking', 'Steroid use', 'Use of catheters', 'Sexual behaviour') ;
		  for($i = 0; $i < count($riskFactors); $i++)
             {
	             $ris = $riskFactors[$i];
			     
	             echo "<label for='$ris'><input type='checkbox' id='$ris' onchange='checkboxStatusChangeRisk()' value='$ris' name='risk[]' />$ris</label>";
	
            }
		  ?>
        <label for='other' ><input type='checkbox' id='otherRisk' value='other' name='risk[]' onClick="showHideRisk()"/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-field-Risk" style="display: none;">
      
<input type="text" name="other_risk" placeholder="Enter risk factor" ></input>

</div>

<script type="text/javascript">
  function showHideRisk() {
    let risk = document.getElementById('otherRisk');
	
    if (risk.checked == true){
      document.getElementById('hidden-field-Risk').style.display = 'block';
    } else {
      document.getElementById('hidden-field-Risk').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#riskMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#riskSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeRisk() {
  var multiselect = document.getElementById("risk");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("riskSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxArea(id) {
  var checkboxes = document.getElementById(id+"SelectOptions");
  var displayValue = checkboxes.style.display;
  var onlyHide = false;
  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>

</td>

</tr>
<tr>

<td width="47%">
<strong>Comorbidities <h5>*</h5></strong>
</td>

<td>
<!--- <input type="text" name="comorb"></input> --->
<div id="comMultiselect" class="multiselect">
      <div id="com" class="selectBox" onclick="toggleCheckboxArea(this.id)">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="comSelectOptions" class="mySelectOptions">
		  <?php
		  $comob = array('Diabetes', 'HIV', 'Cancer', 'Lepromatous leprosy', 'Gastroenteritis', 'Tuberculosis', 'Chronic kidney disease', 'Chronic obstructive pulmonary disease') ;
		  for($i = 0; $i < count($comob); $i++)
             {
	             $com = $comob[$i];
			     
	             echo "<label for='$com'><input type='checkbox' id='$com' onchange='checkboxStatusChangeCom()' value='$com' name='comorb[]' />$com</label>";
	
            }
		  ?>
        <label for='other' ><input type='checkbox' id='otherCom' value='other' onClick="showHideCom()" name='comorb[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-field-Com" style="display: none;">
      
<input type="text" name="other_com" placeholder="Enter comorbidities" ></input>

</div>

<script type="text/javascript">
  function showHideCom() {
    let risk = document.getElementById('otherCom');
	
    if (risk.checked == true){
      document.getElementById('hidden-field-Com').style.display = 'block';
    } else {
      document.getElementById('hidden-field-Com').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#comMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#comSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeCom() {
  var multiselect = document.getElementById("com");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("comSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}
</script>

</td>

</tr>
<tr>

<td width="47%">
<strong>Type of candidiasis <h5>*</h5></strong>
</td>

<td>
<!--  <input type="text" name="typ_can"></input> --->
	

 <!--   <label for="myMultiselect">BS custom multiselect</label> --->
    <div id="TypCanMultiselect" class="multiselect">
      <div id="TypCan" class="selectBox" onclick="toggleCheckboxAreaTypCan()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="TypCanSelectOptions" class="mySelectOptions">
		  <?php
		  $getTypCan = mysqli_query($conn, "select distinct type_of_candidiasis from candidiasis where type_of_candidiasis !='-' order by type_of_candidiasis ASC");
		  while($rowcan=mysqli_fetch_array($getTypCan))
             {
	             $can = $rowcan["type_of_candidiasis"];
			     $can = strtolower($can);
			     $can = ucfirst($can);
	             echo "<label for='$can'><input type='checkbox' id='$can' onchange='checkboxStatusChangeTypCan()' value='$can' name='typ_can[]' />$can</label>";
	
            }
		  ?>
        <label for='other' ><input type='checkbox' id='otherTypCan' value='other' name='typ_can[]' onClick="showHide4()"/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-field4" style="display: none;">
      
<input type="text" name="other_typcan" placeholder="Enter type of candidiasis" ></input>

</div>

<script type="text/javascript">
  function showHide4() {
    let typcan = document.getElementById('otherTypCan');
	
    if (typcan.checked == true){
      document.getElementById('hidden-field4').style.display = 'block';
    } else {
      document.getElementById('hidden-field4').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#TypCanMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#TypCanSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeTypCan() {
  var multiselect = document.getElementById("TypCan");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("TypCanSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaTypCan(onlyHide = false) {
  var checkboxes = document.getElementById("TypCanSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
</td>

</tr>
<tr>

<td width="47%">
<strong>Niche infected <h5>*</h5></strong>
</td>

<td>
<!-- <input type="text" name="niche"></input> --->
<div id="NicMultiselect" class="multiselect">
      <div id="Nic" class="selectBox" onclick="toggleCheckboxAreaNic()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="NicSelectOptions" class="mySelectOptions">
		  <?php
		  $getni = mysqli_query($conn, "select distinct niche from niche_infected where niche !='-' order by niche ASC");
		  while($rowni=mysqli_fetch_array($getni))
             {
	             $nic = $rowni["niche"];
			  
			     $nic = strtolower($nic);
			     $nic = ucfirst($nic);
			  
	             echo "<label for='$nic'><input type='checkbox' id='$nic' onchange='checkboxStatusChangeNic()' value='$nic' name='niche[]' />$nic</label>";
	
            }
		  ?>
        <label for='other' onChange="showHide5()"><input type='checkbox' id='otherNiche' value='other' name='niche[]' />Other</label>
      </div>
    </div>
 
	
	<div id="hidden-field5" style="display: none;">
      
<input type="text" name="other_nic" placeholder="Enter niche" ></input>

</div>

<script type="text/javascript">
  function showHide5() {
    let niche = document.getElementById('otherNiche');
    if (niche.checked == true) {
      document.getElementById('hidden-field5').style.display = 'block';
    } 
	  else {
      document.getElementById('hidden-field5').style.display = 'none';
    }
  }
	
	
	$(document).on("click", function(event){
       var $trigger = $("#NicMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#NicSelectOptions").slideUp("fast");
        }            
    });
	
	
	function checkboxStatusChangeNic() {
  var multiselect = document.getElementById("Nic");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("NicSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaNic(onlyHide = false) {
  var checkboxes = document.getElementById("NicSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
</script>
	
</td>

</tr>
<tr>

<td width="47%">
<strong>Signs and symptoms of candidiasis <h5>*</h5></strong>
</td>

<td>
<div id="SympMultiselect" class="multiselect">
      <div id="Symp" class="selectBox" onclick="toggleCheckboxAreaSymp()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="SympSelectOptions" class="mySelectOptions">
		  <label for='dental'><input type='checkbox' id='dental' onchange='checkboxStatusChangeSymp()' value='Dental caries' name='symp[]'/>Dental caries</label>
		 <label for='dyspar'><input type='checkbox' id='dyspar' onchange='checkboxStatusChangeSymp()' value='Dyspareunia' name='symp[]'/>Dyspareunia</label>
		 <label for='dysuria'><input type='checkbox' id='dysuria' onchange='checkboxStatusChangeSymp()' value='Dysuria' name='symp[]'/>Dysuria</label>
		 <label for='fever'><input type='checkbox' id='fever' onchange='checkboxStatusChangeSymp()' value='Fever' name='symp[]'/>Fever</label>
		 <label for='oral'><input type='checkbox' id='oral' onchange='checkboxStatusChangeSymp()' value='Oral lesions' name='symp[]'/>Oral lesions</label>
		 <label for='burn'><input type='checkbox' id='burn' onchange='checkboxStatusChangeSymp()' value='Vaginal burning & redness' name='symp[]'/>Vaginal burning & redness</label>
		 <label for='disch'><input type='checkbox' id='disch' onchange='checkboxStatusChangeSymp()' value='Vaginal discharge' name='symp[]'/>Vaginal discharge</label>
		 <label for='itch'><input type='checkbox' id='itch' onchange='checkboxStatusChangeSymp()' value='Vaginal itching' name='symp[]'/>Vaginal itching</label>
        <label for='other' ><input type='checkbox' id='otherSymp' value='other' onClick="showHideSymp()" name='symp[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-fieldSymp" style="display: none;">
      
<input type="text" name="other_symp" placeholder="Enter symptoms" ></input>

</div>

<script type="text/javascript">
  function showHideSymp() {
    let Symph = document.getElementById('otherSymp');
	
    if (Symph.checked == true){
      document.getElementById('hidden-fieldSymp').style.display = 'block';
    } else {
      document.getElementById('hidden-fieldSymp').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#SympMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#SympSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeSymp() {
  var multiselect = document.getElementById("Symp");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("SympSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaSymp(onlyHide = false) {
  var checkboxes = document.getElementById("SympSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
</td>

</tr>
<tr>

<td width="47%">
<strong>Antifungal drug(s) prescribed  <h5>*</h5></strong>
</td>

<td width="200px"> 

<input type="radio" value="yes" name="anti" style="display: inline; width: 20px;" onclick="showHide3('yes')" />Yes
<input type="radio" value="no" name="anti" style="display: inline; width: 20px;" onclick="showHide3('no')"/>No
<br>
	<br>
<div id="hidden-field3" style="display: none;" width="200px">
      
<!--- <input type="text" name="drug" placeholder="Enter name of drug(s)"></input> --->
<table border="1" style="border-collapse:collapse;" width="100px" cellspacing='6' cellpadding='6' id="drugTable">
<tr><th>Drug</th><th>Mode of Administration</th><th>Dose</th><th></th></tr>
<tr>
<td width="30px">

        <select name="drugDtl[]" style="width:200px;">
          <option value="">Select option</option>
        
        
     
      
		  <?php
		  $getAFD = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
		  while($rowafd=mysqli_fetch_array($getAFD))
             {
	             $afd = $rowafd["Drug"];
				 
	             echo "<option value=$afd>$afd</option>";
	
            }
		  ?>
        
		<option value="other" onClick="showHideAFD()" id='otherAFD'>Other</option>
    </select>
	<br>
   <div id="hidden-field_afd" style="display: none;" style="width:200px;">
      
<input type="text" name="other_afd" placeholder="Enter drug name" style="width:200px;"></input>

</div>
	</td>
	<td>
	<select name="route[]" style="width:200px;">
          <option value="">Select option</option>
        <option value="auri">Auricular (OTIC)</option>
        
     
      
		  <?php
		  $routes = mysqli_query($conn, "select routes from route");
		  $cn = 0;
		  while($rout=mysqli_fetch_array($routes))
             {
				 if($cn != 0){
	              $route = strtolower($rout["routes"]);
				 $rou = ucfirst($route); 
				 
				 
	             echo "<option value=$rou>$rou</option>";
				 }
				 $cn++;
	
            }
		  ?>
        
    </select>
	</td>
	<td>
	<input type="text" name="dose[]" placeholder="" style="width:200px;"></input>
	</td>
	<td>
      <i class='fa-duotone fa-plus' title="Add row" style="font-weight: bold;cursor: pointer; background: #C5E3EB; padding: 0px 2px; font-size: small;" onclick="addRow()"></i>
      
    </td>
	</tr>
 </table>
	
	
</div>
<script>
function addRow() {
    const table = document.getElementById('drugTable');
    
    var lastRow = table.rows[1];
    var newRow = lastRow.cloneNode(true);

    // Clear the selected options in the new row
    var select = newRow.getElementsByTagName("select")[0];
    select.selectedIndex = 0;

    // You can modify other elements in the new row if needed

    // Add a "Remove Row" button to the new row
    var closeButton = document.createElement("i");
      closeButton.className = "fas fa-times-circle close-btn";
      closeButton.style.fontSize = "small";
      closeButton.style.padding = "0px 2px";
      closeButton.style.color = "red";
      closeButton.style.cursor = "pointer";
	
    closeButton.onclick = function() {
        removeRow(this);
    };
    var cell = newRow.cells[newRow.cells.length - 1];
    cell.appendChild(closeButton);

    table.appendChild(newRow);
  }
  
  function removeRow(button) {
    var row = button.parentNode.parentNode; // Get the row containing the button
    var table = row.parentNode; // Get the table containing the row
    table.removeChild(row);
}
</script>

<script type="text/javascript">
  function showHideAFD() {
    let afd = document.getElementById('otherAFD');
	
    if (afd.checked == true){
      document.getElementById('hidden-field_afd').style.display = 'block';
    } else {
      document.getElementById('hidden-field_afd').style.display = 'none';
    }
  }
</script>
	
	

<script type="text/javascript">
  function showHide3(action) {
    let anti = action;
    if (anti == "yes") {
      document.getElementById('hidden-field3').style.display = 'block';
    } 
	  else {
      document.getElementById('hidden-field3').style.display = 'none';
    }
  }
</script>
	
	

</td>

</tr>
<tr>

<td width="47%">
<strong>Age range <h5>*</h5></strong>
</td>

<td>
<input type="text" name="age"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Gender <h5>*</h5></strong>
</td>

<td>
Male: <input type="number" name='male' style="width: 70px;"></input>
Female: <input type="number"  name='female' style="width: 70px;"></input>
Other: <input type="number"  name='otherGen' style="width: 70px;"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Total no. of patients <h5>*</h5></strong>
</td>

<td>
<input type="number" name="no_pat"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Total no. of samples <h5>*</h5></strong>
</td>

<td>
<input type="number" name="no_sam"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>No. of <em>Candida</em> isolates <h5>*</h5></strong>
</td>

<td>
<input type="number" name="no_can"></input>
</td>

</tr>
<tr>

<td width="47%">
<strong>Infection prevalence <h5>*</h5></strong>
<br/>
(presence of <em>Candida</em> in pathogenic state)
</td>

<td>
<textarea  name="inf_pre" width="100" height="100"></textarea>
</td>

</tr>
<tr>

<td width="47%">
<strong>Colonization prevalence </strong>
<br/>
(presence of <em>Candida</em> in commensal form)
</td>

<td>
<textarea  name="col_pre" width="100" height="100"></textarea>
</td>

</tr>
<tr>

<td width="47%">
<strong>Mortality (%) <h5>*</h5></strong>


</td>

<td>
<input type="number" name="mortal"></input></strong>
</td>

</tr>

<tr>

<td width="47%">
<strong>Identification method <h5>*</h5></strong>
</td>

<td>
<div id="IdeMetMultiselect" class="multiselect" style="width: 100%;">
      <div id="IdeMet" class="selectBox" onclick="toggleCheckboxAreaIdeMet()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="IdeMetSelectOptions" class="mySelectOptions">
		  <label for='Gram stain'><input type='checkbox' id='Gram' onchange='checkboxStatusChangeIdeMet()' value='Gram stain' name='ident[]' />Microscopy: Gram stain</label>
		  <label for='Gram stain'><input type='checkbox' id='koh' onchange='checkboxStatusChangeIdeMet()' value='KOH wet mount' name='ident[]'/>Microscopy: KOH wet mount</label>
		  <label for='Culture'><input type='checkbox' id='Culture' onchange='checkboxStatusChangeIdeMet()' value='Culture' name='ident[]'/>Culture <input type="text" name="cul" placeholder="write media used for culture" size="6" style="width: 250px; margin:4px; border:1px solid black;"/></label>
		  <label for='Gram stain'><input type='checkbox' id='autovitek' onchange='checkboxStatusChangeIdeMet()' value='Automated VITEK system' name='ident[]'/>Automated VITEK system<input type="text" name="vit" placeholder="write cards used for identification" size="6" style="width: 300px; margin:4px; border:1px solid black;"/></label>
		  <label for='Gram stain'><input type='checkbox' id='MALDI-TOF' onchange='checkboxStatusChangeIdeMet()' value='MALDI-TOF' name='ident[]'/>MALDI-TOF</label>
		  <label for='NGS'><input type='checkbox' id='NGS' onchange='checkboxStatusChangeIdeMet()' value='Sequencing' name='ident[]' />Sequencing</label>
        <label for='other' ><input type='checkbox' id='otherIdeMet' value='other' onClick="showHideIdeMet()" name='ident[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-fieldIdeMet" style="display: none;">
      
<input type="text" name="other_IdeMet" placeholder="Enter identification method" ></input>

</div>

<script type="text/javascript">
  function showHideIdeMet() {
    let idemeth = document.getElementById('otherIdeMet');
	
    if (idemeth.checked == true){
      document.getElementById('hidden-fieldIdeMet').style.display = 'block';
    } else {
      document.getElementById('hidden-fieldIdeMet').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#IdeMetMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#IdeMetSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeIdeMet() {
  var multiselect = document.getElementById("IdeMet");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("IdeMetSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaIdeMet(onlyHide = false) {
  var checkboxes = document.getElementById("IdeMetSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
</td>

</tr>
<tr>

<td width="47%">
<strong>Species prevalence (%) <h5>*</h5></strong>


</td>

<td>
<!--- <textarea name="sps_pre"></textarea> --->
	<select id="dropdown" name="spsPrev">
  <option value="">Select options</option>
  <?php
	$getsps = mysqli_query($conn, "select distinct species from sps_prevalence order by species ASC");

while($row=mysqli_fetch_array($getsps))
{
	$sp = $row["species"];	
	
	echo "<option value='$sp'>$sp</option>";
}
	?>
</select>

<div id="input-container"></div>
<script>
document.getElementById("dropdown").addEventListener("change", function() {
  var selectedOption = this.value;
  
  if (selectedOption) {
    var inputContainer = document.getElementById("input-container");
    
    var inputField = document.createElement("div");
    inputField.className = "input-container";
	  inputField.style.padding = "5px";
    
    var label = document.createElement("label");
    label.textContent = selectedOption;
	label.name = 'prevLabel[]';
    label.style.padding = "5px";
	  
	 var spsName = document.createElement("input");
	 spsName.name = "spsName[]";
    spsName.type = "hidden";
	  spsName.style.width = "160px";
	  spsName.value = selectedOption;
	  
    var input = document.createElement("input");
	 input.name = "prevInput[]";
    input.type = "text";
	  input.style.width = "160px";
    
    var closeButton = document.createElement("i");
      closeButton.className = "fas fa-times-circle close-btn";
      closeButton.style.fontSize = "small";
      closeButton.style.padding = "0px 2px";
      closeButton.style.color = "red";
      closeButton.style.cursor = "pointer";

      closeButton.addEventListener("click", function() {
        inputContainer.removeChild(inputField);
		  inputContainer.removeChild(spsName);
		  
      });

    
    inputField.appendChild(label);
    inputField.appendChild(input);
	  inputField.appendChild(spsName);
    inputField.appendChild(closeButton);
    
    inputContainer.appendChild(inputField);
    
    // Reset dropdown to default value
    this.selectedIndex = 0;
  }
});
</script>
</td>

</tr>

<tr>

<td width="47%">
<strong>Antifungal susceptibility test </strong>

</td>

<td>
<div id="astTestMultiselect" class="multiselect" style="width: 100%;">
      <div id="StuDes" class="selectBox" onclick="toggleCheckboxAreaastTest()">
        <select class="form-select">
          <option>Select options</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="astTestSelectOptions" class="mySelectOptions">
		  
		  
		  <label for='Gram stain'><input type='checkbox' id='autovitekt' onchange='checkboxStatusChangeastTest()' value='autovitekt' name='ast[]'/>Automated VITEK system<input type="text" name="vitt" placeholder="write cards used for AST" size="6" style="width: 250px; margin:4px; border:1px solid black;"/></label>
		  <label for='ddm'><input type='checkbox' id='ddm' onchange='checkboxStatusChangeastTest()' value='ddm' name='ast[]' />Disc diffusion method <input type="text" name="ddm" placeholder="write guidelines followed CLSI/EUCAST" size="6" style="width: 330px; margin:4px; border:1px solid black;"/></label>
		  <label for='broth'><input type='checkbox' id='broth' onchange='checkboxStatusChangeastTest()' value='broth' name='ast[]'/>Broth microdilution method<input type="text" name="bmm" placeholder="write guidelines followed CLSI/EUCAST" size="6" style="width: 330px; margin:4px; border:1px solid black;"/></label>
        <label for='other' ><input type='checkbox' id='otherastTest' value='other' onClick="showHideastTest()" name='ast[]'/>Other</label>
      </div>
    </div>
 
	
	<div id="hidden-fieldastTest" style="display: none;">
      
<input type="text" name="other_astTest" placeholder="Enter identification method" ></input>

</div>

<script type="text/javascript">
  function showHideastTest() {
    let idemeth = document.getElementById('otherastTest');
	
    if (idemeth.checked == true){
      document.getElementById('hidden-fieldastTest').style.display = 'block';
    } else {
      document.getElementById('hidden-fieldastTest').style.display = 'none';
    }
  }
</script>
	
	
<script>
	$(document).on("click", function(event){
       var $trigger = $("#astTestMultiselect");
      if($trigger !== event.target && !$trigger.has(event.target).length){
           $("#astTestSelectOptions").slideUp("fast");
        }            
    });
	function checkboxStatusChangeastTest() {
  var multiselect = document.getElementById("astTest");
  var multiselectOption = multiselect.getElementsByTagName('option')[0];

  var values = [];
  var checkboxes = document.getElementById("astTestSelectOptions");
  var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

  for (const item of checkedCheckboxes) {
    var checkboxValue = item.getAttribute('value');
    values.push(checkboxValue);
  }

  var dropdownValue = "Nothing is selected";
  if (values.length > 0) {
    dropdownValue = values.join(', ');
  }

  multiselectOption.innerText = dropdownValue;
}

function toggleCheckboxAreaastTest(onlyHide = false) {
  var checkboxes = document.getElementById("astTestSelectOptions");
  var displayValue = checkboxes.style.display;

  if (displayValue != "block") {
    if (onlyHide == false) {
      checkboxes.style.display = "block";
    }
  } else {
	  onlyHide = true;
    checkboxes.style.display = "none";
  }
}
	
	
	</script>
</td>

</tr>

<tr>

<td width="47%">
<strong>Antifungal susceptibility profile (%) </strong>
<br/>
(Resistance, Sensitivity)
</td>

<td>
<table border="1" style="border-collapse:collapse;" width="100px" cellspacing='6' cellpadding='6' id="aspTable">
<tr><th>Species</th><th>Drug</th><th>Activity</th><th style="border: none;"></th></tr>
<tr>
<td width="30px">

        <select name="asp[]" style="width:200px;">
          <option>Select option</option>
        
        
     
      
		  <?php
		  $getsps = mysqli_query($conn, "select distinct species from sps_prevalence order by species ASC");

while($row=mysqli_fetch_array($getsps))
{
	$sp = $row["species"];	
	
	echo "<option value='$sp'>$sp</option>";
}
		  ?>
        
		<option value="other" onClick="showHideAFD()" id='otherAFD'>Other</option>
    </select>
	<br>
   <div id="hidden-field_afd" style="display: none;" style="width:200px;">
      
          <input type="text" name="other_afd" placeholder="Enter drug name" style="width:200px;" />

</div>
	</td>
	<td>
	<select name="drug[]" style="width:200px;">
          <option>Select option</option>
        
        
     
      
		  <?php
		  $getAFD = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
		  while($rowafd=mysqli_fetch_array($getAFD))
             {
	             $afd = $rowafd["Drug"];
	             echo "<option value=$afd>$afd</option>";
	
            }
		  ?>
        
    </select>
	</td>
	<!--
	<td>
	<input type="text" name="res" placeholder="" style="width:150px;"></input>
	</td>
	<td>
	<input type="text" name="sen" placeholder="" style="width:150px;"></input>
	</td>
	<td>
	<input type="text" name="int" placeholder="" style="width:150px;"></input>
	</td>
	
	--->
	<td>
	<input type="text" name="act[]" style="width:200px;"></input>
	</td>
	<td>
      <i class='fa-duotone fa-plus' title="Add row" style="font-weight: bold;cursor: pointer; background: #C5E3EB; padding: 0px 2px; font-size: small;" onclick="addRowAsp()"></i>
      
    </td>
	</tr>
 </table>
<script>
function addRowAsp() {
    const table = document.getElementById('aspTable');
    
    var lastRow = table.rows[1];
    var newRow = lastRow.cloneNode(true);

    // Clear the selected options in the new row
    var select = newRow.getElementsByTagName("select")[0];
    select.selectedIndex = 0;

    // You can modify other elements in the new row if needed

    // Add a "Remove Row" button to the new row
    var closeButton = document.createElement("i");
      closeButton.className = "fas fa-times-circle close-btn";
      closeButton.style.fontSize = "small";
      closeButton.style.padding = "0px 2px";
      closeButton.style.color = "red";
      closeButton.style.cursor = "pointer";
	
    closeButton.onclick = function() {
        removeRow(this);
    };
    var cell = newRow.cells[newRow.cells.length - 1];
    cell.appendChild(closeButton);

    table.appendChild(newRow);
  }
  
  function removeRow(button) {
    var row = button.parentNode.parentNode; // Get the row containing the button
    var table = row.parentNode; // Get the table containing the row
    table.removeChild(row);
}
</script>

</td>

</tr>


</table>
<br/>
<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
     <div class="g-recaptcha captcha" data-sitekey="6Ld2_IgoAAAAAGc3DySB904JYGmmS0Hisb6my42o" align="center"></div>
                          	<br/>
		                    <div align="center">
                            <button type="submit" name="submit" class="square_btn" value="Submit"  >Submit</button>	
                            &nbsp;&nbsp;&nbsp;
                            <button  type="reset" name="Reset_f" class="square_btn">Reset</button>
		                   </div>
		                 
    </tr>
  </table>
</form>




</main>





<?php
include("footer.php");	
?>
</body>
</html>