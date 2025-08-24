<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $pdbId; ?></title>
<script type="text/javascript" src="JSmol.min.js"></script>

<script type="text/javascript">

Jmol._isAsync = false;

// last update 2/18/2014 2:10:06 PM

var jmolApplet0; // set up in HTML table, below

// logic is set by indicating order of USE -- default is HTML5 for this test page, though

var s = document.location.search;

// Developers: The _debugCode flag is checked in j2s/core/core.z.js, 
// and, if TRUE, skips loading the core methods, forcing those
// to be read from their individual directories. Set this
// true if you want to do some code debugging by inserting
// System.out.println, document.title, or alert commands
// anywhere in the Java or Jmol code.

Jmol._debugCode = (s.indexOf("debugcode") >= 0);

jmol_isReady = function(applet) {
	document.title = (applet._id + " - Jmol " + Jmol.___JmolVersion)
	Jmol._getElement(applet, "appletdiv").style.border="1px solid blue"
}		

var Info = {
	width: 800,
	height: 800,
	debug: false,
	color: "0xCCCCCC",
	addSelectionOptions: true,
	use: "HTML5",   // JAVA HTML5 WEBGL are all options
	j2sPath: "./j2s", // this needs to point to where the j2s directory is.
	jarPath: "./java",// this needs to point to where the java directory is.
	jarFile: "JmolAppletSigned.jar",
	isSigned: true,
	script: "set antialiasDisplay;load pdb_file/<?php echo "$pdbFile"; ?>;cartoons only;color structure",
	serverURL: "php/jsmol.php",
	readyFunction: jmol_isReady,
	disableJ2SLoadMonitor: true,
  disableInitialConsole: true,
  allowJavaScript: true
	//defaultModel: "$dopamine",
	//console: "none", // default will be jmolApplet0_infodiv, but you can designate another div here or "none"
}

$(document).ready(function() {
  $("#appdiv").html(Jmol.getAppletHtml("jmolApplet0", Info))
})
var lastPrompt=0;
</script>
</head>
<body>
<table width=600 cellpadding=10>
<tr><td valign="top">
  <div id="appdiv"></div>
  <br>
  <br></td><td valign=middle><p><strong>Display Options</strong></p>
    <p><a href="javascript:Jmol.script(jmolApplet0,'select *;cartoons off;spacefill only')">Spacefill</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'select *;cartoons off;wireframe -0.1')">Wire</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'select *;cartoons off;spacefill 23%;wireframe 0.15')">Ball and stick</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'select protein or nucleic;cartoons only')">Cartoons</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'set cartoonFancy true')">Fancy</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'set cartoonFancy false;set hermitelevel 0')">Flat</a><br>
      <a href="javascript:Jmol.script(jmolApplet0,'color property atomno')">Color atomno</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'color cpk')">Color cpk</a><br> 
      <a href="javascript:Jmol.script(jmolApplet0,'color structure')">Color structure</a><br>
      <a href="javascript:Jmol.script(jmolApplet0,'select *;isosurface vdw')">isosurface vdw</a><br>
    </p></td>
</tr></table>
</body>
</html>
