<head>
  <script src="jquery-1.11.0.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="files/scripts/material.js"></script>
    <link rel="stylesheet" type="text/css" href="files/dist/css/bootstrap-material-design.css">
    <link rel="stylesheet" type="text/css" href="files/dist/css/ripples.min.css"> 
  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <link rel="stylesheet" href="chartist/src/css/chartist-plugin-tooltip.css">
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <script src="chartist/src/scripts/chartist-plugin-tooltip.js"></script>
  <script src="zoom/src/scripts/chartist-plugin-zoom.js"></script>
</head>

<body style="    background: white;">
  
  <div class="ct-chart ct-golden-section" style="margin-top:50px"></div>
  <?php $male=array();
  $female=array();
  if (isset($_GET['diag'])) {
    $m1='Diag Code 1';
    $m2='Diag Code 2';
  }
  else{
    $m1 = 'Male';
    $m2 = 'Female';
  }
  if (isset($_GET['male'])) {
    $gender = 1;
    $male=unserialize(urldecode($_GET['male']));
    $female=unserialize(urldecode($_GET['female']));
  }
  else{
    for ($i=0; $i < 9; $i++) { 
      $gender = 0;
      $age[$i] = array();
      $age[$i] = unserialize(urldecode($_POST[$i]));
    }
  }
  ?>
  <script type="text/javascript">
  new Chartist.Line('.ct-chart', {
  labels: [<?php $i=1;
  if ($gender == 1) {
    while ($i < count($male)) {
      echo "'".$i."',";$i=$i+1;
    } 
    echo "'".$i."'";
  }
  else{
    while ($i < count($age[0])) {
      echo "'".$i."',";$i=$i+1;
    } 
    echo "'".$i."'";    
  }
  ?>],
  series: <?php if ($gender == 1) {?>[
    [<?php foreach ($male as $key => $value) {
    # code...
    echo "{meta: '$m1', x: $key,y: ".$value."},";
    }?>],
    [<?php foreach ($female as $key => $value) {
    # code...
    echo "{meta: '$m2', x: $key,y: ".$value."},";
    }?>]
  ]<?php }
  else{
    echo "[[";
    for ($i=0; $i < 9 ; $i++) { 
      foreach ($age[$i] as $key => $value) {
        echo "{meta: 'Age Group: $i', x: $key,y: '$value'} ,\n";
      }
      if ($i == 8) {
        echo "]";
      }
      else
        echo "],[";
    }
    echo "]";
  }?>
}, {
  lineSmooth: Chartist.Interpolation.simple({
    divisor: 2
  }),
  fullWidth: true,
  axisX: {
    type: Chartist.AutoScaleAxis
  },
  axisY: {
    type: Chartist.AutoScaleAxis
  },
  chartPadding: {
    right: 40,
    top:40
  },
  plugins: [
    Chartist.plugins.tooltip(),
    Chartist.plugins.zoom({ onZoom: onZoom })
  ],
});var resetFnc;
function onZoom(chart, reset) {
  resetFnc = reset;
}

var btn = document.getElementById('reset-zoom-btn');
btn.innerHTML = 'Reset Zoom';
btn.style.float = 'right';
btn.addEventListener('click', function() {
  console.log(resetFnc);
  resetFnc && resetFnc();
});
var parent = document.querySelector('#example-plugin-zoom .chart');
!parent.querySelector('#reset-zoom-btn') && parent.appendChild(btn);

  </script>
  <a href="javascript:void()" id="reset-zoom-btn " class="btn btn-raised btn-danger" onclick="resetFnc()">Reset</a>
</body>