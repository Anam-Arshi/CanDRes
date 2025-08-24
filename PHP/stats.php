<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Statistics</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script src="echarts-5.5.0/dist/echarts.js"></script>
 <script src="echarts-5.5.0/dist/echarts.min.js"></script>
<script src='https://cdn.plot.ly/plotly-2.31.1.min.js'></script>
<style>
	
	table {
		max-width: 95%;
        width: 94%;
        margin: 0 auto;
		text-align: left;
		font-family: verdana;
    }
	h4{
		color: #1a518b;
		font-weight: bold;
		font-family: verdana;
	}
	
	
	
	
	.mutDiv{
		    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
	}
	
	h3{
		font-size: 18px;
	}
	.imgDiv{
		margin: 18px;
	}
	
	</style>
</head>

<body>
<?php
include("connect.php");
include("header.php");
include("loader.php");
//https://wou.edu/chemistry/courses/online-chemistry-textbooks/
?>
<main class="main">
<br>
<h3 align="center">Collection of mutation types catalogued in CanDRes</h3>
<div class="mutDiv">

<div align="center" id="PieChart" style="width:600px; height: 650px;"></div>
<div align="center" id="subDo" style="width:700px; height: 500px;"></div>
</div>
<script>
// Initialize the echarts instance based on the prepared dom
      var myChart = echarts.init(document.getElementById('PieChart'));

option = {
  title: {
    //text: 'Collection of mutation types catalogued in CanDRes',
    //subtext: 'Fake Data',
    //left: 'right'
  },
  tooltip: {
    trigger: 'item',
	 formatter: '{a} <br/>{b}: {c} ({d}%)'
  },
  legend: {
    //orient: 'vertical',
    //left: 'left'
	show: false
  },
  series: [
    {
      name: 'Mutation type',
      type: 'pie',
       radius: ['40%', '70%'],
      //center: ['50%', '70%'],
	   labelLine: {
        length: 20
      },
	  
	   color: [ '#dd6b66',  '#8dc1a9', '#ea7e53', '#eedd78', '#73a373', '#73b9bc', '#7289ab', '#91ca8c', '#f49f42' ],
	  
      data: [
	  
        { value: 6, name: 'Insertions' },
		{ value: 902, name: 'Substitution' }, //956
        { value: 24, name: 'Deletions' },
		
        { value: 12, name: 'Frameshift' }, //13
        
		
        { value: 23, name: 'Complex' }, //24
		{ value: 27, name: 'Stop' }, //26
		
		
      ],
	  
	  label: {
        show: true,
        formatter: '{b}: {d}%', // Display name and percentage
        position: 'outside' // Positioning of the label
      },
	  
      /* emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      } */
    }
  ]
};

// Display the chart using the configuration items and data just specified.
      myChart.setOption(option);




// Initialize the echarts instance based on the prepared dom
      var myChart1 = echarts.init(document.getElementById('subDo'));

option = {
  title: {
    text: '',
    //subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item',
	 formatter: '{a} <br/>{b}: {c} ({d}%)'
  },
  legend: {
    //orient: 'vertical',
    //left: 'left'
	show: false
  },
  series: [
    {
      name: 'Substitution type',
      type: 'pie',
       radius: ['30%', '60%'],
      //center: ['50%', '70%'],
	   labelLine: {
        length: 9, // Adjust the line length to prevent overlap
        smooth: true // Smooth out the line for a cleaner look
      },
	   
	  
      data: [
        { value: 577, name: 'Single substitutions' }, //579
        { value: 197, name: 'Double substitutions' },
        { value: 128, name: 'Multiple substitutions' }
        
		
      ],
	  label: {
        show: true,
        formatter: '{b}: {d}%', // Display name and percentage
        position: 'outside', // Positioning of the label
		padding: [5, 10] // Add padding to prevent clipping
      },
	  
	  
      /* emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      } */
    }
  ]
};

// Display the chart using the configuration items and data just specified.
      myChart1.setOption(option);

</script>
<br>
<br>
<!---<div align="center" id="barChart" style="width: 1000px; height:900px;"></div>---->
<script>
var myChart2 = echarts.init(document.getElementById('barChart'));
// There should not be negative values in rawData
const rawData = [
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 1]
  
  
];
const totalData = [];
for (let i = 0; i < rawData[0].length; ++i) {
  let sum = 0;
  for (let j = 0; j < rawData.length; ++j) {
    sum += rawData[j][i];
  }
  totalData.push(sum);
}
const grid = {
  left: 100,
  right: 100,
  top: 50,
  bottom: 50
};
const series = [
  "C. albicans", "C. auris", "C. dubliniensis", "C. glabrata",
    "C. haemulonii", "C. kefyr", "C. krusei", "C. lusitaniae",
    "C. metapsilosis", "C. orthopsilosis", "C. parapsilosis",
    "C. tropicalis"
].map((name, sid) => {
  return {
    name,
    type: 'bar',
    stack: 'total',
    barWidth: '60%',
    label: {
      show: false,
      formatter: (params) => Math.round(params.value * 1000) / 10 + '%'
    },
    data: rawData[sid].map((d, did) =>
      totalData[did] <= 0 ? 0 : d / totalData[did]
    )
  };
});
option = {
  legend: {
    selectedMode: false
  },
  grid,
  yAxis: {
    type: 'value'
  },
  xAxis: {
    type: 'category',
    data: [ "ADE17", "AUS1", "CAGL0L04400g", "CAGL0L09383g", "CAP1", "CDR1", "CIS2", 
    "EFG1", "ERG1", "ERG11", "ERG2", "ERG3", "ERG5", "ERG6", "ERG9", "FCY1", 
    "FCY2", "FKS1", "FKS2", "FKS3", "FLO8", "FLR1", "FPS1", "FPS2", "FUR1", 
    "GAL11A", "GAL11B", "GSC1", "GWT1", "HST1", "MDR1", "MEC3", "MRR1", "MRR2", 
    "MSH2", "orf19.7235", "PDH1", "PDR1", "PEA2", "PGS1", "RPP1A", "SIN3", 
    "SNQ2", "TAC1", "UPC2", "UPC2A", "ZCF29"]
  },
  series
};

//myChart2.setOption(option);
</script>
<br>

<!----<div align="center" class="canvDiv"><div id='myDiv' style="height: 700px; width:90%;" align="center"></div></div>---->
<script>
var colorscaleValue = [
  [0, '#266a62d1'],
  [1, '#266a62d1']
];

var dataH = [
  {
    z: [
[3, 3, null, 3, null, null, null, null, null, null, 3, 3], 
	[3, 3, null, 3, null, null, null, 3, null, null, null, 3],
	[3, 3, 3, 3, null, 3, 3, 3, 3, 3, 3, 3],
	[3, null, null, null, null, null, null, null, null, null, null, null],
	[3, 3, 3, 3, null, 3, 3, 3, 3, 3, 3, 3],
	[3, null, null, 3, null, null, null, null, null, null, 3, 3],
	[3, null, null, 3, null, null, null, null, null, null, null, 3],
	[3, 3, null, 3, 3, 3, 3, 3, 3, null, 3, 3],
	[3, 3, null, 3, null, null, null, null, null, null, null, null],
	[3, 3, 3, 3, null, 3, 3, 3, 3, null, null, 3],
	[3, null, null, 3, null, null, null, null, 3, null, null, 3],
	[3, null, null, 3, null, null, null, null, null, null, null, null],
	[3, 3, 3, 3, null, 3, 3, 3, 3, 3, 3, 3],
	[3, null, null, 3, null, null, null, null, null, null, null, null],
	 [3, null, null, 3, null, null, null, null, null, null, null, null],
	 [null, null, null, 3, null, null, null, null, null, null, null, null],
	 [3, null, null, null, null, null, null, null, null, null, null, null],
	 [3, null, 3, 3, null, 3, null, 3, 3, null, null, 3],
	[3, null, null, 3, null, 3, 3, null, 3, null, null, 3],
	[3, null, null, 3, null, null, null, null, null, null, null, null],
	[3, 3, null, 3, 3, 3, null, 3, 3, null, 3, 3]
	],
	
    x: ['C. albicans', 'C. auris', 'C. dubliniensis', 'C. glabrata', 'C. haemulonii', 'C. kefyr', 'C. krusei', 'C. lusitaniae', 'C. metapsilosis', 'C. orthopsilosis', 'C. parapsilosis', 'C. tropicalis'],
    y: ['5-Flucytosine', 'Amphotericin B', 'Anidulafungin', 'Beauvericin', 'Caspofungin', 'CDC101', 'Clotrimazole', 'Fluconazole', 'Isavuconazole',
	 'Itraconazole', 'Ketoconazole', 'Manogepix', 'Micafungin', 'MK-3118', 'Posaconazole', 'Prochloraz', 'Ravuconazole', 'Rezafungin', 'SCY-078', 'Tacrolimus', 'Voriconazole'],
    type: 'heatmap',
    hoverongaps: false,
	colorscale: colorscaleValue,
	showscale: false,
	
  }
];

var layout = {
	title: '<b>Distribution of 13 Candida spp. resistance against 20 drugs</b>',
	font: {
            //family: 'Courier New, monospace', // Specify font family
            size: 12 // Specify font size
        },
		
    xaxis: {
        // Other x-axis settings...
    },
    yaxis: {
        ticklabeloverflow: "none",
		automargin: true
    }
};


//Plotly.newPlot('myDiv', dataH, layout);




</script>

<div align="center" class="imgDiv">
<h3>Enumeration of 56 ADR-associated genes across 13 <em>Candida</em> spp. in CanDRes</h3>
<img width='1250' height='700' src="plots/geneSps_11_04.png"/>
</div>

<br>

<div align="center" class="imgDiv">
<h3>Profile of drug resistance in 13 <em>Candida</em> spp. against 19 clinical/investigational antifungals</h3>
<img width='1200' height='650' src="plots/drgSps_11_04.png"/>
</div>

	<br>
	</main>
	
<?php
include("foot.php");


?>	
</body>
</html>