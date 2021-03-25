<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">



    <?php include("head_libs.php"); ?>


</head>

<body class="fontb bg33">
    <?php //include "header.php";?>
    

    <section class="padd con con85" id="contact_1">
        <p class="size42 cl_b tc lh_1p4 b8 mb_2">Sign Up</p>

        <div class="bg_w sh_md form_grid mt_2">
            <form id="form1" method="post" action="/action_page.php" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <!-- <label for="fname">Email</label> -->
                        <input type="text" class="form-control rounded-0 p-4" id="fname" placeholder="First Name" required />
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control rounded-0 p-4" id="lname" placeholder="Last Name" required />
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control rounded-0 p-4" id="email" placeholder="Email" required />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <input type="tel" class="form-control rounded-0 p-4" id="phoneNo" placeholder="Phone No" required />
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control rounded-0 p-4" id="zipcode" placeholder="Zipcode" required />
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control rounded-0 p-4" id="address" placeholder="Address" required />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select id="state" class="form-control rounded-0" required>
                <option value="-1" disabled selected>Select State</option>
                <option value="Sindh">Sindh</option>
                <option value="Panjab">Panjab</option>
                <option value="KPK">KPK</option>
              </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select any option.</div>
                    </div>

                    <div class="form-group col-md-6">
                        <select id="city" class="form-control rounded-0" required>
                <option value="-1" disabled selected>Select City</option>
                <option value="karachi">karachi</option>
                <option value="Lahore">Lahore</option>
                <option value="Hyderabad">Hyderabad</option>
              </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select any option.</div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea name="msg" class="form-control rounded-0" id="msg" cols="20" rows="10" placeholder="Describe your issue" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="rememberMe">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="rememberMe"
                  required
                />
                Remember me
              </label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">Please check this checkbox.</div>
                    </div>
                </div>

                <div class="centre">
                    <input type="submit" value="Submit" class="button btn_sm d_in b7" />
                </div>
            </form>
            <!-- End of form -->
        </div>
    </section>


    
    <?php //include("footer.php"); ?>


    <?php include("footer_libs.php"); ?>



</html>