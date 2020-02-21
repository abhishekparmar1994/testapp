<!DOCTYPE html>
  
<html lang="en">
<head>
<title>testapp</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h2>DataTable <a href="#" target="_blank">testapp</a></h2>
<br>
<br>
<form id="form1">
  <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>
<table class="table laravel_datatable  table-bordered table-striped" id="table1">
   <thead>
     <tr>
          <th>Sr no</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact</th>
          <th>Gender</th>
          <th>Date Of Joining</th>
          <th>Email</th>
          <th>Action</th>

      </tr>
   </thead>
</table>
</div>
  
{{-- employee Details Modal --}}
  <div class="modal fade" id="employee_details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" style="width:60%">

      <div class="modal-content" style="width: 800px">
        <div class="modal-header">
          <h4 class="modal-title" id="">Employee Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row" id='fuel_detail'>
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width:10%">Name</th>
                    <th style="width:10%">Address</th>
                    <th style="width:10%">Contact</th>
                    <th style="width:10%">Gender</th>
                    <th style="width:10%">Date of Joinig</th>
                    <th style="width:10%">Email</th>
                  </tr>
                </thead>
                <tbody id ="tbl_emp"></tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{-- employee Edit Modal --}}
  <div class="modal fade" id="employee_edit_details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" style="width:60%">

      <div class="modal-content" style="width: 800px">
        <div class="modal-header">
          <h4 class="modal-title" id="">Employee Edit Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row" id='fuel_edit_detail'>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="emp_name" name="name" placehoder="Enter Name" value="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="emp_address" name="address" placehoder="Enter Address" value="" class="form-control">
                      </div>
                    </div>
           
           
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Contact</label>
                        <input type="text" id="emp_contact" name="contact" placehoder="Enter contact" value="" class="form-control">
                        <span class="text-danger">{{ $errors->first('contact') }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender</label>
                        <select id="gender" name="gender" class="form-control">
                          <option value="">Select Gender</option>
                          <option selected value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                    </div>
            
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date of Joining</label>
                        <input type="text"  id="date_of_joining" name="date_of_joining" placehoder="Enter Date of joining" class="form-control datepicker">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="emp_email" name="email" placehoder="Enter email" value="" class="form-control">
                      </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="update_data">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  
</div>
</div>
</div>
</form>
</body>
<script>
 $(function() {
   var table = $('.laravel_datatable').DataTable({
        ajax: '{!! route('employee.list') !!}',
        select:true ,
        order:[[0, 'desc']],
        estroy: true,
        scrollX: true,
        searching: true,
        lengthChange: true,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        paging: true,
        info: true,
        autoWidth: false,
        columns: [
            {data:'id', name:'id',},
            {data:'name', name:'name'},
            {data:'address', name:'address'},
            {data:'contact', name:'contact'},
            {data:'gender', name:'gender'},
            {data:'date_of_joining', name:'date_of_joining'},
            {data:'email', name:'email'},
            {data:'id', name: 'id',
                render: function(data){
                  var btnempDetail = 0,btnbtnempedit = 0;
                    btnempDetail=`<button class='btn bg-black btn-xs' type='button' onclick='openModal(`+data+`)'>Show</button>`;
                    btnbtnempedit=`<button class='btn bg-black btn-xs' type='button' onclick='openEditModal(`+data+`)'>Edit</button>`;
                  return (btnempDetail!=0 ? btnempDetail : "")+" "+(btnbtnempedit!=0 ? btnbtnempedit : "");;
                }
            }
        ]
    });  
}); 

function openModal(id){
  $.ajax({
      type:'get',
      url: '/api/getedit/'+id,
      async: false,
      success:function(res){
        $('#tbl_emp').empty();
        var temp = `
            <tr>
                <td>`+res.data.name+`</td>
                <td>`+res.data.address+`</td>
                <td>`+res.data.contact+`</td>
                <td>`+res.data.gender+`</td>
                <td>`+res.data.date_of_joining+`</td>
                <td>`+res.data.email+`</td>
            </tr>
        `;
        $('#tbl_emp').append(temp);
        $('#employee_details').modal('show');
      }
  })
}
function openEditModal(id){
  $.ajax({
      type:'get',
      url: '/api/getedit/'+id,
      async: false,
      success:function(res){
        $('#emp_name').val(res.data.name);
        $('#emp_address').val(res.data.address);
        $('#emp_contact').val(res.data.contact);
        $("#gender").val(res.data.gender);
        $('#date_of_joining').val(res.data.date_of_joining);
        $('#emp_email').val(res.data.email);
        $('#employee_edit_details').modal('show');

        $('#update_data').click(function(){
          $.ajax({ 
              type: 'PUT',
              url: 'api/employee/' + id,
              data: {
                'id':id,
                '_token': $('input[name=_token]').val(),
                'name': $('#emp_name').val(), 
                'address': $('#emp_address').val(), 
                'contact': $('#emp_contact').val(), 
                'gender': $('#gender').val(),
                'date_of_joining': $('#date_of_joining').val(),
                'email': $('#emp_email').val()
              },
              success: function(res){
                console.log(res);
              }
          });
      });
      }
  })
}

//for jq code for model date picker
$('#employee_edit_details').on('shown.bs.modal', function() {
  $('#date_of_joining').datepicker({
    format: "dd/mm/yyyy",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    container: '#employee_edit_details modal-body'
  });
});



</script>
</html>