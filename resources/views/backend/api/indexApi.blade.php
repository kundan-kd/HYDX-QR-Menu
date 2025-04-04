<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Monitor</title>
    <link rel="stylesheet" href="backend/assets/api/style.css">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  
</head>
<body>
    <section class="main-section">

        <div class="container-fluid px-5">
            <div class="row maincard">
                <div class="col">
                   <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Last 7   days</h6>
                        <p class="card-text  text-success">100%</p>
                        <p class="card-text-two m-0">0 incidents , 0m dm</p>
                      </div>
                   </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <h6 class="card-title">Last 30  days</h6>
                            <p class="card-text  text-success">99.991%</p>
                            <p class="card-text-two">1 incidents , 3m , 41s down</p>
                        </div>
                       </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <h6 class="card-title">Last 365 days</h6>
                            <p class="card-text">--_---%</p>
                            <a class="card-text-two text-success">Unlock with paid plan</a>
                          </div>
                       </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body card-border">
                            <div id="reportrange" >
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            
                            <p class="card-text">--_---%</p>
                            <p class="card-text-two">- incidents,  - down</p>
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
                <div class="row bdr-bottom ">
                    <div class="col-2 ps-4 p-2">
                        <p class="fs-6 d-flex align-items-center  text-success"><span class="card-icon"><i class="fa-solid fa-check me-2"></i></span>Resolved</p>
                       
                    </div>
                    <div class="col-6 p-2">
                        <p class="fs-6">Connection Timeout</p>
                    </div>
                    <div class="col-2 p-2">
                        <p class="data-text ">Oct 7 , 2024 1:22Am GMT+5:30</p>
                    </div>
                    <div class="col-2 p-2">
                        <p class="data-text ">0h 3m 41s</p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-2 ps-4 p-2">
                        <p class="fs-6 d-flex align-items-center  text-success"><span class="card-icon"><i class="fa-solid fa-check me-2"></i></span>Resolved</p>
                       
                    </div>
                    <div class="col-6 p-2">
                        <p class="fs-6">Connection Timeout</p>
                    </div>
                    <div class="col-2 p-2">
                        <p class="data-text ">Oct 7 , 2024 1:22Am GMT+5:30</p>
                    </div>
                    <div class="col-2 p-2">
                        <p class="data-text ">0h 3m 41s</p>
                    </div>
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

    
   