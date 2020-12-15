<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                     <form>
                       <span id="response_settingpass1"></span>
                        <input type="hidden" name="id_userSettingPass" id="id_userSettingPass1" value="<?php echo $_SESSION['key'];?>" style="display:none" />

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="current-password"  placeholder="Current Password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="newPassword" id="new-password" aria-describedby="helpId"
                                placeholder="New Password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="verifypassword" id="verify-password" aria-describedby="helpId"
                                placeholder="Verify Password">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="clearfix">
                                <a href="<?php echo INDEXX ;?>" class="float-left" style="padding: 8px; text-decoration: none; background: darkgray;color:white;border: none; border-radius: 4px;">Cancel</a>
                                <button type="button" onclick="settingsUsernamepass1('settingspassword');" class="btn btn-danger float-right">Save Changes</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
