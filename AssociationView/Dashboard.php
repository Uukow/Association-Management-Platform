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
                        <h4 class="page-title">Association Management Platform | <span style=" Color:#169fda;">Dashboard</span></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <!-- All Counts -->
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Employees</h5>
                                    <h3 class="my-2 py-1" id="totalEmployees"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-account-key" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Departments</h5>
                                    <h3 class="my-2 py-1" id="totalJobs"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-account-multiple-check" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Accounts</h5>
                                    <h3 class="my-2 py-1" id="totalAccounts"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-account-lock" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Memberships</h5>
                                    <h3 class="my-2 py-1" id="totalMembership"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-human-female-female" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Seminars</h5>
                                    <h3 class="my-2 py-1" id="totalSiminars"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-presentation" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Participant</h5>
                                    <h3 class="my-2 py-1" id="totalParticipant"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-account-switch" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Sponsers</h5>
                                    <h3 class="my-2 py-1" id="totalPartners"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-handshake" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <!-- end col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Task Pending</h5>
                                    <h3 class="my-2 py-1" id="totalPending"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-handshake" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>

            <!-- tasks -->
            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Seminars</h5>
                                    <h3 class="my-2 py-1" id="totalSiminars"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-presentation" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <div class="col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Participant</h5>
                                    <h3 class="my-2 py-1" id="totalParticipant"></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-account-switch" style="font-size: 56px; Color:#211c58;"></i> </span>
                                    </p>
                                </div>

                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- end col -->
                <!-- end col -->
            </div>

            <!-- All Charts -->
             <div class="row">
                
             <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Tasks Pie Chart</h4>
                                        <div dir="ltr">
                                            <div id="simple-pie2" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->

                
                
             <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Employees Pie Chart</h4>
                                        <div dir="ltr">
                                            <div id="simple-pie3" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                
                
             <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Members Pie Chart</h4>
                                        <div dir="ltr">
                                            <div id="simple-pie4" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            </div>


            
            <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Tasks Treemap</h4>
                                        <div dir="ltr">
                                            <div id="basic-treemap" class="apex-charts" data-colors="#39afd1"></div>
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
                                        <h4 class="header-title">Employees Treemap</h4>
                                        <div dir="ltr">
                                            <div id="basic-treemap1" class="apex-charts" data-colors="#39afd1"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            </div>

            <div class="row">
            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Members Treemap</h4>
                                        <div dir="ltr">
                                            <div id="basic-treemap2" class="apex-charts" data-colors="#39afd1"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            </div>


            <div class="row">
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
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Circle Chart - Custom Angle2</h4>
                                        <div class="text-center" dir="ltr">
                                            <div id="circle-angle-radial1" class="apex-charts" data-colors="#0acf97,#727cf5,#fa5c7c,#ffbc00"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                            <!-- end col-->
                            
            </div>

            <div class="row">
            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Circle Chart - Custom Angle3</h4>
                                        <div class="text-center" dir="ltr">
                                            <div id="circle-angle-radial2" class="apex-charts" data-colors="#0acf97,#727cf5,#fa5c7c,#ffbc00"></div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
            </div>

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
                </div>
            </div>



        </div>
        <!-- end col --><!-- end col-->


        <div class="row">

            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Transaction List</h4>
                        <div>
                            <!-- <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>Today</option>
                                                <option value="1">Yesterday</option>
                                                <option value="2">Tomorrow</option>
                                            </select> -->
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0" id="TransectionTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Acount Title</th>
                                        <th scope="col">Org</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Memo</th>
                                        <th scope="col">Split</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" class="text-end">A.Name</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div> <!-- end row -->
        <!-- end row -->



    </div> <!-- container -->

</div> <!-- content -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->

<?php


include '../Common/footer.php';
include '../Common/ThemeSettings.php';
?>

<script src="../js/Association/Dashboard.js"></script>
