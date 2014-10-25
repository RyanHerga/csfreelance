<style>
body{
  background:rgba(239, 239, 239, 0.55) !important;
}
.container.main{
  background-color: white;
  border: 1px solid #E7E7E7;
  margin-top: 10px;
  padding: 10px;
  margin-bottom:20px;
  color:#000 !important;
}
.col-md-8.right{
  border-left: 1px solid rgba(0, 0, 0, 0.11);
}
.table tr, td, th{
  border:none;
}
</style>

<script type="text/javascript">
    // Data and done callbacks
    var targeturl;
    var ece = 0;
    var dataCallback = function(data) {
         ece = 1;
         document.getElementById("organizationname").value = data[0]['data']['name'];
         document.getElementById("address").value = data[0]['data']['address'];
         document.getElementById("organization_type").value = data[0]['data']['organization_type'];
         document.getElementById("classification").value = data[0]['data']['classification'];
        
    }

    var failed =  function(){  
        if(ece == 0){
         swal("Oh Oh...", "Looks like the Tax ID is invalid.", "warning");
        }
    }

// 3. Do the query (when the function is called)
    var doQuery = function() {
      ece = 0;
      var tax_id = document.getElementById("taxid").value;
      targeturl = "http://www.melissadata.com/lookups/np.asp?ein="+tax_id;
      // Query for tile Nonprofit_info
      importio.query({
        "connectorGuids": [
          "f5647a68-9071-4b50-829d-a84bdcf9b535"
        ],
        "input": {
          "webpage/url": targeturl
        }
      }, { "data": dataCallback, "done": failed});
    }

</script>
<?php Template::show('freelancer/register.tpl'); ?>
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
                <td><input type="text" class="form-control" name="fullname" required placeholder="What do we call you?" /></td>
              </tr>
              <tr>
                <td>Email: </td>
                <td><input type="email" class="form-control" name="email" required placeholder="Where can we reach you?" /></td>
              </tr>
              <tr>
                <td>Job Title/Position: </td>
                <td><input type="text" class="form-control" name="position" required placeholder="How are you related to the company?" /></td>
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
                    <input type="text" id="taxid" class="form-control" name="tax_id" placeholder="9 Digit Tax ID Number" />
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="button" onclick="doQuery();">FETCH</button>
                    </span>
                  </div><!-- /input-group -->
                </td>
              </tr>
              <tr>
                <td>Organization Name: </td>
                <td><input type="text" id="organizationname" class="form-control" required name="organizationname" placeholder="What's it known as?" /></td>
              </tr>
              <tr>
                <td>Address: </td>
                <td><input type="text" id="address" class="form-control" required name="address" placeholder="Where is the organization located?" /></td>
              </tr>
               <tr>
                <td>Organization Type: </td>
                <td><input type="text" id="organization_type" class="form-control" required name="organization_type" placeholder="What kind of organization is it?" /></td>
              </tr>
               <tr>
                <td>Classification: </td>
                <td><input type="text" id="classification" class="form-control" required name="classification" placeholder="How would you classify it? (eg. Medical Research, Religious, etc...)" /></td>
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
                <td><input type="text" class="form-control" name="username" required placeholder="How you'll appear to others" /></td>
              </tr>
              <tr>
                <td>Password: </td>
                <td><input type="password" class="form-control" name="password" required placeholder="Shhh! It's a secret." /></td>
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


