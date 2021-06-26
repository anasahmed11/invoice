<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div >
        <div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><b> Invoices</b></h1><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">

                </div>
                <div class="col-md-3 ">
                    <button class="btn btn-success btn-block" >Invoices Number <br><?php echo e($count_invoices); ?></button><br>
                </div>
                <div class="col-md-3 ">
                    <button class="btn btn-danger btn-block" >Total Invoices Value <br><?php echo e($total_invoices); ?></button><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary btn-block " ><a href="<?php echo e(route('new-invoice')); ?>" style="color: white"><i class="fas fa-cart-plus"></i> Add new</a></button><br><br>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-warning btn-block " ><a href="<?php echo e(route('customer-invoice')); ?>" style="color: white"><i class="fas fa-cart-plus"></i> invoice for existing customers</a></button><br><br>
                </div>
            </div>
            <form >
                <div class="row">

                    <div class="col-md-2">
                        <input type="text" name="customer" class="form-control" placeholder="customer">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="customer_phone" class="form-control" placeholder="phone">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="invoice_id" class="form-control" placeholder="invoice number">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark" type="submit" ><i class="fas fa-search"></i> search </button>
                        <button class="btn btn-danger " ><a href="<?php echo e(route('invoice-index')); ?>" style="color: white"><i class="far fa-arrow-alt-circle-left"></i> back</a></button><br><br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">

                        <span>From : </span>  <input type="date" name="from_date" class="form-control" id="from_date"><br>
                    </div>
                    <div class="col-md-2">
                        <span>To :</span>  <input type="date" name="to_date" class="form-control" id="to_date"><br>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="table-holder table-responsive">
                    <table class="article-table table table-striped  ">
                        <thead class="thead-light">
                        <tr>
                            <th>id</th>
                            <th>customer</th>
                            <th>phone</th>
                            <th>total</th>
                            <th>due date</th>
                            <th>print</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="invoice-<?php echo e($row->id); ?>">
                                <th scope="row"><?php echo e($row->id); ?></th>
                                <td><?php echo e($row->customer?$row->customer->name : ''); ?></td>
                                <td><?php echo e($row->customer?$row->customer->phone : ''); ?></td>
                                <td><?php echo e($row->total); ?></td>
                                <td><?php echo e($row->due_date); ?></td>
                                <td>
                                    <button class="pdf btn btn-danger" data-id="<?php echo e($row->id); ?>" ><i class="far fa-file-pdf"></i> Print</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($invoices->links()); ?>

                        </tbody>
                    </table>
                    <br><br>
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
            $(document).on("click", ".pdf", function(e) {
                var id=$(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/csv",
                    url: 'export-invoice-details/'+id,
                    beforeSend: function(){
                        Swal.fire({
                            title: 'Please Wait ..!',
                            text: ' Transaction Under processing Now .... ',
                            type: 'warning',
                            showConfirmButton: false
                        });
                    },
                    success: function(data) {
                        window.location.href = 'export-invoice-details/'+id ;
                        Swal.fire(
                            'done',
                            '',
                            'success'
                        );
                    },
                    statusCode: {
                        500: function() {
                            Swal.fire({
                                type: 'error',
                                title: 'sorry',
                                text: 'error try again ',
                            });
                        }
                    }
                });
                e.preventDefault();
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\dayra\resources\views/admin/pages/invoice/index.blade.php ENDPATH**/ ?>