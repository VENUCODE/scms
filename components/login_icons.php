<div class=" w-100 d-flex align-content-center bg-dark py-5 my-3 px-1 rounded-3 mt-1 mx-2 justify-content-center flex-column position-relative"    data-aos="fade-in"   data-aos-easing="ease-in-out"
           data-aos-mirror="true"
           data-aos-once="true"id="cover">

    <div class="row w-100 d-flex justify-content-around  align-items-center pt-1 p-2 my-0 mx-auto " id="login-icons">
      <div id="warden" 
           data-aos="zoom-in"
           data-aos-offset="200"
           data-aos-delay="50"
           data-aos-duration="1000"
           data-aos-easing="ease-in-out"
           data-aos-mirror="false"
           data-aos-once="true" 
           class="icon col d-inline fw-bold text-center align-items-center mx-2">
        <img class="d-block" src="./imgs/officer.png" alt="W" style='height:40px;width:40px;margin-left:auto;margin-right:auto;'>
        <span>WARDEN</span>
      </div>
      <div id="student" data-aos="zoom-in"
           data-aos-offset="10"
           data-aos-distance="10px"
           data-aos-delay="50"
           data-aos-duration="1000"
           data-aos-easing="ease-in-out"
           data-aos-mirror="false"
           data-aos-once="true" class="icon col d-inline fw-bold text-center align-items-center mx-2">
        <img class="d-block" src="./imgs/student.png" style='height:40px;width:40px;margin-left:auto;margin-right:auto;' alt="S">
        <span>STUDENT</span>
      </div>
      <div id="welfare" data-aos="zoom-in"
           data-aos-offset="200"
           data-aos-delay="50"
           data-aos-duration="1000"
           data-aos-easing="ease-in-out"
           data-aos-mirror="false"
           data-aos-once="true" class="icon col d-inline fw-bold text-center align-items-center mx-2">
        <img class="d-block" src="./imgs/welfare.png" style='height:40px;width:40px;margin-left:auto;margin-right:auto;' alt="WF">
        <span>WELFARE</span>
      </div>
    </div>
  <!--</div>-->
  
  <!-- Separate Row for the Form -->
  <div class="row position-relative mx-auto ">
    <form class=" form d-block login-form bg-form my-4 pt-2 pb-0 px-3 rounded-3" >
      <label for="usermode">UserMode</label>
      <span class="bg-light d-block p-1 px-2 form-control" name="usermode" id="usermode" required>choose mode</span>
      <label class="form-label" for="email">Email</label>
      <input id='email' class='form-control' type="email" placeholder="user email" name="email" required>
      <label class="form-label" for="password">Password</label>
      <input id='password' class='form-control' type="password" placeholder="Password" name="password" required>
      <div class="row mx-2 my-4 justify-content-between "> 
        <span  class='btn text-decoration-underline col-auto link-offset-1-hover text-dark shadow'>Forgot Password ?</span>
        <button type="submit" class='btn btn-dark px-4 col-auto mx-2 ' id="login-submit">Login</button>
      </div>
    </form>
  </div>
</div>
