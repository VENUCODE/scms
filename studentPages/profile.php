<?php
session_start();

if (isset($_SESSION['sid'])) {
    include('../api/connection.php');
    // echo !(isset($_SESSION['student_details']));

    if ($conn && !(isset($_SESSION['student_details']))) { 
         $sql = "SELECT `SID`, `SNAME`, `DORM`, `BRANCH` FROM `student_details` WHERE `SID` = '{$_SESSION['sid']}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['student_details'] = mysqli_fetch_assoc($result);
             
        }
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.tailwindcss.com"></script>
<script src="counter.js"></script>
<link rel="stylesheet" href="navbar.css" />
<div class="max-md:col-6 bg-violet-300  my-0 h-[100%] mb-4 mx-auto gap-10 flex flex-col justify-center items-center">
    <div class="card min-w-[350px] max-w-[450px] shadow-md" id="profile">
        <div class="card-header text-center bg-violet-700  font-bold  text-light">
            Your Profile</div>
            <div class="card-body bg-white">
    <div class="d-flex flex-column align-items-center text-center">
        <img src="BG.jpg" profile_pic="Admin" class="border-4 border-white" style="object-fit: cover; border-radius: 50%; height: 80px; width: 80px">
        <div class="mt-3">
            <h4 class="max-md:text-md text-xl font-bold text-slate-800 text-capitalize">
                <?php echo isset($_SESSION['student_details']['SNAME']) ? $_SESSION['student_details']['SNAME'] : ''; ?>
            </h4>
            <h5 class="text-slate-400 mb-3 text-sm">
                <?php
                if (isset($_SESSION['sid'])) {
                    echo $_SESSION['sid'];
                }
                ?>
            </h5>
            <h5 class="text-slate-400 mb-1">
                <?php echo isset($_SESSION['student_details']['BRANCH']) ? $_SESSION['student_details']['BRANCH'] : ''; ?>
            </h5>
            <h6 class="text-slate-400 mb-3 text-sm">
                <?php
                if (isset($_SESSION['student_details']['YEAR']) && isset($_SESSION['student_details']['COLLEGE'])) {
                    echo $_SESSION['student_details']['YEAR'] . ', ' . $_SESSION['student_details']['COLLEGE'];
                }
                ?>
            </h6>
            <a href="update.html" target="content_frame" class="bg-violet-400 py-2 rounded-md shadow-md px-4 show" value="Edit profile">Edit profile</a>
        </div>
    </div>
</div>

    </div>

    <div class="row mx-auto card p-2 shadow-sm bg-sky-100">
        <div class="max-md:col-8 min-w-[350px] max-w-[450px] px-2   py-3 flex flex-column ">
            <div class="max-md:col-6 flex flex-row  justify-around px-3 gap-0 ">
                <span>
                    <h5 class=" text-start mb-1 bg-orange-400 text-slate-700   rounded-sm p-2 w-[25ch] ">No.of
                        complaints raised</h5>
                </span>
                <h4 id="raise_count" data-counter-min="1" data-counter-max="100" data-counter-speed="25"
                    data-counter-increment="3" data-counter-delay="0"
                    class=" number_count text-start mb-1 bg-orange-200 rounded-sm text-slate-700 px-4 p-2">0</h4>
            </div>
            <div class="max-md:col-6 flex flex-row  justify-around px-3 gap-0 ">
                <span>
                    <h5 class=" text-start mb-1 bg-emerald-400 text-slate-700   w-[25ch] rounded-sm p-2">No.of
                        complaints solved</h5>
                </span>
                <h4 id="solved_count" data-counter-min="1" data-counter-max="100" data-counter-speed="25"
                    data-counter-increment="3" data-counter-delay="0"
                    class=" number_count text-start mb-1 bg-emerald-200 rounded-sm text-slate-700 px-4 p-2">0</h4>
            </div>

        </div>
        <!-- <span class="example" data-counter-min="1" data-counter-max="100" data-counter-speed="25"
            data-counter-increment="3" data-counter-delay="0">
        </span> -->
    </div>

</div>
<script>
    const counter = new Counter('#solved_count');
    const counter2=new Counter('#raise_count');
    const sessionData = <?php echo json_encode($_SESSION); ?>;
    console.log(sessionData);
</script>