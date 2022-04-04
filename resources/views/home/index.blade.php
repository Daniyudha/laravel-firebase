@extends('layout.main')

@section('outCSS')

@endSection()

@section('contents')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="collapse navbar-collapse" id="">
        <a class="navbar-brand">Weather Station Control</a>
        <ul class="navbar-nav ml-auto">
            <li class="dropdown nav-item">
                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <div class="notification d-none d-lg-block d-xl-block"></div>
                    <i class="tim-icons icon-bell-55
                    text-primary"></i>
                    <p class="d-lg-none">
                        Notifications
                    </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                    <li class="nav-link"><a href="#" class="nav-item
                      dropdown-item">Mike John responded to your email</a></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">You have 5 more
                            tasks</a></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Your friend Michael
                            is in
                            town</a></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another
                            notification</a></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another one</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <div class="photo">
                        <img src="../assets/img/anime3.png" alt="Profile Photo">
                    </div>
                    <b class="caret d-none d-lg-block d-xl-block"></b>
                    <p class="d-lg-none">
                        Log out
                    </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                    <li class="dropdown-divider"></li>
                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Log out</a></li>
                </ul>
            </li>
            <li class="separator d-lg-none"></li>
        </ul>
    </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar -->

<div class="container mt-4">
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Temperature</h5>
                        <!-- <div class="d-flex flex-row align-content-center my-3">
                            <i class="fa fa-thermometer-half fa-2x color-lamp" aria-hidden="true"></i>
                            <h3 class="card-title ml-2" id="temperature">--</i> </h3>
                        </div> -->
                        <div class="row p-3">
                            <div class="col-8">
                                <div class="d-flex flex-row align-content-center my-3">
                                    <img class="icon-temphum" src="../assets/icon/temperature-icon.svg" alt="">
                                    <h3 class="card-title ml-2 my-2" id="temperature">--</i>
                                </div>

                            </div>
                            <div class="col-4">
                                <p id="min-temperature">Min = </p>
                                <p id="max-temperature">Max = </p>
                                <p id="avg-temperature">Avg = </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Humidity</h5>
                        <!-- <div class="d-flex flex-row align-content-center my-3">
                            <i class="fa fa-thermometer-half fa-2x color-lamp" aria-hidden="true"></i>
                            <h3 class="card-title ml-2" id="humidity">--</i>
                        </div> -->
                        <div class="row p-3">
                            <div class="col-8">
                                <div class="d-flex flex-row align-content-center my-3">
                                    <img class="icon-temphum" src="../assets/icon/humidity-icon.svg" alt="">
                                    <h3 class="card-title ml-2 my-2" id="humidity">--</i>
                                </div>
                            </div>
                            <div class="col-4">
                                <p id="min-humidity">Min = </p>
                                <p id="max-humidity">Max = </p>
                                <p id="avg-humidity">Avg = </p>
                            </div>
                        </div>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h5 class="card-category">Grafik</h5>
                                <h2 class="card-title">Performance</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                    <label id="btn-temperature" class="btn btn-sm btn-primary btn-simple active" id="0">
                                        <input type="radio" name="options" checked>
                                        <span class="d-none d-sm-block d-md-block d-lg-block
                            d-xl-block">Temperature</span>
                                        <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-single-02"></i>
                                        </span>
                                    </label>
                                    <label id="btn-humidity" class="btn btn-sm btn-primary btn-simple" id="1">
                                        <input type="radio" class="d-none d-sm-none" name="options">
                                        <span class="d-none d-sm-block d-md-block d-lg-block
                            d-xl-block">Humidity</span>
                                        <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-gift-2"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" id="chartBig1show">
                            <canvas id="chartBig1"></canvas>
                        </div>
                        <div class="chart-area" id="chartBig2show">
                            <canvas id="chartBig2"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart text-center">
                    <div class="card-header">
                        <h4 class="card-title">Lampu 1</h4>
                        <hr color="#e3e3e3">
                    </div>
                    <div class="card-body mx-auto" id="elements1">
                        <label class="switch-btn mx-auto">
                            <input id="togBtn" class="checked-switch visually-hidden togBtn" type="checkbox" />
                            <span class="text-switch" data-yes="ON" data-no="OFF"></span>
                            <span class="toggle-btn"></span>
                        </label>
                        <input type="checkbox" id="togBtn" class="visually-hidden togBtn">
                        <div class="control-me icon-lamp"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart text-center">
                    <div class="card-header">
                        <h4 class="card-title mb-0 mt-2">Lampu 2</h4>
                        <hr color="#e3e3e3">
                    </div>
                    <div class="card-body mx-auto" id="elements2">
                        <label class="switch-btn mx-auto">
                            <input id="lamp1" class="checked-switch visually-hidden" type="checkbox" />
                            <span class="text-switch" data-yes="ON" data-no="OFF"></span>
                            <span class="toggle-btn"></span>
                        </label>
                        <input type="checkbox" id="lamp1" class="visually-hidden">
                        <div class="control-me icon-lamp"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart text-center">
                    <div class="card-header">
                        <h4 class="card-title mb-0 mt-2">Lampu 3</h4>
                        <hr color="#e3e3e3">
                    </div>
                    <div class="card-body mx-auto" id="elements3">
                        <label class="switch-btn mx-auto">
                            <input id="lamp1" class="checked-switch visually-hidden" type="checkbox" />
                            <span class="text-switch" data-yes="ON" data-no="OFF"></span>
                            <span class="toggle-btn"></span>
                        </label>
                        <input type="checkbox" id="lamp1" class="visually-hidden">
                        <div class="control-me icon-lamp"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card card-chart text-center">

            <div class="card-body text-center" id="elements">
                <label class="switch-btn">
                    <input id="lamp1" class="checked-switch visually-hidden" type="checkbox" />
                    <span class="text-switch" data-yes="ON" data-no="OFF"></span>
                    <span class="toggle-btn"></span>
                </label>
                <input type="checkbox" id="lamp1" class="visually-hidden">
                <div class="control-me icon-lamp"></div>
            </div>
            <h4 class="card-title">Lampu 2</h4>
        </div> -->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Pembacaan Sensor 20 Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class="text-primary">
                            <th>
                                Timestamp
                            </th>
                            <tH>
                                Temperature
                            </th>
                            <th>
                                Humidity
                            </th>
                            </tr>
                        </thead>
                        <tbody id="table-history">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// console.log(fetch(`http://127.0.0.1:8000/read`))

fetch(`http://127.0.0.1:8000/read`)
    .then(response => {
        return response.json();
    })
    .then(responseJson => {
        if (responseJson) {
            console.log(responseJson);
            if (responseJson.lampu1 == "1") {
                $(".togBtn").prop('checked', true);
            } else {
                $(".togBtn").prop('checked', false);
            }
            // return Promise.resolve(JSON.stringify(responseJson));
        } else {
            return Promise.reject(`${keyword} is not found`);
        }
    })

function setIntervalJs() {
    fetch(`http://127.0.0.1:8000/read`)
        .then(response => {
            return response.json();
        })
        .then(responseJson => {
            if (responseJson) {
                console.log(responseJson);
                console.log('rata-rata:' + parseFloat(responseJson.avg_temperature));

                document.getElementById("humidity").innerHTML = responseJson.humadity + ' %';
                document.getElementById("temperature").innerHTML = responseJson.temperature + ' ºC';

                let table = document.querySelector("table");

                let tbody = "";

                // console.log(tbody);
                function generateTable() {
                    document.getElementById('table-history').innerHTML = ''
                    let tbody = document.getElementById("table-history");
                    //membuat element body
                    table.appendChild(tbody);



                    for (const [key, value] of Object.entries(responseJson.log)) {
                        let row = tbody.insertRow(0);

                        let cell1 = row.insertCell(0);
                        let cell2 = row.insertCell(1);
                        let cell3 = row.insertCell(2);

                        // let log = data[i]
                        var date = new Date(value.TIMESTAMP);
                        let newdate = date.getDate() +
                            "/" + (date.getMonth() + 1) +
                            "/" + date.getFullYear() +
                            " " + date.getHours() +
                            ":" + date.getMinutes() +
                            ":" + date.getSeconds();
                        cell1.innerHTML = newdate;

                        cell2.innerHTML = value.Temperature + " ºC";
                        cell3.innerHTML = value.Humidity + " %";

                    }
                }
                document.getElementById("min-temperature").innerHTML = "Min = " + responseJson.min_temperature +
                    ' ºC';

                document.getElementById("max-temperature").innerHTML = "Max = " + responseJson.max_temperature +
                    ' ºC';

                document.getElementById("avg-temperature").innerHTML = "Avg = " + responseJson.avg_temperature
                    .toFixed(2) + ' ºC';


                document.getElementById("min-humidity").innerHTML = "Min = " + responseJson.min_humidity + ' %';

                document.getElementById("max-humidity").innerHTML = "Max = " + responseJson.max_humidity + ' %';

                document.getElementById("avg-humidity").innerHTML = "Avg = " + responseJson.avg_humidity.toFixed(
                    2) + ' %';
                generateTable();

                // table.removeChild(tbody);

            } else {
                return Promise.reject(`${keyword} is not found`);
            }
        })
}

setInterval(setIntervalJs, 10000);
</script>

@endSection()

@section('outJS')

@endSection()