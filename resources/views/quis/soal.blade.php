<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/font-awesome/css/font-awesome.min.css") }} ">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <title>Soal Ujian Online</title>
    <style>
        body{
            background-color:azure;
        }
        .card{
            border: 10px double green;
        }
        #cek{
            border: 10px double green;
        }
        #myclock{
            font-size: 24px;
            color: black;
        }
        .well{
            background: white;
        }
        #cek1{
            width: 45px;
            height: 40px;
        }

    </style>
    <script language="javascript">

        var clock = 0;
        var interval_msec = 1000;
    
        // ready
    
        $(function() {
            // set timer
            clock = setTimeout("UpdateClock()", interval_msec);
        });
    
        // UpdateClock
        function UpdateClock(){
    
            // clear timer
            clearTimeout(clock);
    
            var dt_now = new Date();
            var hh	= dt_now.getHours();
            var mm	= dt_now.getMinutes();
            var ss	= dt_now.getSeconds();
    
            if(hh < 10){
                hh = "0" + hh;
            }
            if(mm < 10){
                mm = "0" + mm;
            }
            if(ss < 10){
                ss = "0" + ss;
            }
            $("#myclock").html( hh + ":" + mm + ":" + ss);
    
            // set timer
            clock = setTimeout("UpdateClock()", interval_msec);
    
        }
        </script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-dark bg-success">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Soal Ujian Online <b>(SMAN 1 SUMENEP)</b></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"></a></li>
                <li><a href="">{{ Auth::user()->name }}</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      
      <div class="col-md-12">
          <div class="row">
            <div class="col-md-9">
                <div id="accordion">
                    <div class="card well">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-default"><i class="fa fa-home"></i></button>
                <button class="btn btn-info"><i class="fa fa-arrow-circle-right"></i></button>
                <button class="btn btn-info"><i class="fa fa-arrow-circle-left"></i></button>
                <button class="btn btn-danger"><i class="fa fa-check"></i></button>
            </div>
        <div class="row">
            <div class="col-md-3">
                    <div class="card well" id="cek">
                        <div align="center">
                            <span id="myclock"></span>
                        </div>
                    </div>
                    <div class="card">
                        @for($x = 1; $x <= 50; $x++)
                        <button class="btn btn-info" id="cek1">{{ $x }}</button>
                        @endfor
                    </div>
            </div>
        </div>
      </div>
    </div>
</body>
</html>