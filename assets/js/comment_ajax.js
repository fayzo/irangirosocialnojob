   
   $(document).ready(function() {
            $("#addcomment").on('click', function () {
               $("#comment_form").modal('show');
            });

            $("#comment_form").on('hidden.bs.modal', function () {
               $("#view_comment").fadeOut();
               $("#edit_comment").fadeIn();
               $("#commt_editRowID").val(0);
               $("#title_comment").val("");
               $("#athors-comment").val("");
               $("#textarea_comment").val("");
               $("#email_comment").val("");
               $("#date_comment").val("");
               $("#address_comment").val('');
               $("#country_comment").val("");
               $("#state_comment").val("");
               $("#closeBtn").fadeIn();
               $("#btn_comment").attr('onclick',"manageDatas('addcomment')").fadeOut();
               $("#btn_comment").fadeOut();
               $("#comment_save").fadeIn();

            });

            getExistingDatacomment_(0,50);
        });

        function deleteRowcomment_(rowID) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/comment_db.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowcomment',
                        rowID: rowID
                    }, success: function (response) {
                        $("#title"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }
        
         function un_approved(rowID) {
                     if (confirm('Are you sure??')) {
                         $.ajax({
                             url: 'core/ajax_db/comment_db.php',
                             method: 'POST',
                             dataType: 'text',
                             data: {
                                 key: 'un_approved',
                                 rowID: rowID
                             }, success: function (response) {
                                 $("#title"+rowID).parent().remove();
                                 alert(response);
                             }
                         });
                     }
                 }

        function viewOReditcomment_(rowID, type) {
            $.ajax({
                url: 'core/ajax_db/comment_db.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'viewOReditcomment',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#show_comment").fadeIn();
                        $("#edit_comment").fadeOut();
                        $("#comm_image").fadeOut();
                        $("#imageView_comment").html(response.image);
                        $("#titleView_comment").html(response.title);
                        $("#athorsView_comment").html(response.athors);
                        $("#textareaView_comment").html(response.textarea);
                        $("#emailView_comment").html(response.email);
                        $("#dateView_comment").html(response.date);
                        $("#addressView_comment").html(response.address);
                        $("#countryView_comment").html(response.country);
                        $("#stateView_comment").html(response.state);
                        $("#closeBtn").fadeIn();
                        $("#btn_comment").fadeOut();
                        $("#comment_Save").fadeOut();

                    } else {
                        $("#edit_comment").fadeIn();
                        $("#show_comment").fadeOut();
                        $("#comm_image").fadeOut();
                        $("#commt_editRowID").val(rowID);
                        $("#image_comment").val(response.image);
                        $("#title_comment").val(response.title);
                        $("#athors_comment").val(response.athors);
                        $("#textarea_comment").val(response.textarea);
                        $("#email_comment").val(response.email);
                        $("#date_comment").val(response.date);
                        $("#address_comment").val(response.address);
                        $("#country_comment").val(response.country);
                        $("#state_comment").val(response.state);
                        $("#closeBtn").fadeIn();
                        $("#comment_Save").fadeOut();
                        $("#btn_comment").attr('value', 'update').attr('onclick', "manageDatas('updateRow')").fadeIn();
                    }

                    $(".modal-title").html(response.title);
                    $("#comment_form").modal('show');
                }
            });
        }

        function getExistingDatacomment_(begin_nmber, end_nmber) {
            $.ajax({
                url: 'core/ajax_db/comment_db.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'fetch_array',
                    begin_nmber: begin_nmber,
                    end_nmber: end_nmber
                }, success: function (response) {
                    if (response != "Max") {
                        $('#tbody_comment').append(response);
                        begin_nmber += end_nmber;
                        getExistingDatacomment_(begin_nmber, end_nmber);
                    } else
                        $(".table_comment").DataTable();
                }
            });
        }

        $(document).ready(function (e) {
        	    $("#comment_Save").on('submit',(function(e) {
        		e.preventDefault();
        
                       $.ajax({
                           url: 'core/ajax_db/ajaxupload_comment.php',
                           dataType: 'text',
                           type: "POST",
        			       data:new FormData(this),
        			       contentType: false,
           	               cache: false,
        			       processData:false,
                          beforeSend : function()
        		        	{
        		        		$("#preview").fadeOut();
        		        		$("#err").fadeOut();
        		        	},
                          success: function (response) {
                                  alert(response);
                                  console.log(response); 
                         }, error: function(e) {
        		           		$("#err").html(e).fadeIn();
        	               	} 	
                       });
            }));
        } );


        function manageDatas(key) {
            var editRowID = $("#commt_editRowID");
            var title = $("#title_comment");
            var athors = $("#athors_comment");
            var textarea = $("#textarea_comment");
            var email = $("#email_comment");
            var date = $("#date_comment");
            var address = $("#address_comment");
            var country = $("#country_comment");
            var state = $("#state_comment");
                $.ajax({
                   url: 'core/ajax_db/comment_db.php',
                   method: 'POST',
                   data:{
                       key: key,
                       title: title.val(),
                       athors: athors.val(),
                       textarea: textarea.val(),
                       email: email.val(),
                       date: date.val(),
                       address: address.val(),
                       country: country.val(),
                       state: state.val(),
                       rowID: editRowID.val()

                   }, 
                     beforeSend : function()
		        	{
		        		$("#preview").fadeOut();
		        		$("#err").fadeOut();
		        	},
                   success: function (response) {
                       if (response !="success"){
                           alert(response);
                           console.log(response);
                       }else {
                           $("#title"+editRowID.val()).html(title.val());
                           $("#athors"+editRowID.val()).html(athors.val());
                           $("#textarea"+editRowID.val()).html(textarea.val());
                           $("#email"+editRowID.val()).html(email.val());
                           $("#date"+editRowID.val()).html(date.val());
                           $("#address"+editRowID.val()).html(address.val());
                           $("#country"+editRowID.val()).html(country.val());
                           $("#state"+editRowID.val()).html(state.val());
                           title.val("");
                           athors.val("");
                           textarea.val("");
                           email.val("");
                           date.val("");
                           address.val('');
                           country.val("");
                           state.val("");
                           $("#comment_form").modal('hide');
                           $("#btn_comment").attr('onclick',"manageDatas('addcomment')").fadeOut();
                       }
                   }, error: function(e) {
		           		$("#err").html(e).fadeIn();
	               	} 	

                });
        }
