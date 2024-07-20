<?php

include '../Common/Header.php';

include '../Config/conn.php';
?>

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
                        <h4 class="page-title">Media Women Network | <span style=" Color:#169fda;">Dashboard</span></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-4">
                <a href="./Admin.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Admins</h5>
                                    <h3 class="my-2 py-1" style=" Color:#169fda;"><span id="totalUser"></span></h3>
                                    <!-- <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"  id="debitPercentage"></i> </span>
                                    </p> -->
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                    </a>
                </div> <!-- end col -->
                

                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Total Association</h5>
                                    <h3 class="my-2 py-1" style=" Color:#169fda;"><span id="totalAssociations"></span></h3>
                                    <!-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold" id="creditPercentage"></i></span>
                                    </p> -->
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Date</h5>
                                    <h4 class="my-2 py-1" id="current-time" style=" Color:#169fda;"><?php
                                                                                                    date_default_timezone_set('Africa/Mogadishu'); // Set Somalia timezone

                                                                                                    $currentDateTime = date('M d, Y, g:i A');

                                                                                                    echo " $currentDateTime";
                                                                                                    ?></h4>
                                    <!-- <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold" id="balancePercentage"></i></span>
                                    </p> -->
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Pie Chart</h4>
                                        <div dir="ltr">
                                            <div id="simple-pie2" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            
                <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">treemap</h4>
                                        <div dir="ltr">
                                            <div id="basic-treemap" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Circle Chart - Custom Angle</h4>
                                        <div class="text-center" dir="ltr">
                                            <div id="circle-angle-radial" class="apex-charts" data-colors="#0acf97,#727cf5,#fa5c7c,#ffbc00"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                            </div> 



    
<!-- end col -->


<!-- end row -->


            <!-- get all admins in dashboard -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Association Management Platform</h4>
                            <div class="dropdown">
                                <h5 class="mwn">AMPs</h5>
                            </div>
                        </div>
                        <div class="card-header bg-light-lighten border-top border-bottom border-light py-1 text-center">
                            <p class="m-0"><b>All</b> Admins that Allow To visit this system</p>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0" id="userTable">
                                    <tbody>


                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div>
                <!-- end col-->

            </div>
            <!-- end row-->

            <!-- Ads Association Management Platform -->
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card cta-box bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-center">
                                <div class="w-100 overflow-hidden">
                                    <h2 class="mt-0 text-reset"><i class="mdi mdi-bullhorn-outline"></i>&nbsp;</h2>
                                    <h3 class="m-0 fw-normal cta-box-title text-reset">Manage your <b>Association</b> with confidence <i class="mdi mdi-arrow-right"></i></h3>
                                </div>
                                <img class="ms-3" src="../assets/images/svg/email-campaign.svg" width="120" alt="Generic placeholder image">
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->

                    <!-- Todo-->


                </div>
                <!-- end col --><!-- end col-->

            </div>

            <!-- get all admins in dashboard -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Association Management Platform</h4>
                            <div class="dropdown">
                                <h5 class="mwn">AMPs</h5>
                            </div>
                        </div>
                        <div class="card-header bg-light-lighten border-top border-bottom border-light py-1 text-center">
                            <p class="m-0"><b>All</b> Associations that Allow To visit this system</p>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0" id="assocationsTable">
                                    <tbody>


                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div>
                <!-- end col-->

            </div>
            <!-- end row-->



        </div> <!-- content -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->

    <?php

    include '../Common/footer.php';
    include '../Common/ThemeSettings.php';

    ?>

    <script src="../js/Dashboard.js"></script>

  