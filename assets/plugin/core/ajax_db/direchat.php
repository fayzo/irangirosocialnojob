<div class="row">
       <div class="col-md-3">
           <!-- DIRECT CHAT PRIMARY -->
           <div class="box box-primary direct-chat direct-chat-primary">
               <!-- direct-chat direct-chat-primary -->
               <div class="box-header with-border main-active">
                   <h3 class="box-title"><i> Message Chat</i></h3>

                   <div class="box-tools pull-right">
                       <span id="tooltipsmessages" data-toggle="tooltip" title="3 New Messages" class="badge bg-info "><?php if( $notific['totalmessage'] > 0){echo '<span>'.$notific['totalmessage'].'</span>'; } ?></span>
                       <button type="button" style="outline-style:none;" class="btn btn-box-tool collapse-minus1" data-toggle="collapse"
                           data-target="#collapseExample"><i class="fa fa-minus"></i></button>
                           <button type="button" style="outline-style:none;" class="btn btn-box-tool" id="direct-chat-contacts-view1" data-toggle="tooltip" title="Contacts"
                               data-widget="chat-pane-toggle">
                               <i class="fa fa-comments"></i></button>
                           <button type="button" style="outline-style:none;"  class="btn btn-box-tool close-chat1" data-widget="remove"><i class="fa fa-times"></i></button>
                           <!-- onclick="remove()" -->
                           <!--data-widget="remove"" -->
                   </div>
               </div>
               <!-- /.box-header -->
               <div class="collapse" id="collapseExample">
                </div>
                <!-- /.hide-->
               </div>
               <!--/.END of collapse direct-chat -->
           </div>
           <!--/.direct-chat -->
       </div>
       <!-- /.col -->
   </div>
   <!-- /.row -->