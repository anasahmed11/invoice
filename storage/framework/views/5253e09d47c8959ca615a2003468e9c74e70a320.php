<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <div >
        <form method="post" enctype="multipart/form-data" id="add-invoice-form">
        <div class="row ">
            <div class="col-md-12 table-holder table-responsive">
                <table class="table table-bordered table-hover" >
                    <tbody>
                    <tr>
                        <div class="col-md-6">
                            <th class="text-center"><?php echo e(Form::label('customer_id', ' customer')); ?></th>
                            <td >
                                <select class="form-control customer_id " style="height: 200px ; width: 100% ;"   name="customer_id" >
                                    <option value=""  >choose customer</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->id); ?>" ><?php echo e($row->name); ?> | <?php echo e($row->phone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                        </div>

                        <div class="col-md-6">
                            <th class="text-center">Due Date</th>
                            <td >
                                <input type="date" id="due_date " class="form-control"  placeholder="0" name="due_date" value="<?php echo date('Y-m-d'); ?>">
                            </td>
                        </div>

                    </tr>

                    </tbody>
                </table>

                <br>

            </div>
        </div>
        <div class="row " style="margin-top:20px">
            <div class="col-md-6 table-holder table-responsive">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                    <tr>
                        <th class="text-center">Grand Total</th>
                        <td class="text-center"><input type="number" name='total' id="grand_total" placeholder='0.00' class="form-control"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-3">
                    <button id="add-invoice" type="submit" class="btn btn-primary btn-block"><i class="far fa-save"></i> save</button><br><br>
                </div>
                <div class="col-3">
                    <a href="<?php echo e(route('invoice-index')); ?>" style="color: white"> <button  type="button" class="btn btn-danger btn-block"><i class="far fa-arrow-alt-circle-left"></i> Back </button></a><br><br>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.customer_id').select2({
                allowClear: true,
                width: "resolve"
            });
                /* ------------------- new-invoice----------------- */
                $(document).on("click", "#add-invoice", function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'customer-invoice',
                        data: new FormData($("#add-invoice-form")[0]),
                        dataType: 'json',
                        async: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if(data.message){

                                Swal.fire({
                                    type: 'error',
                                    title: 'sorry',
                                    text: data.message,
                                });
                            }else {
                                Swal.fire(
                                    'done',
                                    '',
                                    'success'
                                );
                                $('#add-invoice-form').trigger("reset");
                            }


                        },
                        error: function (data) {
                            $.each(data.responseJSON.errors, function (key, value) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'sorry',
                                    text: value,
                                });
                            })
                        },
                        statusCode: {
                            500: function() {
                                Swal.fire({
                                    type: 'error',
                                    title: 'sorry',
                                    text: 'you should fill  all fields ',
                                });
                            }
                        }
                    });
                    e.preventDefault();
                });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\dayra\resources\views/admin/pages/invoice/customer-invoice.blade.php ENDPATH**/ ?>