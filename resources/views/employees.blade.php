<!DOCTYPE html>
  
<html lang="en">
<head>
<title>testapp</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h2>DataTable <a href="#" target="_blank">testapp</a></h2>
<br>
<br>
  
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
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id=""><span id="empname"></span> Employee Detail</h4>
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
</div>
</div>
</div>
</body>
<script>
 $(function() {
   var table = $('.laravel_datatable').DataTable({
        ajax: '{!! route('employee.list') !!}',
        select:true ,
        estroy: true,
        scrollX: true,
        searching: true,
        lengthChange: true,
        pageLength: 8,
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
                  var btnempDetail = 0;
                    btnempDetail=`<button class='btn bg-black btn-xs' type='button' onclick='openModal(`+data+`)'>Show</button>`;
                  return (btnempDetail!=0 ? btnempDetail : "");
                }
            }
      ]
    });  
}); 
 function openModal(row){
  $('#employee_details').modal('show');
      $.ajax({
        url: '{{route('getemprecord')}}',
        type: 'GET',
        data: {id: row},
        async: false,
        success: function(response){
            $('#tbl_emp').empty();
            $.each(response,function(index, el) {
              var temp = `
                <tr>
                  <td>`+el.name+`</td>
                  <td>`+el.address+`</td>
                  <td>`+el.contact+`</td>
                  <td>`+el.gender+`</td>
                  <td>`+el.date_of_joining+`</td>
                  <td>`+el.email+`</td>
                </tr>
              `;
              $('#tbl_emp').append(temp);
            });
            $('#employee_details').modal('show');
        }
      })
    }
</script>
</html>