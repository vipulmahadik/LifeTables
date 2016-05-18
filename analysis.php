<head>
  <script src="jquery-1.11.0.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="files/scripts/material.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <style type="text/css">
  .form-control, .form-group .form-control{
    border-bottom: solid;
    }
    .nav-tabs li.active {
        background: rgba(0, 107, 97, 0.35);
    }</style>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Bootstrap Material Design -->
    <link rel="stylesheet" type="text/css" href="files/dist/css/bootstrap-material-design.css">
    <link rel="stylesheet" type="text/css" href="files/dist/css/ripples.min.css"> 
    <script type="text/javascript">
    </script>
    <style type="text/css">
    .hidden{
      display: none;
      }</style>
      <script type="text/javascript">
      function getdata (arg,value) {
    // body...
    if (arg=="codes") {
      diagnosis=document.getElementById('search').value;
    };
    if (arg=="data") {
      diagnosis=value;
    };
    if (arg == "codes01") {
      diagnosis=document.getElementById('search01').value;
    };
    if (arg == "codes02") {
      diagnosis=document.getElementById('search02').value;
    };
    if (arg == "data01" || arg=="data02") {
      diagnosis=value;
    };
    if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
              } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        if (arg=="codes") {document.getElementById("searchdata").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable").className = "table table-striped table-hover";document.getElementById("datatable").className = "hidden";};
        if (arg=="codes01") {document.getElementById("output01").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable01").className = "table table-striped table-hover";document.getElementById("datatable").className = "hidden";};
        if (arg=="codes02") {document.getElementById("output02").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable02").className = "table table-striped table-hover";document.getElementById("datatable").className = "hidden";};
        if (arg=="data") {document.getElementById("response").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable").className = "hidden";document.getElementById("datatable").className = "table table-striped table-hover";};
        if (arg=="data01") {document.getElementById("response01").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable01").className = "hidden";document.getElementById("datatable").className = "table table-striped table-hover";};
        if (arg=="data02") {document.getElementById("response02").innerHTML = xmlhttp.responseText;document.getElementById("diagnotable02").className = "hidden";document.getElementById("datatable").className = "table table-striped table-hover";};
      }
    };
    xmlhttp.open("GET","retrieve.php?diagnosis="+diagnosis+"&arg="+arg,true);
    xmlhttp.send();
  }
  function checkboth (arg, value) {
    // body...
    if (arg=="data01") {document.getElementById('1stdiag').value=value;document.getElementById('output01').innerHTML="<H3>Diagnosis Code 1 : "+value;};
    if (arg=="data02") {document.getElementById('2nddiag').value=value;document.getElementById('output02').innerHTML="<H3>Diagnosis Code 2 : "+value;document.getElementById('response02').innerHTML="<iframe src='' name='graph1' style='width:100%;height:100%; border:none;'></iframe>";getboth();};
  }
  function getboth () {
    diag1=document.getElementById('1stdiag').value;
    diag2=document.getElementById('2nddiag').value;

    if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
              } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("response01").innerHTML = xmlhttp.responseText;
      }
    };
    xmlhttp.open("GET","retrieve.php?diagnosis="+diag1+"a"+diag2+"&arg=diag_2",true);
    xmlhttp.send();
  }
  function refresh (argument) {
    // body...
    document.getElementById('output02').innerHTML="";
    document.getElementById('output01').innerHTML="";
    document.getElementById('response02').innerHTML="";
    document.getElementById('response01').innerHTML="";
    document.getElementById('search01').value="";
    document.getElementById('search02').value="";
    document.getElementById("diagnotable01").className = "table table-striped table-hover";
    document.getElementById("diagnotable02").className = "table table-striped table-hover";

  }
  </script>
</head>
<body>
  <?php session_start(); ?>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Healthcare Data Analysis</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li  class="active">
                        <a href="analysis.php" >Graph Data</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

  <form class="form-horizontal" style="background:white;padding:50px;margin-top:30px;margin-bottom:0px;padding-bottom: 20px;">
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#home" data-toggle="tab">Single</a></li>
      <li><a href="#profile" onclick="javascript:refresh()" data-toggle="tab">2 Diagnosis</a></li>
    </ul>
  </form>
    <div id="myTabContent" class="tab-content" style="background: white;padding: 0px 50px;">
      <div class="tab-pane fade active in" id="home">
        <fieldset>
          <div class="form-group label-floating">
            <label class="control-label" for="search">Select a Diagnosis Code</label>
            <input class="form-control" id="search" type="text" oninput="getdata('codes',0)">
          </div>
        </fieldset>
        <div class="row">
          <div class="col-md-6">
            <table id="diagnotable" class="table table-striped table-hover " style="margin-top:10px;">
              <thead>
                <tr>
                  <th>Dignosis Code</th>
                </tr>
              </thead>
              <tbody id="searchdata">
              </tbody>
            </table>
            <form action='graph.php' method='post' >
              <div id="response">
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <iframe src="" name="graph" style="width:100%;height:100%; border:none;"></iframe>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="profile">

          <div class="row" style="float: right;"><div class="col-md-12">
<a href="javascript:refresh(0)" class="btn btn-raised btn-info">Reset</a></div></div>
        <fieldset>
          <div class="form-group label-floating">
            <label class="control-label" for="search">Select 2 Diagnosis Code</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" id="search01" type="text" oninput="getdata('codes01',0)">
              </div>
              <div class="col-md-6">
                <input class="form-control" id="search02" type="text" oninput="getdata('codes02',0)">
                <input id="1stdiag" type="text" hidden>
                <input id="2nddiag" type="text" hidden>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <table id="diagnotable01" class="table table-striped table-hover " style="margin-top:10px;">
                <thead>
                  <tr>
                    <th>Dignosis Code</th>
                  </tr>
                </thead>
                <tbody id="output01">
                </tbody>
              </table>
              <div id="response01">
              </div>
            </div>
            <div class="col-md-6">
              <table id="diagnotable02" class="table table-striped table-hover " style="margin-top:10px;">
                <thead>
                  <tr>
                    <th>Dignosis Code</th>
                  </tr>
                </thead>
                <tbody id="output02">
                </tbody>
              </table>
              <div id="response02">
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
</body>