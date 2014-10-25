<style>
.registertable{
	width:100%;
}
.registertable tr{
	line-height:50px;
}
</style>
<!-- Modal -->
<div class="modal fade" id="freelancerregistration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:100px;" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?php echo url('/freelancer/register');?>" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register as a Volunteer Freelancer</h4>
      </div>
      <div class="modal-body">
        <table class="registertable">
        	<tr>
        		<th>Full Name</th>
        		<td><input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>" required placeholder="Full Name" /></td>
        	</tr>
        	<tr>
        		<th>Email</th>
        		<td><input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required placeholder="Email"/></td>
        	</tr>
        	<tr>
        		<th>Username</th>
        		<td><input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required placeholder="Username"/></td>
        	</tr>
        	<tr>
        		<th>Password</th>
        		<td><input type="password" class="form-control" name="password" required placeholder="Password"/></td>
        	</tr>
        	<tr>
        		<th>Verify Password</th>
        		<td><input type="password" class="form-control" name="password_verification" required placeholder="Verify Password"/></td>
        	</tr>
        </table>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="action" value="register" />
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Nevermind</button>
        <button type="submit" class="btn btn-sm btn-success">Register</button>
      </div>
      
      </form>
    </div>
  </div>
</div>