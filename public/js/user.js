var table = $('#userTable').DataTable({
    stateSave:true,
    "searching": true,
    "processing": true,
    "order": 5,
    "responsive":!0,
    // "oLanguage": {
    //     "sEmptyTable":"No Record Found",
    // },
    "lengthMenu": [10, 25, 50, 75, 100 ],
    "serverSide": true,
    "bInfo": true,
    "autoWidth": true,
    "orderCellsTop": true,
    "columns": [
        {
            'data': 'full_name',
        },
        {
            'data': 'email',
        },
        {
            'data': 'gender',
        },
        {
            'data': 'phone',
        },
        {
            'data': 'department',
        },
        {
            'data': 'joining_date',
        },
        {
            'data': 'updated_at',
        },
        {
            'data': 'status',
        },
        {
            'data': 'action',
            orderable: false,
            searchable: false
        }
    ],
    "bPaginate":true,
    // dom: doms,
    // buttons:button,
    initComplete: function () {
        // this.api().columns([5]).visible(false);
    },
    
    "ajax": {
        url: url,
        type: "get", // method  , by default get
        global: false,
        "data": function ( d ) {
            d.status = $('.statusFilter').val();
         },
        "error":function(){
            // window.location.reload();
        }
    }
});
$(document).find('#joinDate').datepicker();

$(document).on('click', '.edit', function () {
    url = $(this).attr('data-url');
    $.ajax({
        url:url,
        type:'GET',
        success:function(response){
            if(response.status == 'success'){
                user = response.user;
                $('#full_name').val(user.full_name);
                $('#uuid').val(user.uuid);
                $('#email').val(user.email);
                $('#phone_number').val(user.phone_number);
                $('#department').val(user.department);
                $('#joinDate').val(user.joining_date);
                setTimeout(function(){
                    $(document).find('#joinDate').datepicker();
                },200);
            }
        },
        failure:function(response){
        }
    })
})
$(document).find('#createform').validate({
    rules:{
        full_name:{
            required:true,
            maxlength:50,
        },
        email:{
            required:true,
            email:true,
            maxlength:50,
            remote: {
                url: validateEmailURL,
                type: "POST",
                global: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    value: function () {
                        return $("#email").val();
                    },
                    id: function () {
                        return $("#uuid").val();
                    },
                }
            },
        },
        phone_number:{
            required:true,
            minlength:10,
            maxlength:13,
            remote: {
                url: validatePhoneURL,
                type: "POST",
                global: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    value: function () {
                        return $("#phone_number").val();
                    },
                    id: function () {
                        return $("#uuid").val();
                    },
                }
            },
        },
        gender:{
            required:true,
        },
        department:{
            required:true,
            maxlength:50,
        },
        joining_date:{
            required:true,
        }
    },
    ignore: [],
    messages:{
        email:{
            remote:'This email id already taken',
        },
        phone_number:{
            remote:'This number is already taken',
        }
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
});

$(document).on('click', '.saveChange', function () {
    url = $('#createform').attr('action');
    if($('#createform').valid()){
        $.ajax({
            url:url,
            type:'POST',
            data:$('#createform').serialize(),
            success:function(response){
                if(response.status == 'success'){
                    toastr.success(response.msg);
                    $('#createModal').modal('hide');
                    table.ajax.reload(null, false);
                }else{
                    toastr.error(response.msg);
                }
            },
            error:function(){
            }
        })
    }
});

/* Delete user */
$(document).on('click', '.delete', function () {
    url = $(this).attr('data-url');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:url,
                type:'DELETE',
                success:function(response){
                    if(response.status == 'success'){
                        swal(response.msg, {
                            icon: "success",
                        });
                        table.ajax.reload(null, false);
                    }else{
                        swal(response.msg,{
                            icon:"info",
                        });
                    }
                },
                error:function(){
                }
            })
        } else {
            swal("Your imaginary file is safe!");
        }
    });
});

$(document).on('click', '.active_inactive', function () {
    url = $(this).attr('data-url');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:url,
                type:'GET',
                success:function(response){
                    if(response.status == 'success'){
                        swal(response.msg, {
                            icon: "success",
                        });
                        table.ajax.reload(null, false);
                    }else{
                        swal(response.msg,{
                            icon:"info",
                        });
                    }
                },
                error:function(){
                }
            })
        } else {
            table.ajax.reload(null, false);
            swal("Your user is safe!");
        }
    });
});
$('.creatRecord').on('click',function(){
    $('#createModal').modal('show');
    $('#full_name').val('');
    $('#uuid').val('');
    $('#email').val('');
    $('#phone_number').val('');
    $('#department').val('');
    $('#joinDate').val('');
})