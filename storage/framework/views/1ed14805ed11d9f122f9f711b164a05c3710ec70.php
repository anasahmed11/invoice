<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div >
        <div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><b>Customers</b></h1><br>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 ">

                </div>
                <div class="col-md-4 ">
                    <div class="small-box bg-green text-center">
                        <div class="inner">
                            <h2>Number of  Customers</h2> <br><h3><?php echo e($count); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
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

                    <div class="col-md-2">
                        <input type="text" name="customer_name" class="form-control" placeholder="name">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="customer_phone" class="form-control" placeholder="phone">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-dark" type="submit" ><i class="fas fa-search"></i> search </button>
                        <button class="btn btn-danger " ><a href="<?php echo e(route('customers')); ?>" style="color: white"><i class="far fa-arrow-alt-circle-left"></i> back</a></button>
                        <br><br>
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
                                <th>address</th>
                                <th>email</th>
                                <th>update</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="article-<?php echo e($row->id); ?>">
                                    <th scope="row"><?php echo e($row->id); ?></th>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e($row->phone); ?></td>
                                    <td><?php echo e($row->address); ?></td>
                                    <td><?php echo e($row->email); ?></td>
                                    <td><button class="edit-article btn btn-info"  data-toggle="modal" data-target="#edit-modal-article" data-email="<?php echo e($row->email); ?>" data-address="<?php echo e($row->address); ?>"  data-phone="<?php echo e($row->phone); ?>" data-id="<?php echo e($row->id); ?>" data-name="<?php echo e($row->name); ?>" ><i class='far fa-edit'></i> update</button></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($customers->links()); ?>

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
                                <?php echo e(Form::open(array('id'=>'add-customer-form','enctype'=>'multipart/form-data'))); ?>

                                <?php echo e(Form::label('name', 'name ')); ?>

                                <?php echo e(Form::text('name','',['class' => 'form-control'])); ?><br>
                                <?php echo e(Form::label('phone', 'phone ')); ?>

                                <?php echo e(Form::text('phone','',['class' => 'form-control'])); ?><br>
                                <?php echo e(Form::label('address', 'address ')); ?>

                                <?php echo e(Form::text('address','',['class' => 'form-control'])); ?><br>
                                <?php echo e(Form::label('email', 'email ')); ?>

                                <?php echo e(Form::text('email','',['class' => 'form-control'])); ?><br><br>
                                <?php echo e(Form::submit('save',['class' => 'btn btn-dark btn-lg btn-block','id'=>'add-customer'])); ?>

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
                                <?php echo e(Form::open(array('id'=>'edit-customer-form','enctype'=>'multipart/form-data'))); ?>

                                <?php echo e(Form::label('name', 'name ')); ?>

                                <?php echo e(Form::text('name','',['class' => 'form-control','id'=>'name-edit'])); ?><br>
                                <?php echo e(Form::label('phone', 'phone ')); ?>

                                <?php echo e(Form::text('phone','',['class' => 'form-control','id'=>'phone-edit'])); ?><br>
                                <?php echo e(Form::label('email', 'email ')); ?>

                                <?php echo e(Form::email('email','',['class' => 'form-control','id'=>'email-edit'])); ?><br>
                                <?php echo e(Form::label('address', 'address ')); ?>

                                <?php echo e(Form::text('address','',['class' => 'form-control','id'=>'address-edit'])); ?><br><br>
                                <?php echo e(Form::submit('save',['class' => 'btn btn-dark btn-lg btn-block','id'=>'edit-customer'])); ?>

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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script>
        $( document ).ready(function() {
            /* ------------------- new-customer----------------- */
            $(document).on("click", "#add-customer", function (e) {
                var path = <?php echo json_encode(url('/')); ?>;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'customers',
                    data: new FormData($("#add-customer-form")[0]),
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
                        $('#add-customer-form').trigger("reset");
                        $(".article-table").prepend("<tr class='article-" + data.id + "'>" +
                            "<th scope='row'>" + data.id + "</th>" +
                            "<td>" + data.name + "</td>" +
                            "<td>" + data.phone + "</td>" +
                            "<td>" + data.address + "</td>" +
                            "<td>" + data.email + "</td>" +
                            "<td><button class='edit-article btn btn-info'  data-toggle='modal' data-target='#edit-modal-article' data-id='" + data.id + "' data-email='" + data.email +"' data-phone='" + data.phone + "' data-address='" + data.address + "' data-name='" + data.name + "'  ><i class='far fa-edit'></i> update</button></td>" +
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
            /* -------------------edit customer----------------- */
            $(document).on('click', ".edit-article", function (e) {
                $('#edit-customer-form').trigger("reset");
                $("#name-edit").val($(this).data('name'));
                $("#phone-edit").val($(this).data('phone'));
                $("#address-edit").val($(this).data('address'));
                $("#email-edit").val($(this).data('email'));
                customerId = $(this).data('id');
            });
            $(document).on('click', "#edit-customer", function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'customers/' + customerId,
                    data: new FormData($("#edit-customer-form")[0]),
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
                            $(".article-"+articleId).replaceWith("<tr class='article-" + data.id + "'>" +
                                "<th scope='row'>" + data.id + "</th>" +
                                "<td>" + data.name + "</td>" +
                                "<td>" + data.phone + "</td>" +
                                "<td>" + data.address + "</td>" +
                                "<td>" + data.email + "</td>" +
                                "<td><button class='edit-article btn btn-info'  data-toggle='modal' data-target='#edit-modal-article'data-id='" + data.id + "' data-email='" + data.email +"' data-phone='" + data.phone + "' data-address='" + data.address + "' data-name='" + data.name + "' ><i class='far fa-edit'></i> update</button></td>" +
                                "</tr>")

                        }
                        $('#edit-customer-form').trigger("reset");
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\dayra\resources\views/admin/users/customers.blade.php ENDPATH**/ ?>