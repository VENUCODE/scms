<?php
session_start();

if (!isset($_SESSION['sid'])) {
    header("Location: ./api/logout.php");
    exit;
}

include("../api/connection.php");

if ($conn && !(isset($_SESSION['dorm']) && isset($_SESSION['phone']))) {
    $sql = "SELECT DORM,SNAME,SPHONE FROM student_details WHERE SID = '{$_SESSION['sid']}'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['phone'] = $data['SPHONE'];
        $_SESSION['dorm'] = $data['DORM'];
		$_SESSION['sname'] = $data['SNAME'];
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="] flex min-w-[350px] flex-col items-center justify-center bg-violet-200 px-2 py-3  max-sm:max-w-[100%] h-100">
	
	<form  class="flex w-[90%] max-w-[600px] flex-col rounded-md bg-[rgba(255,255,255,0.4)] px-3 pt-3  py-2 shadow-md">
	 <h4 class=" py-4 w-100 text-center font-bold font-mono text-xl">UPDATE PROFILE</h4> 
	 <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="">Name</label>
		<input id="name" value='<?php echo $_SESSION['sname'];?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text" required value="student Name" />
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="email">Email</label>
		<input id="email" class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-red-300 px-2  focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text"  value="<?php echo $_SESSION['student_mail'];?>" disabled />
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="phone">Phone</label>
		<input value='<?php echo $_SESSION['phone'] ;?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="tel" id="phone" required/>
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="dorm">Dorm</label>
		<input id="dorm" value='<?php echo $_SESSION['dorm']?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text" />
	  </div>
	  <div class="my-1 flex flex-row items-center justify-center">
		<button type="submit" id="updateForm" class="my-2 rounded-md bg-sky-600 px-4 py-2 text-slate-100 shadow-md">UPDATE</button>
	  </div>
	</form>
  </div>
  

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script>
		
		$('#updateForm').click((e)=>{
			e.preventDefault()
			const name=$('#name').val();
			const phone=$('#phone').val();
			const dorm=$('#dorm').val();
			//window.parent.console.log(name,phone,dorm);
			if(name!=='' && phone>6000000000 && phone<9999999999 && dorm!==''){
				$.ajax({
						url: "../api/student_api/updateProfile.php",
						type: "POST",
						data: { name:name,phone:phone,dorm:dorm },
						dataType:'json',
						beforeSend:()=>window.parent.console.log("sending...."),
						success: function (data) {
							swal({
									text: data.text,
									icon: data.icon,
									timer: 1200,
									button: false,
									});
						},
						complete:()=>window.console.log('complete...'),
						error: function (jqXHR, textStatus, errorThrown) {
							window.parent.console.error("Ajax request failed: " + errorThrown);
						},
						});
			}
		});

	</script>
