
//  START OF UPLOAD IMAGE CONTENT
$(document).ready(function () {
    //If BUSINESS LOGO image edit link is clicked
    $("#edit_linkUploadLogo").on('click', function (e) {
        e.preventDefault();
        $("#fileInputLogo:hidden").trigger('click');
    });
    //If image edit link is clicked
    $("#edit_linkUpload").on('click', function (e) {
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });
    //On BUSINESS LOGO select file to upload
    $("#fileInputLogo").on('change', function () {
        var image = $('#fileInputLogo').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInputLogo').val('');
            return false;
        } else {
            $("#picUploadFormLogo").submit();
        }
    });

    $("#fileInput").on('change', function () {
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        } else {
            $("#picUploadForm").submit();
        }
    });

    $("#edit_linkCoverUpload").on('click', function (e) {
        e.preventDefault();
        $("#cover_fileInput:hidden").trigger('click');
    });

    $("#cover_fileInput").on('change', function () {
        var cover_image = $('#cover_fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(cover_image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#cover_fileInput').val('');
            return false;
        } else {
            $('#cover_uploadForm').hide();
            $("#cover_picUploadForm").submit();
        }
    });

    $("#photo_change_domestics").on('click', function (e) {
        e.preventDefault();
        $("#change_domestics:hidden").trigger('click');
    });

    $("#change_domestics").on('change', function () {
        var cover_image = $('#change_domestics').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(cover_image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#change_domestics').val('');
            return false;
        } else {
            $('#cover_uploadForm').hide();
            $("#Form_change_domestics").submit();
        }
    });

    $(document).on('click', '.profile-edit-more', function () {
        var user_id = $(this).data('user'); 
        $.ajax({
            url: 'core/ajax_db/profile_edit_more',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'profile_edit_more',
                user_id: user_id
            },
            success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".profile-popup").hide();
                });
                // console.log(response);
            }
        });

    });

});

// After completion of image upload process
function domestics_completeUpload(success, fileName) {
    if (success == $('#domestics_id').val()) {
        $('#imagePreview').attr("src", "");
        $('#imagePreview').attr("src", fileName);
        $('#fileInput').attr("value", fileName);
        console.log(success);
        console.log(fileName);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}

function completeUpload(success, fileName) {
    if (success == $('#edit_profile').val()) {
        $('#imagePreview').attr("src", "");
        $('#imagePreview').attr("src", fileName);
        $('#fileInput').attr("value", fileName);
        console.log(success);
        console.log(fileName);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}

// After completion of image upload process
function completeUploadLogo(success, fileName) {
    if (success == $('#edit_profileLogo').val()) {
        $('#imagePreviewLogo').attr("src", "");
        $('#imagePreviewLogo').attr("src", fileName);
        $('#fileInputLogo').attr("value", fileName);
        console.log(success);
        console.log(fileName);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}

function cover_completeUpload(success, cover_Name) {
    if (success == $('#edit_cover').val()) {
        $('#cover_imagePreview').attr("src", "");
        $('#cover_imagePreview').attr("src", cover_Name);
        $('#cover_fileInput').attr("value", cover_Name);
        console.log(success);
        console.log(cover_Name);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}

// $(document).ready(function () {
//     var t = $('#edit_profile').val();
//     console.log(t);
//     $.ajax({
//         url: 'core/ajax_db/profileEditFectchimage',
//         type: 'post',
//         dataType: 'json',
//         data: {
//             key: 'image',
//             id: t
//         },
//         success: function (response) {
//             var userPicture = (response.profile_image) ? 'assets/image/users_profile_cover/' + response.profile_image
//                 : 'assets/image/users_profile_cover/defaultprofileimage.png';
//             var userPictureURL = userPicture;
//             $('#imagePreview').attr('src', userPictureURL);
//             $('#cover_nameView4').html(response.username);
//             var cover_userPicture = (response.cover_image) ? 'assets/image/users_profile_cover/' + response.cover_image
//                 : 'assets/image/users_profile_cover/defaultCoverImage.png';
//             var cover_userPictureURL = cover_userPicture;
//             $('.cover_imagePreview').attr('src', cover_userPictureURL);
//             // console.log(response);
//             console.log(userPictureURL);
//             console.log(cover_userPictureURL);
//         }
//     });
// });

function careers(key) {
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var career = $("#career");
    var id = $("#id_career");
        $.ajax({
            url: 'core/ajax_db/profileEditFectchimage',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                firstname: firstname.val(),
                lastname: lastname.val(),
                career: career.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // setInterval(function() {
                    //     location.reload();
                    // }, 2000);
                    $("#respone-success").html(response);
                } else {
                    $("#response").html(response);
                }
            }
        });
}
    
function aboutMe(key) {
    var education = $('#education');
    var diploma = $('#diploma');
    var location = $('#location');
    var skills = $('#skills');
    var hobbys = $('#hobbys');
    var id = $('#id_aboutMe');

        $.ajax({
            url: 'core/ajax_db/profileEditFectchimage',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                education: education.val(),
                diploma: diploma.val(),
                location: location.val(),
                skills: skills.val(),
                hobbys: hobbys.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // setInterval(function() {
                    //     location.reload();
                    // }, 2000);
                    $("#responses").html(response);
                } else {
                    $("#responses").html(response);
                }
            }
        });
    }
    
function company(key) {
    var company_education = $('#company_education');
    var type_of_business = $('#type_of_business');
    var location = $('#location');
    var address = $('#address');
    var size_of_people = $('#size_of_people');
    var id = $('#company_id');

        $.ajax({
            url: 'core/ajax_db/profileEditFectchimage',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                company_education:company_education.val(),
                type_of_business: type_of_business.val(),
                location: location.val(),
                address: address.val(),
                size_of_people: size_of_people.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // setInterval(function() {
                    //     location.reload();
                    // }, 2000);
                    $("#responsesCOMP").html(response);
                } else {
                    $("#responsesCOMP").html(response);
                }
            }
        });
    }
