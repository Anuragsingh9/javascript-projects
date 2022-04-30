@extends('layouts.auth-master')
@section('content')
    <div class="manual-add">
        <div class="manual-add-desc">
            <h4>Add bulk user manually</h4>
            <h5>Please click on the Plus icon to create form</h5>
        </div>
            <div class="record-info">
                <span class="total-users-info"></span>
            </div>
        <form action="" method="post" id="manual-form">
            <meta name="csrf-token" content="{{ csrf_token() }}"/>
        </form>
        <div class="submit-btn">
            <div class="form-btn" id="add-form"><i class="fa fa-plus"></i></div>
            <div class="form-btn"><input type="submit" id="submit-btn"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let formCount = 0;
            $("#add-form").click(function () {
                let formId = 'form' + formCount;
                let dynamicForm = `<div class="manual-add-form" id="${formId}">` +
                    `<div class="form-item"><input type="text" placeholder="Enter first name" id="${'fname' + formCount}">
                    <div class="${'user-' + formCount + '-fname'} error-text"></div></div>` +
                    `<div class="form-item"><input type="text"  placeholder="Enter last name" id="${'lname' + formCount}">
                    <div class="${'user-' + formCount + '-lname'} error-text"></div></div>` +
                    `<div class="form-item"><input type="email"  placeholder="Enter email" id="${'email' + formCount}">
                    <div class="${'user-' + formCount + '-email'} error-text"></div></div>` +
                    '</div>'
                $('#manual-form').append(`${dynamicForm}`)
                formCount++;
            });

            function getFormData() {
                console.log(formCount - 1)
                const allData = [];
                for (let i = 0; i <= formCount - 1; i++) {
                    let fname = $(`#${"fname" + i}`).val();
                    let lname = $(`#${"lname" + i}`).val();
                    let email = $(`#${"email" + i}`).val();
                    let userData = {
                        'fname': fname,
                        'lname': lname,
                        'email': email,
                    }
                    allData.push(userData);
                }
                return allData;
            }

            function collectData() {
                const userData = getFormData()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Accept": "application/json"
                    }
                });
                $.ajax({
                    url: "{{route('add-users')}}",
                    method: 'post',
                    data:
                        {
                            user: userData
                        },
                    beforeSend: function () {
                        $(document).find('.error-text').text('');
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            $.each(data.error, function (prepfix, val) {
                                let rClass = prepfix.replace(/\./g, '-');
                                console.log(rClass)
                                $(`.${rClass}`).text(val[0]);
                            });
                        }else {
                            console.log(data.created_users_count)
                            $('.total-users-info').text('Total users created: ' + data.created_users_count)
                            $('#manual-form').trigger("reset");
                        }
                    }
                });
            }

            $('#submit-btn').click(function () {
                collectData();
                // $('#manual-form').trigger("reset");
            });
        });
    </script>
@endsection
