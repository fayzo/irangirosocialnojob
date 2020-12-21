
function profile_edit_more(key) {
    var firstname = $("#firstnameProfile");
    var lastname = $("#lastnameProfile");
    var birth = $("#datestart");
    var telephone = $("#telephoneProfile");
    var email = $("#emailProfile");
    var status = $("#statusProfile");
    var about = $("#aboutProfile");
    var province = $('.provincecode');
    var districts = $('.districtcode');
    var sector = $('.sectorcode');
    var cell = $('.codecell');
    var village = $('.CodeVillage');
    var education = $("#educationProfile");
    var datestartEduc = $("#datestartEduc");
    var dateendEduc = $("#dateendEduc");
    var education2 = $("#education2");
    var datestart2 = $("#datestart2");
    var dateend02 = $("#dateend02");
    var education3 = $("#education3");
    var datestart3 = $("#datestart3");
    var dateend03 = $("#dateend03");
    var datestartExp = $("#datestartExp");
    var working = $("#working");
    var duties = $("#duties");
    var field = $("#field");
    var field1 = $("#field1");
    var field2 = $("#field2");
    var employment = $("#employment");
    var user_id = $("#user_id");

    if (isEmpty(firstname) && isEmpty(lastname) && isEmpty(birth) && isEmpty(telephone) && isEmpty(email) && 
        isEmpty(status) && isEmpty(about) && isEmpty(province) && isEmpty(districts) && isEmpty(sector) && 
        isEmpty(cell) && isEmpty(village) && isEmpty(education) && isEmpty(datestartEduc) && isEmpty(dateendEduc) &&
        isEmpty(education2) && isEmpty(datestart2) && isEmpty(dateend02) && isEmpty(education3) && 
        isEmpty(datestart3) && isEmpty(dateend03) && isEmpty(datestartExp) && isEmpty(working) && 
        isEmpty(duties) && isEmpty(field) && isEmpty(field1) && isEmpty(field2) && isEmpty(employment)){

        $.ajax({
        url: 'core/ajax_db/profile_edit_more',
        method: "POST",
        dataType: "text",
        data: {
            profile_edit: key,
            user_id: user_id.val(),
            firstname: firstname.val(),
            lastname: lastname.val(),
            birth: birth.val(),
            telephone: telephone.val(),
            email: email.val(),
            status: status.val(),
            about: about.val(),
            province: province.val(),
            districts: districts.val(),
            sector: sector.val(),
            cell: cell.val(),
            village: village.val(),
            education: education.val(),
            datestartEduc: datestartEduc.val(),
            dateendEduc: dateendEduc.val(),
            education2: education2.val(),
            datestart2: datestart2.val(),
            dateend02: dateend02.val(),
            education3: education3.val(),
            datestart3: datestart3.val(),
            dateend03: dateend03.val(),
            datestartExp: datestartExp.val(),
            working: working.val(),
            duties: duties.val(),
            field: field.val(),
            field1: field1.val(),
            field2: field2.val(),
            employment: employment.val(),
            
        },
        success: function (response) {
            // console.log(response);
            if (response.indexOf('SUCCESS') >= 0) {
                // setInterval(function() {
                //     location.reload();
                // }, 2000);
                $("#respone-profile").html(response);
            } else {
                $("#respone-profile").html(response);
            }
        }
    });

    }
}