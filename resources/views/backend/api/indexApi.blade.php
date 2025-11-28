<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get-Monitors</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="backend/assets/api/style.css">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
   <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</head>
<body>
    <section class="main-section">
        <div class="container-fluid px-5">
            <div class="row maincard">
                <div class="col">
                   <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Last 7   days</h6>
                         @foreach($data['monitors'] as $monitor)
                         @php 
                         $seconds = $monitor['custom_down_durations'] ?? 0;
                        $minutes = floor($seconds / 60);
                        $remainingSeconds = $seconds % 60;
                         @endphp
                        <p class="card-text  text-success">{{$monitor['custom_uptime_ratio']}} %</p>
                        <p class="card-text-two m-0">{{$minutes ?? 0}}m {{$remainingSeconds ?? 0}}s down</p>
                         @endforeach
                      </div>
                   </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <h6 class="card-title">Last 30  days</h6>
                            <div id="duration_30">
                            </div>
                        </div>
                       </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <h6 class="card-title">Last 365 days</h6>
                            <div id="duration_365">
                            </div>
                          </div>
                       </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <div id="reportrange">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            <div id="duration_custom"></div>
                            
                          </div>
                       </div>
                </div>
            </div>

            <div class="row maincard ">
                <h6 class="ps-4 m-0 p-2 mt-3">Latest incidents</h6>
                <div class="row bdr-bottom">
                    <div class="col-2 ps-4 p-2">
                        <h6 class="data-text">Status</h6>
                    </div>
                    <div class="col-6 p-2">
                        <h6 class="data-text ">Root cause</h6>
                    </div>
                    <div class="col-2 p-2">
                        <h6 class="data-text ">Started</h6>
                    </div>
                    <div class="col-2 p-2">
                        <h6 class="data-text ">Duration</h6>
                    </div>
                </div>
                <div class="row bdr-bottom" id="duration_logs">
                </div>
                <div class="row">
                    <h6 class="title-bottom p-2">Thats's all, floks!</h6>
                </div>


            </div>
           
        </div>
       
    </section>
  
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script src="backend/assets/api/script.js"></script>
</body>
</html>
<script> 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    duration_30();
    duration_365();
   
    function duration_30(){
        $.ajax({
            url: "{{route('api_data.duration_30')}}",
            method:'POST',
            success:function(data){
                let duration_30Data = (data.data) ?? 0;
                let output = '';
                duration_30Data.monitors.forEach(monitor => {
                let downDuration = parseInt(monitor.custom_down_durations);
                let minutes = Math.floor(downDuration / 60);
                let seconds = downDuration % 60;
                output += `<p class="card-text text-success">${monitor.custom_uptime_ratio} %</p>`;
                output += `<p class="card-text-two m-0">${minutes}m ${seconds}s down</p>`;
                });
                 $('#duration_30').html(output);
             }
        });
    }
   
    function duration_365(){
        $.ajax({
            url: "{{route('api_data.duration_365')}}",
            method:'POST',
            success:function(data){
                let duration_365Data = (data.data_365) ?? 0;
                let output1 = '';
                duration_365Data.monitors.forEach(monitor => {
                let downDuration = parseInt(monitor.custom_down_durations);
                let minutes = Math.floor(downDuration / 60);
                let seconds = downDuration % 60;
                output1 += `<p class="card-text text-success">${monitor.custom_uptime_ratio} %</p>`;
                output1 += `<p class="card-text-two m-0">${minutes}m ${seconds}s down</p>`;
                });
                 $('#duration_365').html(output1);
             }
        });
    }
    
    function duration_custom(start, end) {
            let start_date = start.format('YYYY-MM-DD');
            let end_date =  end.format('YYYY-MM-DD');
            let start_t = new Date(start_date).getTime()/1000;
            let end_t = new Date(end_date).getTime()/1000;
            $.ajax({
                url:"{{ route('api_data.duration_custom') }}",
                method: 'POST',
                data: {
                    start_date: start_t,
                    end_date: end_t,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                let duration_custom = (data.custom_data) ?? 0;
                let output2 = '';
                let output3 = '';
                duration_custom.monitors.forEach(monitor => {
                output2 += `<p class="card-text text-success">${monitor.custom_uptime_ranges} %</p>`;
                output2 += `<p class="card-text">Up Time</p>`;
                monitor.logs.forEach(logData => {
                    let type = logData.type;
                    if(type==1){
                          output3 += `
                        <div class="col-2 ps-4 p-2">
                            <p class="fs-6 d-flex align-items-center text-success">
                                <span class="card-icon"><i class="fa-solid fa-check me-2"></i></span>Resolved
                            </p>
                        </div>
                        <div class="col-6 p-2">
                            <p class="fs-6">${logData.reason.detail}</p>
                        </div>
                        <div class="col-2 p-2">
                            <p class="data-text ">${new Date(logData.datetime * 1000).toLocaleString()}</p>
                        </div>
                        <div class="col-2 p-2">
                            <p class="data-text ">${Math.floor(logData.duration / 3600)}h ${Math.floor((logData.duration % 3600) / 60)}m ${logData.duration % 60}s</p>
                     </div>`;
                    }
                  
                });
            });

            $('#duration_custom').html(output2);
            $('#duration_logs').html(output3);
        
                }
            });
    }
   
</script>
<script>
        setTimeout(function() {
            $(document).ready(function() {
                $("#loading-wrapper").fadeOut(500);
            });
        }, 100);
    </script>
    
   