$(document).ready(function () {
    // userByRole();
    // showSubject();
    // showTutor();
    // tutorDetail();
    // tutorUpdate();
    // tutorDelete();
    // tutorDeleteModal();
    // tutorSubjectListing();
    // tutorSubjectEdit();
    // tutorSubjectUpdateForm(); 
    // tutorFormUpdate();
});

// admin-l,ogin api
// $('#admin-login-btn').click(function () {
//     var form = new FormData();
//     form.append("email", $('#email').val());
//     form.append("password", $('#password').val());
//     var settings = {
//         "url": "/api/user/login-via-email",
//         "method": "POST",
//         "timeout": 0,
//         "processData": false,
//         "mimeType": "multipart/form-data",
//         "contentType": false,
//         "data": form
//     };

//     $.ajax(settings).done(function (response) {
//         console.log(response);
//         location.href = '/dashboard';
//     });
// });

//   console.log('getCookie', getCookie('user_auth_token'))
$('#admin-login-btn').click(async function () {
    // alert('hello');
    var url = "/api/user/login-via-email?locale=en";
    var formData = new FormData();
    formData.append("email", $('#email').val());
    formData.append("password", $('#password').val());
    let response = await postCustomAjax(url, false, formData);
    if (response.status == 'success') {
        let token = response.data.token;
        let user_details = JSON.stringify(response.data.user_details);
        setCookie('user_auth_token', token, 1);
        setCookie('user_details', user_details, 1);
        location.href = '/admin/dashboard';
    }
});

function tutorCreateOrUpdateCountyDropdown(){
    $.ajax({
        url: "/api/countries",
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var countries = response.data;
            $('#country').html('<option value="">-- Select Country --</option>');
            $('#state').html('<option value="">-- Select State --</option>');
            $('#city').html('<option value="">-- Select City --</option>');
            countries.forEach(function (key, value) {
                $("#country").append('<option value="' + key
                    .iso_code + '">' + key.name + '</option>');
            });
        }

    });
}

function tutorCreateOrUpdateStateDropdown(country_iso_code){
    $.ajax({
        url: "/api/states?country_iso_code="+country_iso_code,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var countries = response.data;
            $('#state').html('<option value="">-- Select State --</option>');
            $('#city').html('<option value="">-- Select City --</option>');
            countries.forEach(function (key, value) {
                $("#state").append('<option value="' + key
                    .iso_code + '">' + key.name + '</option>');
            });
        }

    });
}

function tutorCreateOrUpdateCityDropdown(country_iso_code, state_iso_code){
    $.ajax({
        url: "/api/cities?country_iso_code="+country_iso_code+'&state_iso_code='+state_iso_code,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var countries = response.data;
            $('#city').html('<option value="">-- Select City --</option>');
            countries.forEach(function (key, value) {
                $("#city").append('<option value="' + key
                    .id + '">' + key.name + '</option>');
            });
        }

    });
}
function userByRole(){
    $.ajax({
        url: "/api/user/list",
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var users = response.data;
            users.forEach(function (key, value) {
                console.log(key);
                $('#user-list').append("<tr>\
                                        <td>" + key.fname + key.lname + "</td>\
                                        <td>" + key.email + "</td>\
                                        <td>" + (key?.mobile || '') + "</td>\
                                        <td>" + (key?.gender || '') + "</td>\
                                        <td>" + (key?.address || '') + "</td>\
                                        </tr>");
            });
        }

    });
}

// Tutor listing api
function showTutor() {
    $.ajax({
        url: "/api/tutor/list",
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            var tutors = response.data_list;
            tutors.forEach(function (key, value) {
                $('#tutor-list').append("<tr>\
                <td>" + key.fname + key.lname + "</td>\
                <td>" + key.email + "</td>\
                <td>" + (key?.mobile || '') + "</td>\
                <td>" + (key?.gender || '') + "</td>\
                <td>" + (key?.address || '') + "</td>\
                <td class=" + key.id + ">" + '<a class="btn btn-primary btn-sm" href="/tutors/' + key.uuid + '" onclick=tutorView({{' + key.uuid + '}})">Details</a>' + '<a class="btn btn-primary btn-sm btnml-2" href="edit/' + key.uuid + '" onclick=tutorUpdate({{' + key.uuid + '}})">Edit</a>' + '<a class="btn btn-danger btn-sm btnml-2" href="javascript:void(0)" onclick="tutorDelete(' + key.id + ')">Delete</a>' + '<a class="btn btn-primary btn-sm btnml-2" href="'+ key.uuid + '/assign-course">Assign Subject</a>'+"<td>\
                </tr>");
                $('#show-tutor-list').append('<option value="' + value + '">' + key.fname + '</option>');
            });
        }
        // /Log::info('')
    });
}

// tutor validation
$("#tutor-form").validate({
    rules: {
        fname: "required",
        email: {required:true, email:true},
        mobile: "required",
    },messages : {
       fname: "please enter your first name",
    }, 
    submitHandler: function(form) {
        // var form = $('#tutor-create-form');               
        // var formData = new FormData($(form)[0])
        var formData = new FormData(form);
        tutorCreate(formData);
    }
});

// tutor Edit  api
function tutorUpdate(){
    var uuid = $("#tutorUuid").val();
    $.ajax({
        url: "/api/tutor/detail/" + uuid,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var tutorUpdate = response.data;
            console.log(tutorUpdate);
            let city = tutorUpdate.city;
            let state = tutorUpdate.state;
            let country = tutorUpdate.country;
            tutorCreateOrUpdateStateDropdown(country);
            tutorCreateOrUpdateCityDropdown(country, state);
            if(response){
                $('#tutor-update-form input[name=fname]').val(tutorUpdate.fname);
                $('#tutor-update-form input[name=lname]').val(tutorUpdate.lname);
                $('#tutor-update-form input[value='+tutorUpdate.gender+']').attr("checked", true);
                $('#tutor-update-form input[name=dob]').val(tutorUpdate.dob);
                $('#tutor-update-form input[name=email]').val(tutorUpdate.email);
                $('#tutor-update-form input[name=phone]').val(tutorUpdate.mobile);
                $('#tutor-update-form input[name=address]').val(tutorUpdate.address);
                $('#tutor-update-form option[value='+city+']').attr("selected", true);
                $('#tutor-update-form option[value='+state+']').attr("selected", true);
                $('#tutor-update-form option[value='+country+']').attr("selected", true);
                $('#tutor-update-form textarea#bio').val(tutorUpdate.bio);
            }
        }
    });
}

function tutorUpdateForm(){
    var uuid = $("#tutorUuid").val();
    var form = new FormData();
    form.append("fname", $("#fname").val());
    form.append("lname", $("#lname").val());
    form.append("email", $("#email").val());
    form.append("mobile", $("#mobile").val());
    form.append("gender", $("input[name='gender']:checked").val());
    form.append("dob", $("#dob").val());
    form.append("address", $("#address").val());
    form.append("city", $("#city").val());
    form.append("state", $("#state").val());
    form.append("country", $("#country").val());
    form.append("bio", $("#bio").val());
    var settings = {
        "url": "/api/tutor/edit/"+ uuid,
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        console.log(response);
        location.href = '/tutors/list';
    });
}

// tutor View details api
function tutorDetail() {
    var uuid = $("#tutorUuid").val();
    $.ajax({
        url: "/api/tutor/detail/" + uuid,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var detail = response.data;
            if (response) {
                console.log(detail.state);
                $('#view-fname').text(detail.fname + ' ' + detail.lname);
                $('#view-email').text(detail.email);
                $('#view-mobile').text(detail.mobile);
                $('#view-gender').text(detail.gender);
                $('#view-dob').text(detail.dob);
                $('#view-address').text(detail.address);
                $('#view-city').text(detail.city);
                $('#view-state').text(detail.state);
                $('#view-country').text(detail.country);
            }
        }
    });
}

// tutor delete api
function tutorDelete(id){
    $("#tutor-id-delete").val(id);
    $('#tutor-modal').modal('show');
}

function tutorDeleteModal(){
    let id = $("#tutor-id-delete").val();
    $.ajax({
        url: "/api/tutor/delete/" + id,
        method: 'DELETE',
        dataType: 'json',
        success: function (response) {
            var detail = response.data;
            if (response) {
                console.log(detail.fname);
                $('#tutor-modal').modal('hide');
                location.reload();
            }
        }
    });  
}

// Subjects listing api
function showSubject() {
    $.ajax({
        url: "/api/subjects/subject-list",
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            var subjects = response.data_list;
            var subjectList = '';
            subjects.forEach(function (key, value) {
                // alert(value);
                $('#subject-list').append("<tr>\
                                      <td>" + key.title + "</td>\
                                      <td>" + key.description + "</td>\
                                      </tr>");
                $('#show-subject-list').append('<option value="' + value + '">' + key.title + '</option>');
                });
            }
    });
}

$("#btn-submit").click(function (e) {
    e.preventDefault(); 
    var tutor_id = $("#tutorUuid").val();
    var subject_id = $(this).find('option:selected');
    var basic_price = $("#basic_price").val();
    var weekend_price = $("#weekend_price").val();
    var profile =  $("#profile").val();
    // alert(subject_id);
    $.ajax({
        type: 'POST',
        url: "/api/tutor/subject/create",
        // contentType: false,
        // processData: false,
        // mimeTyp: "multipart/form-data",
        data: $("#tutor-subject-form").serialize(),
        success: function (response) {
            console.log(response);
            alert("Form Submited Successfully");
            window.history.back();

        }
    });
});

// Tutor subject listing
function tutorSubjectListing(){
    var Id = $("#tutor_uuid").val();
    $.ajax({
        url: "/api/tutor/subject/detail/" + Id,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var tutorSubjects = response.data;
            tutorSubjects.forEach(function (key, value) {   
                            $('#tutor-subject-list').append("<tr>\
                            <td>" + key.subject.title + "</td>\
                            <td>" + key.basic_price + "</td>\
                            <td>" + (key?.weekend_price || '') + "</td>\
                            <td>" + (key?.profile || '') + "</td>\
                            <td class=" + key.id + ">" + '<a class="btn btn-primary btn-sm" href="' + Id + '/assign-course/' + key.id + '" onclick=tutorUpdate({{' + key.uuid + '}})">Edit</a>' + '<a class="btn btn-danger btn-sm" href="" onclick=tutorSubjectDelete({{' + key.id + '}})">Remove</a>' + "<td>\
                            </tr>");
            });
        }
    });
}

// tutor subject popup-detail in edit form
function tutorSubjectEdit(){
    var id = $("#tutorSubjectId").val();
    $.ajax({
        url: "/api/tutor/subject/" + id,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var tutorSubjectUpdate = response.data;
            alert(tutorSubjectUpdate);
            if(response){
                $('#update-tutor-subject-form option[value='+tutorSubjectUpdate.subject_id+']').attr("selected", true);
                $('#update-tutor-subject-form input[name=basic_price]').val(tutorSubjectUpdate.basic_price);
                $('#update-tutor-subject-form input[name=weekend_price]').val(tutorSubjectUpdate.weekend_price);
                $('#update-tutor-subject-form input[name=profile]').val(tutorSubjectUpdate.profile);
            }
        }
    });
}

// tutor Subject edit form 
$("#btn-edit").click(function (e) {
    e.preventDefault(); 
    var id = $("#tutorSubjectId").val();
    var tutor_id = $("#tutor_id").val();
    var subject_id = $(this).find('option:selected');
    var basic_price = $("#basic_price").val();
    var weekend_price = $("#weekend_price").val();
    var profile =  $("#profile").val();
    $.ajax({
        type: 'POST',
        url: "/api/tutor/subject/update/"+id,
        // contentType: false,
        // processData: false,
        // mimeTyp: "multipart/form-data",
        data: $("#update-tutor-subject-form").serialize(),
        success: function (response) {
            console.log(response);
            alert("Form Submited Successfully");
            location.href="/tutors/"+ tutor_id;

        }
    });
});

// tutor Subject delete
function tutorSubjectDelete(id){
    alert(id);
    $.ajax({
        url: "/api/tutor/subject/delete/" + id,
        method: 'DELETE',
        dataType: 'json',
        success: function (response) {
            var detail = response.data;
            if (response) {
                console.log(detail.fname);

            }
        }
    });  
}

// tutor create in proper loader
$('#tutor-create-btn').click(async function(){
    tutorCreate(formData);
})

// tutor create async function 
async function tutorCreate(formData){
    var url = "/api/tutor/create?locale=en";
    formData.append("fname", $("#fname").val());
    formData.append("lname", $("#lname").val());
    formData.append("email", $("#email").val());
    formData.append("mobile", $("#mobile").val());
    formData.append("gender", $("input[name='gender']:checked").val());
    formData.append("dob", $("#dob").val());
    formData.append("address", $("#address").val());
    formData.append("city", $("#city").val());
    formData.append("state", $("#state").val());
    formData.append("country", $("#country").val());
    formData.append("bio", $("#bio").val());
    let response = await postCustomAjax(url, false, formData);
    console.log(response);
    if(response.status == 'success'){
        toastr.success(response.message, 'Success');
        location.href = '/tutors/list';
    }else{
        toastr.error("Something went wrong.", 'Alert Message !')
    }
}

$('#admin-logout-btn').click(async function () {
    let url = '/api/user/logout?locale=en';
    let data = await getCustomAjax(url, true);
    if (data) {
        deleteCookie('user_details');
        deleteCookie('user_auth_token');
        deleteCookie('user_role');
        location.href = '/admin-login';
    }
});

/** reset password form validate*/
$("#resetPasswordForm").validate({
    rules: {
        password: { required: true},
        confirm_password: {
            required: true,
            equalTo: "#password"
        }
    },messages : {
        password: {
            required: "Password field is required.",
        },
        confirm_password: {
            required: "Confirm Password field is required.",
            equalTo: "Password and Confirm Password should be same."
        },
    }
    ,submitHandler: function(form) {
        var formData = new FormData(form);
        createPassword(formData);
    }
});

/** Reset Password */
async function createPassword(formData){
    var params = new window.URLSearchParams(window.location.search);
    var hash = params.get('hash');
    formData.append('hash', hash);
    let url = '/api/user/reset-password?locale=en';
    let response = await postCustomAjax(url, false, formData);
    if(response.status == 'success'){
        let token = response.data.token;
        let user_details = JSON.stringify(response.data.user_details);
        setCookie('user_auth_token', token, 2);

        location.href = '/tutors/list';
    }
}

// Category list 
function showCategory() {
    $.ajax({
        url: "/api/categories/list",
        method: 'get',
        dataType: 'json',
        success: function (response) {
            // var categories = response.data_list;
            // var categoryList = '';
            // categories.forEach(function (value) {
                // categoryList = categoryList + ' <div class="col-md-3">' +
                //     '<div class="item__inner">' +
                //     '<div class="icon">' +
                //     '<img src="{{ asset("website/assets/images/topics/1.svg" )}}" alt="Icon image">' +
                //     '</div>' +
                //     '<div class="react-content">' +
                //     '<h3 class="react-title"><a href="/category">' + value.title + '</a></h3>' +
                //     '<p>15 Courses</p>' +
                //     '</div>' +
                //     '</div>' +
                //     '</div>';
                // $('#category-list-show').html(categoryList);
            // });
        }
    });
}
/**Get custom ajax */
function getCustomAjax(url, auth = false) {
    $('.loader').css('visibility', 'visible')
    if (auth) {
        let token = getCookie('user_auth_token')
        $.ajaxSetup({
            headers: {
                "authorization": "Bearer " + token
            }
        });
    }
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: url,
            type: "GET",
            processData: false,
            contentType: false,
            success: function (data) {
                $('.loader').css('visibility', 'hidden')
                switch (data.status_code) {
                    case 422:
                        exceptionHandling(data)
                        break;
                    case 401:
                        exceptionHandling(data)
                        break;
                    default:
                        //   console.log("hii")
                }
                if (data ?.response ?.status == 'success' && url.indexOf("app/pre-login") == -1) {
                    if (data.response.message) {
                        toastr.success(data.response.message, 'success');
                    }
                }
                return resolve(data);
            },
            error: function (errResponse, errorType, thrownError) {
                $('.loader').css('visibility', 'hidden')
                let errorMsgText = errResponse.responseText;
                if (errorMsgText) {
                    errorMsgText = JSON.parse(errorMsgText);
                    if (errorMsgText) {
                        exceptionHandling(errorMsgText)
                    } else {
                        toastr.error("Something went wrong.", 'Alert Message !')
                    }
                } else {
                    toastr.error("Something went wrong.", 'Alert Message !')
                }
            }

        });
    });
}
/**Post custom ajax */
function postCustomAjax(url, auth = false, formData) {
    $('.loader').css('visibility', 'visible')
    if (auth) {
        let token = getCookie('user_auth_token')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                "authorization": "Bearer " + token
            }
        });
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    }
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                $('.loader').css('visibility', 'hidden')
                switch (data.status_code) {
                    case 422:
                        exceptionHandling(data)
                        break;
                    case 401:
                        exceptionHandling(data)
                        break;
                    case 500:
                        exceptionHandling(data)
                        break;
                    case 404:
                        exceptionHandling(data)
                        break;
                    default:
                        //   console.log("hii")
                }
                if (data ?.response ?.status == 'success') {
                    if (data.response.message) {
                        toastr.success(data.response.message, 'success');
                    }
                }
                return resolve(data);
            },
            error: function (errResponse, errorType, thrownError) {
                $('.loader').css('visibility', 'hidden')
                let errorMsgText = errResponse.responseText;
                if (errorMsgText) {
                    errorMsgText = JSON.parse(errorMsgText);
                    if (errorMsgText) {
                        exceptionHandling(errorMsgText)
                    } else {
                        toastr.error("Something went wrong.", 'Alert Message !')
                    }
                } else {
                    toastr.error("Something went wrong.", 'Alert Message !')
                }
            }

        });
    });
}
/**Delete custom ajax */
function deleteCustomAjax(url, auth = false) {
    $('.loader').css('visibility', 'visible')
    if (auth) {
        let token = getCookie('user_auth_token')
        $.ajaxSetup({
            headers: {
                "authorization": "Bearer " + token
            }
        });
    }
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: url,
            type: "DELETE",
            processData: false,
            contentType: false,
            success: function (data) {
                $('.loader').css('visibility', 'hidden')
                switch (data.status_code) {
                    case 422:
                        exceptionHandling(data)
                        break;
                    case 401:
                        exceptionHandling(data)
                        break;
                    default:
                }
                if (data ?.response ?.status == 'success') {
                    if (data.response.message) {
                        toastr.success(data.response.message, 'success');
                    }
                }
                return resolve(data);
            },
            error: function (errResponse, errorType, thrownError) {
                $('.loader').css('visibility', 'hidden')
                let errorMsgText = errResponse.responseText;
                if (errorMsgText) {
                    errorMsgText = JSON.parse(errorMsgText);
                    if (errorMsgText) {
                        exceptionHandling(errorMsgText)
                    } else {
                        toastr.error("Something went wrong.", 'Alert Message !')
                    }
                } else {
                    toastr.error("Something went wrong.", 'Alert Message !')
                }
            }

        });
    });
}
/** Handle all exceptions */
function exceptionHandling(data) {
    if (data.response) {
        let errors = data.response;
        if (errors) {
            if (errors ?.jwt_expired || errors ?.token_blacklisted) {
                deleteCookie('user_details');
                deleteCookie('user_auth_token');
                location.href = '/app/login';
            }
            if (errors.errors) {
                $.each(errors.errors, function (key, value) {
                    if (key == "message" && value) {
                        toastr.error(value, 'Alert Message !')
                    }
                })
            } else {
                $.each(errors, function (key, value) {
                    if (key == "message" && value) {
                        toastr.error(value, 'Alert Message !')
                    }
                })
            }
        } else {
            toastr.error('Something went wrong !', 'Alert Message !')
        }
    } else {
        $.each(data, function (key, value) {
            if (key && value) {
                toastr.error(value, 'Alert Message !')
            }
        })
    }
}
/** Set Cookie*/
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
/** Get Cookie*/
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
/** Delete Cookie */
function deleteCookie(cname) {
    document.cookie = cname + "=; expires=" + new Date(0).toUTCString();
}
