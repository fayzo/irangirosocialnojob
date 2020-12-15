  $(document).ready(function() {
            $("#addcomment").on('click', function () {
               $("#uncomment_form").modal('show');
            });

            $("#uncomment_form").on('hidden.bs.modal', function () {
               $("#view_uncomment").fadeOut();
               $("#edit_uncomment").fadeIn();
               $("#commt_editRowID").val(0);
               $("#title_uncomment").val("");
               $("#athors_uncomment").val("");
               $("#textarea_uncomment").val("");
               $("#email_uncomment").val("");
               $("#date_uncomment").val("");
               $("#address_uncomment").val('');
               $("#country_uncomment").val("");
               $("#state_uncomment").val("");
               $("#closeBtn").fadeIn();
               $("#btn_uncomment").attr('onclick',"manageData_uncomment('addcomment')").fadeOut();
               $("#btn_uncomment").fadeOut();
               $("#uncomment_save").fadeIn();

            });

            getExistingDatauncomment_(0,50);
        });

        function deleteRowuncomment_(rowID) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/uncomment_db.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowuncomment',
                        rowID: rowID
                    }, success: function (response) {
                        $("#title"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }
        
        function approved(rowID) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/uncomment_db.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'approved',
                        rowID: rowID
                    }, success: function (response) {
                        $("#title"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewORedituncomment_(rowID, type) {
            $.ajax({
                url: 'core/ajax_db/uncomment_db.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'viewORedituncomment',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#show_uncomment").fadeIn();
                        $("#uncommt_image").fadeOut();
                        $("#edit_uncomment").fadeOut();
                        $("#imageView_uncomment").html(response.image);
                        $("#titleView_uncomment").html(response.title);
                        $("#athorsView_uncomment").html(response.athors);
                        $("#textareaView_uncomment").html(response.textarea);
                        $("#emailView_uncomment").html(response.email);
                        $("#dateView_uncomment").html(response.date);
                        $("#addressView_uncomment").html(response.address);
                        $("#countryView_uncomment").html(response.country);
                        $("#stateView_uncomment").html(response.state);
                        $("#closeBtn").fadeIn();
                        $("#btn_uncomment").fadeOut();
                        $("#uncomment_Save").fadeOut();

                    } else {
                        $("#edit_uncomment").fadeIn();
                        $("#show_uncomment").fadeOut();
                        $("#uncommt_image").fadeOut();
                        $("#commt_editRowID").val(rowID);
                        $("#image_uncomment").val(response.image);
                        $("#title_uncomment").val(response.title);
                        $("#athors_uncomment").val(response.athors);
                        $("#textarea_uncomment").val(response.textarea);
                        $("#email_uncomment").val(response.email);
                        $("#date_uncomment").val(response.date);
                        $("#address_uncomment").val(response.address);
                        $("#country_uncomment").val(response.country);
                        $("#state_uncomment").val(response.state);
                        $("#closeBtn").fadeIn();
                        $("#uncomment_Save").fadeOut();
                        $("#btn_uncomment").attr('value','update').attr('onclick',"manageData_uncomment('updateRow')").fadeIn();
                    }

                    $(".modal-title").html(response.title);
                    $("#uncomment_form").modal('show');

                }
            });
        }

        function getExistingDatauncomment_(begin_nmber, end_nmber) {

            $.ajax({
                url: 'core/ajax_db/uncomment_db.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'fetch_array',
                    begin_nmber: begin_nmber,
                    end_nmber: end_nmber
                }, success: function (response) {
                    if (response != "Max") {
                        $('#tbody_uncomment').append(response);
                        begin_nmber += end_nmber;
                        getExistingDatauncomment_(begin_nmber, end_nmber);
                    } else
                        $(".table_uncomment").DataTable();
                }
            });
        }

 $(document).ready(function (e) {
	    $("#uncomment_Save").on('submit',(function(e) {
		e.preventDefault();

                $.ajax({
                   url: 'core/ajax_db/ajaxupload_uncomment.php',
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
});


        function manageData_uncomment(key) {
            var editRowID = $("#commt_editRowID");
            var title = $("#title_uncomment");
            var athors = $("#athors_uncomment");
            var textarea = $("#textarea_uncomment");
            var email = $("#email_uncomment");
            var date = $("#date_uncomment");
            var address = $("#address_uncomment");
            var country = $("#country_uncomment");
            var state = $("#state_uncomment");
                $.ajax({
                   url: 'uncomment_db.php',
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
                           $("#btn_uncomment").attr('onclick',"manageData_uncomment('adduncomment')").fadeOut();
                       }
                   }, error: function(e) {
		           		$("#err").html(e).fadeIn();
	               	} 	

                });
        }
