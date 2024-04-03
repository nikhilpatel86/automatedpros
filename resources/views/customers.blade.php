<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <br>
            <center>
            <a class="link-info" href="{{ route('ajaxupload.index' )}}">Visit AJAX Image uploading</a>   | 
            <a class="link-info" href="{{ route('customers.index' )}}">Visit AJAX Registration TableGrid</a>
           </center>
           <br>
            <h3><center>Customers Grid    </center></h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Customer
            </button>

            
            <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">New Customer</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="form" action="" method="POST">
                         
                             
                            <div class="modal-body">
                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" name="name" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone*</label>
                                    <input type="text" name="phone" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Email*</label>
                                    <input type="text" name="email" class="form-control input-sm">
                                </div>
                            </div>
                       
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-save">Save changes</button>
                </div>
              </div>
            </div>
          </div>


            <hr>

            <table id="customers" class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th width="70">Action</th>
                    </tr>
                </thead>

            </table>

 
            
        </div>
    </div>
</div>
 




<script>
  jQuery(document).ready(function($) {
   // $(document).ready(function() {
        $.noConflict();
        var token = $("#csrf-token").val();
        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
        
        var table = $('#customers').DataTable({
                ajax: '',
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action'},
                ]
            });

        btnAdd.click(function(){
            modal.modal()
            form.trigger('reset')
            modal.find('.modal-title').text('Add New')
            btnSave.show();
            btnUpdate.hide()
        })

        btnSave.click(function(e){
            e.preventDefault();
            var data = form.serialize()
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(data)
            $.ajax({
                type: "POST",
                url: "/customers/store",
                data: data+'&_token='+token,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (data) {
                    if (data.success) {
                        table.draw();
                        form.trigger("reset");
                        modal.modal('hide');
                    }
                    else {
                        alert('Delete Fail');
                    }
                }
             }); //end ajax
        })

       
       
  

        $(document).on('click','.btn-delete',function(){
            if(!confirm("Are you sure?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if(!rowid) return;

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
           
            
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "/customers/" + rowid,
                data: {_method: 'delete',_token:token},
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (data) {
                    if (data.success) {
                        table.row(el.parents('tr'))
                            .remove()
                            .draw();
                    }
                }
             }); //end ajax
        })
    })
</script>