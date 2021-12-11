<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Laravel</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   </head>
   <body>
      <div class="container mt-2">
         <div class="row">
            <div class="col-lg-12 margin-tb">
               <div class="pull-left">
                  <h2>Users List</h2>
               </div>
               <div class="pull-right mb-2">
                  <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Add User</a>
               </div>
            </div>
         </div>
         @if ($message = Session::get('success'))
         <div class="alert alert-success">
            <p>{{ $message }}</p>
         </div>
         @endif
         <div class="card-body">
            <table class="table table-bordered" id="ajax-crud-datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Msisdn</th>
                     <th>Access level</th>
                     <th>External id</th>
                     <th>Mlearn id</th>
                     <th>Action</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
      <!-- boostrap company model -->
      <div class="modal fade" id="company-modal" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="CompanyModal"></h4>
               </div>
               <div class="modal-body">
                  <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Msisdn</label>
                        <div class="col-sm-12">
                           <input type="msisdn" class="form-control" id="msisdn" name="msisdn" placeholder="Enter Msisdn" maxlength="50" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Access Level</label>
                        <div class="col-sm-12">
                          <select class="form-control" name="access_level" id="access_level">
                            <option value="pro">Pro</option>
                            <option value="premium">Premium</option>
                          </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">External id</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" id="external_id" name="external_id" placeholder="Enter external id" required="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                           <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" required="">
                        </div>
                     </div>
                     <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                        </button>
                     </div>
                  </form>
               </div>
               <div class="modal-footer"></div>
            </div>
         </div>
      </div>
      <!-- end bootstrap model -->
   </body>
   <script type="text/javascript">
    $(document).ready( function () {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/user') }}",
        columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'msisdn', name: 'msisdn' },
        { data: 'access_level', name: 'access_level' },
        { data: 'external_id', name: 'external_id' },
        { data: 'mlearn_id', name: 'mlearn_id' },
        {data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
      });
    });
    function add(){
      $('#CompanyForm').trigger("reset");
      $('#CompanyModal').html("Add User");
      $('#company-modal').modal('show');
      $('#id').val('');
    }
    function editFunc(id){
      $.ajax({
        type:"get",
        url: "{{ url('api/user/show') }}"+"/"+id,
        dataType: 'json',
      success: function(res){
        $('#CompanyModal').html("Edit Company");
        $('#company-modal').modal('show');
        $('#id').val(res.data.id);
        $('#name').val(res.data.name);
        $('#access_level').val(res.data.access_level);
        $('#msisdn').val(res.data.msisdn);
        $('#external_id').val(res.data.external_id);
        $('#password').val(res.data.password);
      }
      });
    }
    function upDownFunc(mlearn_id,type){

        if(type == 'upgrade'){

        $.ajax({
            type:"put",
            url: "{{ url('api/mlearn/upgrade') }}"+"/"+mlearn_id,
            dataType: 'json',
        success: function(res){
            alert('Upgrade realizado com sucesso');
            var oTable = $('#ajax-crud-datatable').dataTable();
        oTable.fnDraw(false);
            }
        });

        }else{

        $.ajax({
            type:"put",
            url: "{{ url('api/mlearn/downgrade') }}"+"/"+mlearn_id,
            dataType: 'json',
            success: function(res){
                alert('Downgrade realizado com sucesso');
                var oTable = $('#ajax-crud-datatable').dataTable();
        oTable.fnDraw(false);
            }
        });

        }

    }
    function deleteFunc(id){
      if (confirm("Delete Record "+ id +"?") == true) {
      var id = id;
      // ajax
      $.ajax({
        type:"DELETE",
        url: "{{ url('api/user/delete') }}",
        data: { id: id },
        dataType: 'json',
      success: function(res){
        var oTable = $('#ajax-crud-datatable').dataTable();
        oTable.fnDraw(false);
      }
      });
      }
    }
    $('#CompanyForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var check_id = document.forms['CompanyForm'].elements['id'].value;
      var result = "";

    if(check_id == '' || check_id == null){
        $.ajax({
                type:'POST',
                url: "{{ url('api/user/create')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
            success: (data) => {
                $("#company-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
        });

    }else{

    let  msisdn         = document.forms['CompanyForm'].elements['msisdn'].value;
    let  access_level   = document.forms['CompanyForm'].elements['access_level'].value;
    let  name           = document.forms['CompanyForm'].elements['name'].value;
    let  external_id    = document.forms['CompanyForm'].elements['external_id'].value;
    let  password       = document.forms['CompanyForm'].elements['password'].value;

      var data = {
         "id":check_id,
         "msisdn":msisdn,
         "access_level":access_level,
         "name":name,
         "external_id":external_id,
         "password":password
         }
        $.ajax({
                type:'PUT',
                url: "{{ url('api/user/edit')}}",
                data: data,
            success: (data) => {
                $("#company-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
        });
    }


    });
   </script>
</html>
