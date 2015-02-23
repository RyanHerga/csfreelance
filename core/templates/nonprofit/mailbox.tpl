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
        <h4 class="allianz pull-left">Nonprofit Control Panel - Messages</h4>
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
              <h4 class="allianz" style="color:#000;"><?php echo $userinfo->commonname; ?></h4>
              <h6 class="allianz" style="color:#000;font-style:normal;"><?php echo $userinfo->user_title; ?></h6>
              <h6 class="allianz" style="color:#000;font-style:normal;"><?php echo $userinfo->nonprofit_name; ?></h6>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            <div class="cp-item">
            <div role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Inbox</a></li>
                <li role="presentation"><a href="#outbox" aria-controls="outbox" role="tab" data-toggle="tab">Outbox</a></li>
                <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">New Message</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="inbox">
                   <table class="table table-condensed table-bordered">
                      <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>From</th>
                          <th>Options</th>
                      </tr>
                      <?php foreach($messages as $messages){ ?>
                      <tr>

                      </tr>
                      <?php } ?>
                  </table>

                </div>
                <div role="tabpanel" class="tab-pane" id="outbox">...</div>
                <div role="tabpanel" class="tab-pane" id="new">...</div>
              </div>

            </div>

             
            </div>
        </div>
      </div>
    </div>
</div>
