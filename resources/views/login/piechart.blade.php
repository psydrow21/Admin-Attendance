<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
      body {
          background-color: #f9f9fa
      }
     
      .flex {
          -webkit-box-flex: 1;
          -ms-flex: 1 1 auto;
          flex: 1 1 auto
      }
     
      @media (max-width:991.98px) {
          .padding {
              padding: 1.5rem
          }
      }
     
      @media (max-width:767.98px) {
          .padding {
              padding: 1rem
          }
      }
     
      .padding {
          padding: 5rem
      }
     
      .card {
          background: #fff;
          border-width: 0;
          border-radius: .25rem;
          box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
          margin-bottom: 1.5rem
      }
     
      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 1px solid rgba(19, 24, 44, .125);
          border-radius: .25rem
      }
     
      .card-header {
          padding: .75rem 1.25rem;
          margin-bottom: 0;
          background-color: rgba(19, 24, 44, .03);
          border-bottom: 1px solid rgba(19, 24, 44, .125)
      }
     
      .card-header:first-child {
          border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
      }
     
      card-footer,
      .card-header {
          background-color: transparent;
          border-color: rgba(160, 175, 185, .15);
          background-clip: padding-box
      }</style>
  </head>

<body>

    <div class="padding">
        <div class="row">
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-8 col-md-6">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body" style="height: 420px">
                            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>
    $(document).ready(function() {
        var ctx = $("#chart-line");
        var myLineChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Absent", "Early Out", "Late", "Present"],
                datasets: [{
                    data: [1, 2, 3, 10],
                    backgroundColor: ["rgba(217, 30, 24, 1)", "rgba(249, 105, 14, 1)", "rgba(255, 240, 0, 1)", "rgba(0, 230, 64)"],
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Attendance Performance Report'
                }
            }, series: [
        {
            dataLabel: {
                visible: true,
            },
        }
    ],




            
        });
    });
</script>
</html>