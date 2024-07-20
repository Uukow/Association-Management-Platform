<?php

include '../View/Header.php';
?>

<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Media Women Network</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
             <!-- end page title -->
             <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Association Table</h4>
                            <div class="card-block table-border-style">

                            <div class="col-xl-2">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Simple Pie Chart</h4>
                <h5 class="text-center"> hww</h5>
            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
                            </div>
                            </div>

                                                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








<?php

include '../View/footer.php';
include '../View/ThemeSettings.php';

?>
<script src="../js/Association/associations.js"></script>


    
    function loadAttendanceData() {
        let sendingData = {
            action: "get_attendance_data"
        };

        $.ajax({
            method: "POST",
            dataType: "json",
            url: "../Api/Attendence.php",
            data: sendingData,
            success: function (data) {
                let status = data.status;
                let response = data.data;

                if (status) {
                    var options = {
                        chart: {
                            type: 'pie',
                            height: 350
                        },
                        series: [response.present, response.absent],
                        labels: ['Present', 'Absent'],
                        colors: ['#727cf5', '#fa5c7c']
                    };

                    var chart = new ApexCharts(document.querySelector("#simple-pie"), options);
                    chart.render();
                } else {
                    console.error('Error fetching data:', response);
                }
            },
            error: function (data) {
                console.error('Error:', data);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadAttendanceData();
    });
    </script>