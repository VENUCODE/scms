<!-- bootstrap files-->
<?php 
session_start();
print_r($_SESSION);
?>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
/>
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
  crossorigin="anonymous"
/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .swal-icon img {
    height: 80px;
    width: 80px;
    margin-inline: auto;
  }
</style>
<section class="container rounded-3 mx-auto my-2 bg-indigo-200 mb-2">
  <div class="container py-2 text-center">
    <h1 class="text-dark fw-bolder my-2 fs-3">Welcome to CMS</h1>
  </div>
  <div class="row mx-auto">
    <div
      class="col-md-6 mx-auto rounded-3 py-2 align-items-center justify-content-center complaint-box animated"
    >
      <h2 class="text-center mb-4 fs-6 text-black-50 fw-bold">
        Submit a Complaint
      </h2>
      <form class="mt-3 py-3 rounded-2" id="form_data" method="post">
        <div class="form-group gap-1">
          <label
            for="complaintType"
            class="block mb-2 text-md font-medium text-gray-900 dark:text-white"
            >Complaint Type</label
          >
          <select
            class="border border-sky-300 text-sky-900 max-sm:text-sm rounded-lg focus:ring-none focus:border-none block w-full p-2.5 dark:bg-indigo-500 dark:border-indigo-600 dark:placeholder-indigo-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-indigo-500"
            required
            id="complaintType"
          >
            <!-- <div class="dropdown-menu"> -->
            <option class="dropdown-item" value="SELECT" selected>
              Select
            </option>
            <option class="dropdown-item" value="Electricity">
              Electricity
            </option>
            <option class="dropdown-item" value="Plumbing">Plumbing</option>
            <option class="dropdown-item" value="Cleaning">Cleaning</option>
            <option class="dropdown-item" value="Security">Security</option>
            <!-- </div>Add more complaint types as needed -->
          </select>
        </div>
        <div class="form-group">
          <label
            for="complaintDetails"
            class="block mb-2 max-sm:text-sm text-md font-medium text-indigo-900 dark:text-white"
            >Complaint Details</label
          >
          <textarea
            id="complaintDetails"
            rows="4"
            class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-0 focus:border-0 dark:bg-indigo-500 dark:border-indigo-600 dark:placeholder-indigo-200 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
            placeholder="Describe your problem..."
          ></textarea>
        </div>
        <div class="d-grid mt-3 justify-content-center">
          <button
            id="submit"
            type="submit"
            class="px-5 btn bg-indigo-600 text-slate-300 hover:bg-indigo-800 hover:text-slate-200 fw-bolder position-relative btn-submit"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
  $(document).ready(() => {
    $("#submit").click((e) => {
      e.preventDefault();
      const compType = $("#complaintType").val();
      const complaint = $("#complaintDetails").val();
      if (!(compType === "SELECT" || complaint === "")) {
        $.ajax({
          type: "POST",
          url: "../api/student_api/newComplaint.php",
          data: {
            complaintType: compType,
            complaintDetails: complaint,
          },
          dataType: "json",
          beforeSend: () => {
            // Show loading indicator here
            swal({
              title: "Registering....",
              allowEscapeKey: false,
              allowOutsideClick: false,
              button: false,
              icon: "../imgs/loading.svg",
            });
          },
          complete: () => {
            swal.close();
          },
          success: function (data) {
            swal({
              text: data.text,
              icon: data.icon,
              timer: 1200,
              button: false,
            });
            $("#complaintType").val("");
            $("#complaintDetails").val("");
          },
          error: function (err) {
            window.parent.console.log(err);
          },
        });
      }
    });
  });
</script>
