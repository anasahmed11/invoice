<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div >
        <div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><b>Users</b></h1><br>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 ">

                </div>
                <div class="col-md-4 ">
                    <div class="small-box bg-yellow text-center">
                        <div class="inner">
                            <h2>Number of  Users </h2> <br><h3><?php echo e($count); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">

                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#new-modal-article"><i class="fas fa-user-plus"></i> Add new</button><br><br>
                </div>
            </div>
            <form >
                <div class="row">

                    <div class="col-md-3">
                        <input type="text" name="user_name" class="form-control" placeholder="name">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="user_phone" class="form-control" placeholder="phone">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="type" class="form-control" placeholder="type">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-dark" type="submit" ><i class="fas fa-search"></i> search </button>
                        <button class="btn btn-danger " ><a href="<?php echo e(route('users')); ?>" style="color: white"><i class="far fa-arrow-alt-circle-left"></i> back</a></button><br><br>
                    </div>

                </div>
            </form>
                <div class="row">
                    <div class="table-holder table-responsive">
                        <table class="article-table table table-striped  ">
                            <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>phone</th>
                                 <th>Email</th>
                                <th>type</th>
                                <th>update</th>
                                <th>delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="article-<?php echo e($row->id); ?>">
                                    <th scope="row"><?php echo e($row->id); ?></th>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e($row->phone); ?></td>
                                    <td><?php echo e($row->email); ?></td>
                                    <td><?php echo e($row->user_type?$row->user_type->name:''); ?></td>
                                    <td><button class="edit-article btn btn-info"  data-toggle="modal" data-target="#edit-modal-article" data-email="<?php echo e($row->email); ?>"  data-phone="<?php echo e($row->phone); ?>" data-id="<?php echo e($row->id); ?>" data-name="<?php echo e($row->name); ?>"  data-type="<?php echo e($row->type); ?>" ><i class='far fa-edit'></i> update</button></td>
                                    <td><button class="delete-article btn btn-danger" data-id="<?php echo e($row->id); ?>"><i class='far fa-trash-alt'></i> delete</button></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($users->links()); ?>

                            </tbody>
                        </table><br><br>
                    </div>
                </div>
                <!-- new-Modal -->
                <div class="modal fade" id="new-modal-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width:800px;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title m-auto" id="exampleModalLongTitle"> add</h5>
                            </div>
                            <div class="modal-body">
                                <?php echo e(Form::open(array('id'=>'add-user-form','enctype'=>'multipart/form-data'))); ?>

                                <?php echo e(Form::label('name', 'name ')); ?>

                                <?php echo e(Form::text('name','',['class' => 'form-control'])); ?><br>
                                <?php echo e(Form::label('phone', 'phone ')); ?>

                                <?php echo e(Form::text('phone','',['class' => 'form-control'])); ?><br>
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                           class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                                           placeholder="<?php echo e(__('adminlte::adminlte.password')); ?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('password')): ?>
                                        <div class="invalid-feedback">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                           class="form-control <?php echo e($errors->has('password_confirmation') ? 'is-invalid' : ''); ?>"
                                           placeholder="<?php echo e(__('adminlte::adminlte.retype_password')); ?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <div class="invalid-feedback">
                                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php echo e(Form::label('email', 'email ')); ?>

                                <?php echo e(Form::email('email','',['class' => 'form-control'])); ?><br>
                                <?php echo e(Form::label('type', 'type')); ?>

                                <?php echo e(Form::select('type', $types,null, array('class' => 'form-control'))); ?><br>
                                <?php echo e(Form::submit('save',['class' => 'btn btn-dark btn-lg btn-block','id'=>'add-user'])); ?>

                                <?php echo e(Form::close()); ?>

                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- new-Modal -->
                <div class="modal fade" id="edit-modal-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width:800px;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title m-auto" id="exampleModalLongTitle"> edit</h5>
                            </div>
                            <div class="modal-body">
                                <?php echo e(Form::open(array('id'=>'edit-user-form','enctype'=>'multipart/form-data'))); ?>

                                <?php echo e(Form::label('name', 'name ')); ?>

                                <?php echo e(Form::text('name','',['class' => 'form-control','id'=>'name-edit'])); ?><br>
                                <?php echo e(Form::label('phone', 'phone ')); ?>

                                <?php echo e(Form::text('phone','',['class' => 'form-control','id'=>'phone-edit'])); ?><br>
                                <?php echo e(Form::label('email', 'email ')); ?>

                                <?php echo e(Form::email('email','',['class' => 'form-control' ,'id'=>'email-edit'])); ?><br>
                                <?php echo e(Form::label('type', 'type')); ?>

                                <?php echo e(Form::select('type', $types,null, array('class' => 'form-control','id'=>'type-edit'))); ?><br>
                                <?php echo e(Form::submit('save',['class' => 'btn btn-dark btn-lg btn-block','id'=>'edit-user'])); ?>

                                <?php echo e(Form::close()); ?>

                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script>
        $( document ).ready(function() {
            /* ------------------- new-user----------------- */
            $(document).on("click", "#add-user", function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'users',
                    data: new FormData($("#add-user-form")[0]),
                    dataType: 'json',
                    async: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire(
                            'done',
                            '',
                            'success'
                        );
                        $('#add-user-form').trigger("reset");
                        $(".article-table").prepend("<tr class='article-" + data.id + "'>" +
                            "<th scope='row'>" + data.id + "</th>" +
                            "<td>" + data.name + "</td>" +
                            "<td>" + data.phone + "</td>" +
                            "<td>" + data.email + "</td>" +
                            "<td>" + data.user_type.name+ "</td>" +
                            "<td><button class='edit-article btn btn-info'  data-toggle='modal' data-target='#edit-modal-article' data-id='" + data.id + "' data-phone='" + data.phone + "'data-email='" + data.email +  "' data-name='" + data.name + "' data-type='" + data.type + "' ><i class='far fa-edit'></i> update</button></td>" +
                            "<td><button class='delete-article btn btn-danger'  data-id='" + data.id + "' ><i class='far fa-trash-alt'></i>  delete</button></td>" +
                            "</tr>");

                    },
                    error: function (data) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            Swal.fire({
                                type: 'error',
                                title: 'sorry',
                                text: value,
                            });
                        })
                    }
                });
                e.preventDefault();
            });
            /* ------------------- delete user----------------- */
            $(document).on('click', ".delete-article", function (e) {
                var user_id = $(this).data('id');
                Swal.fire({
                    title: 'are you sure ?',
                    text: "if you delete you cant return the date",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'yes delete it '
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: 'users/' + user_id,
                            processData: false,
                            success: function (res) {
                                if ((res.errors)) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'sorry try again',
                                        text: 'error',
                                    })
                                } else {

                                    if(res.message){
                                        Swal.fire({
                                            type: 'error',
                                            title: 'sorry',
                                            text: res.message,
                                        });
                                    }else{
                                        $(".article-" + user_id).remove();
                                        Swal.fire(
                                            'done',
                                            'successful',
                                            'success'
                                        )
                                    }

                                }
                            },
                            error: function (data) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'sorry',
                                    text: 'try again',
                                });
                            }
                        });
                    } else {
                        swal("sorry", "not deleted", "error");
                    }
                });
                e.preventDefault();
            });
            /* -------------------edit user----------------- */
            $(document).on('click', ".edit-article", function (e) {
                $('#edit-user-form').trigger("reset");
                $("#name-edit").val($(this).data('name'));
                $("#email-edit").val($(this).data('email'));
                $("#phone-edit").val($(this).data('phone'));
                $("#type-edit").val($(this).data('type'));
                userId = $(this).data('id');
            });
            $(document).on('click', "#edit-user", function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'users/' + userId,
                    data: new FormData($("#edit-user-form")[0]),
                    dataType: 'json',
                    async: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if((data.errors)) {
                            Swal.fire({
                                type: 'error',
                                title: 'sorry',
                                text: 'try again',
                            });

                        }else {
                            Swal.fire(
                                'done',
                                'successful',
                                'success'
                            );
                            $(".article-"+userId).replaceWith("<tr class='article-" + data.id + "'>" +
                                "<th scope='row'>" + data.id + "</th>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + data.phone + "</td>" +
                                "<td>" + data.email + "</td>" +
                                "<td>" + data.user_type.name+ "</td>" +
                                "<td><button class='edit-article btn btn-info'  data-toggle='modal' data-target='#edit-modal-article'data-id='" + data.id + "' data-email='" + data.email +  "'  data-phone='" + data.phone + "'  data-name='" + data.name + "'  data-type='" + data.type + "'><i class='far fa-edit'></i> update</button></td>" +
                                "<td><button class='delete-article btn btn-danger'  data-id='" + data.id + "' ><i class='far fa-trash-alt'></i> delete</button></td>" +
                                "</tr>")

                        }
                        $('#edit-user-form').trigger("reset");
                    },
                    error:function (data) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            Swal.fire({
                                type: 'error',
                                title: 'sorry',
                                text: value,
                            });
                        })
                    }
                });
                e.preventDefault();
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\dayra\resources\views/admin/users/users.blade.php ENDPATH**/ ?>