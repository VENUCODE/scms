<?php
session_start();

if (!isset($_SESSION['wid'])) {
    header("Location: ./api/logout.php");
    exit;
}

include("../api/connection.php");
// print_r($_SESSION);
if ($conn && !(isset($_SESSION['wphone']) && isset($_SESSION['wshift']))) {
    $sql = "SELECT WSHIFT,WNAME,WPHONE FROM warden_details WHERE WID = '{$_SESSION['wid']}'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['wphone'] = $data['WPHONE'];
		$_SESSION['wname'] = $data['WNAME'];
		$_SESSION['wshift'] = $data['WSHIFT'];
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
		<input id="name" value='<?php echo $_SESSION['wname'];?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text" required value="student Name" />
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="email">Email</label>
		<input id="email" class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-red-300 px-2  focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text"  value="<?php echo $_SESSION['warden_mail'];?>" disabled />
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="phone">Phone</label>
		<input value='<?php echo $_SESSION['wphone'] ;?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="tel" id="phone" required/>
	  </div>
	  <div class="my-1 flex flex-row gap-4">
		<label class=" text-center align-middle w-[9ch] font-mono capitalize first-letter:text-xl" for="shift">SHIFT</label>
		<input id="shift" value='<?php echo $_SESSION['wshift']?>' class="me-1 w-[100%] border-spacing-3 rounded-t border-b-2 border-sky-900 bg-slate-200 focus:bg-slate-100 focus:ps-1 focus:text-slate-900 focus:outline-none" type="text" />
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
			const shift=$('#shift').val();
			if(name!=='' && phone>6000000000 && phone<9999999999 && shift!==''){
				$.ajax({
						url: "../api/warden_api/updateProfile.php",
						type: "POST",
						data: { name:name,phone:phone,shift:shift },
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
