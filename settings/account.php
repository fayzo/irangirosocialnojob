            <div class="card ">
                <div class="card-body">
                    <form method="post">
                       <span id="response_settings"></span>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="hidden" name="id_userSetting" id="id_userSetting" value="<?php echo $_SESSION['key'];?>" style="display:none" />
                            <input type="text" class="form-control" id="username" value="<?php echo $user['username'];?>" placeholder="UserName">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">@ </span>
                            </div>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email'];?>"  aria-describedby="helpId"
                                placeholder="Email">
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
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" onclick="settingsUsername('userchangename');" class="btn btn-danger">Save Changes</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>