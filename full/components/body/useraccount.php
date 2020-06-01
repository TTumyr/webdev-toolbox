<div class="userprofile">
  <div class="">
    <div id="profile-tab" class="tab-pane active">
      <div class="">
        <h3 class=""><i class="icon-user mgr-10 profile-icon"></i> ABOUT</h3>
        <div class="">
          <div class="">
            <div class="">
              <label class="">First Name:</label>
              <input class="" value="<?= $_SESSION['userdata'][0]['firstname']?>" />
            </div>
          </div>
          <div class="">
            <div class="row mgbt-xs-0">
              <label class="col-xs-5 control-label">Last Name:</label>
              <input class="col-xs-7 controls" value="<?= $_SESSION['userdata'][0]['lastname']?>" />
              <!-- col-sm-10 --> 
            </div>
          </div>
          <div class="">
            <div class="">
              <label class="">User Name:</label>
              <input class="" value="<?= $_SESSION['userdata'][0]['username']?>" />
            </div>
          </div>
          <div class="">
            <div class="">
              <label class="">Email:</label>
              <input class="" value="<?= $_SESSION['userdata'][0]['email']?>" />
            </div>
          </div>
              </div> 
          </div>   
      </div> 
  </div> 
</div>
