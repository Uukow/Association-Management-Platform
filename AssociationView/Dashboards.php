<?php

include './Header.php';
include './sidebar.php';
include '../Config/conn.php';
// Employees counts the number 
$query = "SELECT COUNT(*) as totalEmp FROM Employees"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalEmployees = $row['totalEmp'];
} else {
    $totalEmployees = 0;
}


?>
// Membership counts the nummber

<?php

include '../Config/conn.php';
// Employees counts the number 
$query = "SELECT COUNT(*) as totalMem FROM membership"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalMem = $row['totalMem'];
} else {
    $totalMem = 0;
}


?>

<!-- Users -->
<?php

include '../Config/conn.php';
// Employees counts the number 
$query = "SELECT COUNT(*) as totalUser FROM user"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUser = $row['totalUser'];
} else {
    $totalUser = 0;
}


?>

<!-- participant -->
<?php

include '../Config/conn.php';
// Participant counts the number 
$query = "SELECT COUNT(*) as totalPart FROM participant"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPart = $row['totalPart'];
} else {
    $totalPart = 0;
}


?>
<!-- participant -->
<?php

include '../Config/conn.php';
// Partner counts the number 
$query = "SELECT COUNT(*) as totalPartner FROM partners"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPartner = $row['totalPartner'];
} else {
    $totalPartner = 0;
}

?>
<?php

include '../Config/conn.php';
// Partner counts the number 
$query = "SELECT COUNT(*) as totalSim FROM siminars"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalSim = $row['totalSim'];
} else {
    $totalSim = 0;
}

?>
<?php

include '../Config/conn.php';
// Partner counts the number 
$query = "SELECT COUNT(*) as totalProj FROM projects"; // Replace "your_table_name" with the actual name of your table
$result = $conn->query($query);

// Step 3: Process the result and get the count
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalProj = $row['totalProj'];
} else {
    $totalProj = 0;
}

?>

<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!--[ daily sales section ] start-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Employees</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-people-roof" style="padding: 20px;"></i>   <?php echo "   " . $totalEmployees; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--[ daily sales section ] end-->
                                <!--[ Monthly  sales section ] starts-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Membership</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-people-group" style="padding: 20px;"></i>   <?php echo "   " . $totalMem; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--[ Monthly  sales section ] end-->
                                <!--[ year  sales section ] starts-->
                                <a href="./participant.php" class="col-md-6 col-xl-4">
                                <!-- <div class="col-md-6 col-xl-4"> -->
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Participant</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-people-group" style="padding: 20px;"></i>   <?php echo "   " . $totalPart; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                <!-- </div> -->
                                </a>
                                <!--[ year  sales section ] end-->
                                <!--[ Recent Users ] start-->

                                                                <!--[ daily sales section ] start-->
                                    <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Partners</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-handshake" style="padding: 20px;"></i>   <?php echo "   " . $totalPartner; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--[ daily sales section ] end-->
                                <!--[ Monthly  sales section ] starts-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Seminars</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-book" style="padding: 20px;"></i>   <?php echo "   " . $totalSim; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--[ Monthly  sales section ] end-->
                                <!--[ year  sales section ] starts-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Projects</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-desktop" style="padding: 20px;"></i>   <?php echo "   " . $totalProj; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4" style="font-size: 36px; color:cornflowerblue;">Users</h6>
                                            <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                    <h3 class="f-w-300 d-flex align-items-center  m-b-0" style="font-weight: 900; font-size:56px; color : rgb(0, 0, 112);"><i class="fa-solid fa-desktop" style="padding: 20px;"></i>   <?php echo "   " . $totalUser; ?></h3>
                                                </div>

                                                
                                            </div>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- [ statistics year chart ] end -->
                                <!--[social-media section] start-->
                                <div class="col-md-12 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-facebook-f text-primary f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>12,281</h3>
                                                    <h5 class="text-c-green mb-0">+7.2% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>35,098</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>3,539</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:45%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-twitter text-c-blue f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>11,200</h3>
                                                    <h5 class="text-c-purple mb-0">+6.2% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>34,185</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-green" role="progressbar" style="width:40%;height:6px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>4,567</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-blue" role="progressbar" style="width:70%;height:6px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fab fa-google-plus-g text-c-red f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>10,500</h3>
                                                    <h5 class="text-c-blue mb-0">+5.9% <span class="text-muted">Total Likes</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>25,998</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:80%;height:6px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>7,753</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:50%;height:6px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[social-media section] end-->
                                <!-- [ rating list ] starts-->
                                <div class="col-xl-4 col-md-6">
                                    <div class="card user-list">
                                        <div class="card-header">
                                            <h5>Rating</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center m-b-20">
                                                <div class="col-6">
                                                    <h2 class="f-w-300 d-flex align-items-center float-left m-0">4.7 <i class="fas fa-star f-10 m-l-10 text-c-yellow"></i></h2>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="d-flex  align-items-center float-right m-0">0.4 <i class="fas fa-caret-up text-c-green f-22 m-l-10"></i></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>5</h6>
                                                    <h6 class="align-items-center float-right">384</h6>
                                                    <div class="progress m-t-30 m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>4</h6>
                                                    <h6 class="align-items-center float-right">145</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>3</h6>
                                                    <h6 class="align-items-center float-right">24</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>2</h6>
                                                    <h6 class="align-items-center float-right">1</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>1</h6>
                                                    <h6 class="align-items-center float-right">0</h6>
                                                    <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                        <div class="progress-bar" role="progressbar" style="width:0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ rating list ] end-->
                                

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








<?php

include './footer.php';

?>