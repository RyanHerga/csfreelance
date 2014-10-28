<div id="top-wrapper" style="height:100px;">
  <div id="navigation">
    <div class="container">
      <h1 class="bigtitle allianz">CSFreelance<small>The Community Service Freelancing Network</small></h1>
    </div>
  </div>
  <div class="container" style="padding-top: 150px;">
   
  </div>
</div>
<div id="main-wrapper">
  <div class="top-banner">
    <div class="container">
      <h4 class="allianz">Register as a non-profit<i class="glyphicon glyphicon-paperclip pull-right"></i></h4>
    </div>
  </div>
  <div class="container main">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <h4 class="allianz" style="color:#000;">About you</h4>
          <p>Tell us about who you are, and your relations with the nonprofit.</p>
        </div>
        <div class="col-md-8 col-lg-8 right">
        <form action="<?php echo url('/nonprofit/register');?>" method="post" enctype="multipart/form-data">
          <table class="table">
              <tr>
                <td>Full Name: </td>
                <td><input type="text" class="form-control" name="fullname" required placeholder="What do we call you?" value="<?php echo $fullname; ?>"/></td>
              </tr>
              <tr>
                <td>Email: </td>
                <td><input type="email" class="form-control" name="email" required placeholder="Where can we reach you?" value="<?php echo $email; ?>"/></td>
              </tr>
              <tr>
                <td>Job Title/Position: </td>
                <td><input type="text" class="form-control" name="position" required placeholder="How are you related to the company?" value="<?php echo $position; ?>"/></td>
              </tr>
          </table>
        </div>
      </div>
      <br />
        <div class="row">
        <div class="col-md-4 col-lg-4">
          <h4 class="allianz" style="color:#000;">About the nonprofit</h4>
          <p>Tip: If you know the organization's tax ID, just fill that out and click on FETCH!</p>
        </div>
        <div class="col-md-8 col-lg-8 right">
          <table class="table">
              <tr>
                <td style="width:200px;">Tax ID: </td>
                <td> 
                   <div class="input-group">
                    <input type="text" id="taxid" class="form-control" name="tax_id" placeholder="9 Digit Tax ID Number" value="<?php echo $tax_id; ?>"/>
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="button" onclick="doQuery();">FETCH</button>
                    </span>
                  </div><!-- /input-group -->
                </td>
              </tr>
              <tr>
                <td>Organization Name: </td>
                <td><input type="text" id="organizationname" class="form-control" required name="organizationname" placeholder="What's it known as?" value="<?php echo $organizationname; ?>"/></td>
              </tr>
              <tr>
                <td>Address: </td>
                <td><input type="text" id="address" class="form-control" required name="address" placeholder="Where is the organization located?" value="<?php echo $address; ?>"/></td>
              </tr>
               <tr>
                <td>Organization Type: </td>
                <td><input type="text" id="organization_type" class="form-control" required name="organization_type" placeholder="What kind of organization is it?" value="<?php echo $organization_type; ?>" /></td>
              </tr>
               <tr>
                <td>Classification: </td>
                <td><input type="text" id="classification" class="form-control" required name="classification" placeholder="How would you classify it? (eg. Medical Research, Religious, etc...)" value="<?php echo $classification; ?>"/></td>
              </tr>
          </table>
        </div>
      </div><br />
       <div class="row">
        <div class="col-md-4 col-lg-4">
          <h4 class="allianz" style="color:#000;">Account Setup</h4>
          <p>Username, password, all the pretty stuff...</p>
        </div>
        <div class="col-md-8 col-lg-8 right">
          <table class="table">
              <tr>
                <td>Desired Username: </td>
                <td><input type="text" class="form-control" name="username" required value="<?php echo $username; ?>" placeholder="How you'll appear to others" /></td>
              </tr>
              <tr>
                <td>Password: </td>
                <td><input type="password" class="form-control" name="password" required value="<?php echo $password; ?>" placeholder="Shhh! It's a secret." /></td>
              </tr>
          </table>
        </div>
      </div><br />
      <div class="row">
      <div class="col-md-4 col-lg-4">
          <h4 class="allianz" style="color:#000;">That's it!</h4>
          <p>Your application will now be submitted for review. You should receive a reply, within a week.</p>   
      </div>
      <div class="col-md-8 col-lg-8">
          <button type="submit" class="btn btn-success btn-lg btn-block">Process Application</button>
      </div>
      <input type="hidden" name="action" value="register" />
      </form>
  </div>
  </div>

</div>


