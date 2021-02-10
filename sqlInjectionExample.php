<?php

/*
 *  SQL Injection should be demonstrated in Login Form
 */




/*
 *   Plain Registration Form Below
 */


include ("Common/Header.php");
include ("Common/Functions.php");

if(isset($_POST["btnRegister"]))
{
    //Code goes here
}
?>

<div class="d-flex justify-content-center">
  <form method="post" action="sqlInjectionExample.php" name="register">
      <div class="col-sm-12 col-md-12 col-lg-12 mt-5">
          <div class="form-group-row">
            <h1 class="text-center">Register</h1>
          </div>
        <div class="form-group row" style="justify-items: center">
            <label for="name" class="font-weight-bold">Name:</label>
            <input type="text" name="name" id="name" class="form-control" \>
        </div>

          <div class="form-group row" style="justify-items: center">
              <label for="userName" class="font-weight-bold">User Name:</label>
              <input type="text" name="userName" id="userName" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <label for="email" class="font-weight-bold">Email:</label>
              <input type="email" name="email" id="email" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <label for="phone" class="font-weight-bold">Phone:</label>
              <input type="text" name="phone" id="phone" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <label for="address" class="font-weight-bold">Address:</label>
              <input type="text" name="address" id="address" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <label for="password" class="font-weight-bold">Password:</label>
              <input type="password" name="password" id="password" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <label for="passwordConfirmation" class="font-weight-bold">Password Confirmation:</label>
              <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="form-control" \>
          </div>

          <div class="form-group row" style="justify-items: center">
              <button type="submit" class="btn btn-primary" name="btnRegister">Register</button>
          </div>
      </div>
  </form>
</div>

<?php include "Common/Footer.php";?>
