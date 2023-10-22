<!-- bootstrap files-->
<?php 
session_start();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .swal-icon img{
        height:80px;
        width:80px;
    }
    </style>
<section  class=" container rounded-3 mx-2 my-2   bg-info-subtle mb-2  ">
    <div class="container py-2 text-center  ">
        <h1 class="text-dark fw-bolder my-2 fs-3 ">Welcome to CMS</h1>
    </div>
    <div class="row ">
        <div class="col-md-6 mx-auto  light_blur_bg rounded-3 py-2 align-items-center justify-content-center complaint-box animated">
            <h2 class="text-center mb-4 fs-6 text-black-50 fw-bold">Submit a Complaint</h2>
            <form  class="mt-3  py-3  rounded-2 " id="form_data"  method='post'>
                <div class="form-group gap-1 ">
                    <label  class="text-dark text-capitalize fw-bold" >Complaint Type</label>
                    <select class="form-control outline-none  bd-btm-2 light_blur_bg  dropdown" required id="complaintType">
                        <!-- <div class="dropdown-menu"> -->
                        <option class="dropdown-item" value="SELECT" selected>Select</option>
                        <option class="dropdown-item" value="Electricity" >Electricity</option>
                        <option class="dropdown-item" value="Plumbing">Plumbing</option>
                        <option class="dropdown-item" value="Cleaning">Cleaning</option>
                        <option class="dropdown-item" value="Security">Security</option>
                        <!-- </div>Add more complaint types as needed -->
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-dark text-capitalize fw-bold" for="complaintDetails">Complaint Details</label>
                    <textarea class="  bd-btm-2 light_blur_bg  form-control" id="complaintDetails" rows="3" placeholder="Describe your problem"></textarea>
                </div>
                <div class="d-grid mt-3 justify-content-center"> <button id="submit" type="submit" class=" px-5 btn bg-success fw-bolder position-relative  btn-submit "> Submit</button></div>
            </form>
        </div>
    </div>
</section>
<script>
$(document).ready(() => {
 
    $("#submit").click((e) => {
        e.preventDefault();
        const compType = $('#complaintType').val();
        const complaint = $('#complaintDetails').val();
        if (!(compType === 'SELECT' && complaint === '')) {
            $.ajax({
    type: "POST",
    url: "../api/student_api/newComplaint.php",
    data: {
        complaintType: compType,
        complaintDetails: complaint
    },
    dataType: "json",
    beforeSend: () => {
        // Show loading indicator here
        swal({
            title: 'Registering....',
            allowEscapeKey: false,
            allowOutsideClick: false,
            button: false,
            icon:"../imgs/loading.svg"
        });

    },
    complete: () => {
      
        swal.close();
    },
    success: function(data) {
        // Show success message
        swal({
            text: data.text,
            icon: data.icon,
            timer: 1200,
            button:false
        });
        $('#complaintType').val('');
        $('#complaintDetails').val('');
    },
    error: function(err) {
        window.parent.console.log(err);
    }
});




        }
    });
});
</script>
