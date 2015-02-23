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
        <h4 class="allianz pull-left">Nonprofit Control Panel</h4>
        <div id="menu" class="pull-right">
            <a class="link">Projects</a>
            <a class="link" href="<?php echo url('nonprofit/messages'); ?>">Messages</a>
            <a class="link" href="<?php echo url('nonprofit/cp'); ?>">Foundation Sheet</a>
        </div>
      </div>
    </div>
    <div class="container" style="margin-top:5px;">
      <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="cp-item">
              <h4 class="allianz" style="color:#000;">Guides</h4>
              <a href="#">Using our website, effectively.</a>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            <div class="cp-item" style="border:1px dashed #CCC;">
              <h4 class="allianz" style="color:#000;">Foundation Sheet</h4>
                <table class="table table-striped table-bordered">
                <tr>
                    <th>Representative Name(You):</th>
                    <td><input type="text" disabled class="form-control disabled" value="<?php echo $userinfo->commonname; ?>" name="commonname" placeholder="Empty Field" /></td>
                </tr>
                <tr>
                    <th>Representative Position:</th>
                    <td><input type="text" disabled class="form-control disabled" value="<?php echo $userinfo->user_title; ?>" name="position" placeholder="Empty Field" /></td>
                </tr>
                <tr>
                    <th>Foundation Name:</th>
                    <td><input type="text" class="form-control disabled" value="<?php echo $userinfo->nonprofit_name; ?>" name="nonprofit_name" placeholder="Empty Field" /></td>
                </tr>
                <tr>
                    <th>Foundation Type:</th>
                    <td><input type="text" class="form-control" value="<?php echo $userinfo->foundation_type; ?>" name="foundation_type" placeholder="Empty Field" /></td>
                </tr>
                <tr>
                    <th>Foundation Address</th>
                    <td><input type="text" class="form-control" value="<?php echo $userinfo->physical_address; ?>" name="physical_address" placeholder="Empty Field" /></td>
                </tr>
                <tr>
                    <th>Foundation Description</th>
                    <td><textarea class="form-control" name="description"><?php echo $userinfo->description; ?></textarea></td>
                </tr>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
