@include('header')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Facilitators</h4>
                        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">
                            Add
                        </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped text-center"  id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              User ID
                            </th>
                            <th>Facilitator ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($Users_data as $value)
                            <tr>
                                <td>{{$value->id_user}}</td>
                                <td>{{$value->id_facilitator}}</td>
                                <td>{{$value->name_user}}</td>
                                <td>{{$value->email_user}}</td>
                                <td> @if ($value->status == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Offline</span>
                                    @endif
                                </td>
                                <td><button type="button" onclick="getDatafromDB('{{$value->id_user}}')" data-id="{{$value->id_user}}" class="btn btn-icon icon-left btn-light ml-auto" data-toggle="modal" data-target="#exampleModal2"><i data-feather="edit"></i> Edit</button>
                                <button type="button" onclick="deleteDatafromDB('{{$value->id_user}}')" data-id="{{$value->id_user}}" class="btn btn-icon icon-left btn-danger ml-auto">Delete</button>
                                <a href="/facilitator/courses/{{$value->id_user}}"><button type="button"  data-id="{{$value->id_user}}" class="btn btn-primary ml-auto">
                                    View</button></a></td>
                            </tr>
                         @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Add Facilitator Model -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Facilitator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/add/facilitator" method="post" class="" id="saved">
            @csrf
            <div class="modal-body">
                <label for="name_user">User Name</label>
                <input type="text" class="form-control" name="name_user" id="name_user" required>
                <label for="email_user">Email</label>
                <input type="text" class="form-control" name="email_user" id="email_user" required>
                <label for="pass_user">Password</label>
                <input type="text" class="form-control" name="pass_user" id="pass_user" required>
                <label for="status">Status</label>
                <select type="text" class="form-control" name="status" id="status" required>
                    <option value="1">Active</option>
                    <option value="0">Offline</option>
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Facilitator Model -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Facilitator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/edit/facilitator" method="post" class="" id="getForm">
            @csrf
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id_user" id="get_id_user">
                <input type="hidden" class="form-control" name="id_facilitator" id="get_id_facilitator">
                <label for="name_user">User Name</label>
                <input type="text" class="form-control" name="name_user" id="get_name_user" required>
                <label for="email_user">Email</label>
                <input type="text" class="form-control" name="email_user" id="get_email_user" required>
                <label for="status">Status</label>
                <select type="text" class="form-control" name="status" id="get_status" required>
                    <option value="1">Active</option>
                    <option value="0">Offline</option>
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@include('footer')

<script>
    // Added
    $('#saved').submit(function()
    {
        swal({
            title: "Saved",
            text: "New Facilitator Added",
            icon: "success",
            });
        // alert('saved');
    })

    //Get and Updated
    function getDatafromDB(value){
         const xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(this.responseText);
            console.log(res);
            res = res[0];
            document.getElementById('get_id_user').value = res.id_user;
            document.getElementById('get_id_facilitator').value = res.id_facilitator;
            document.getElementById('get_name_user').value = res.name_user;
            document.getElementById('get_email_user').value = res.email_user;
            document.getElementById('get_status').value = res.status;
          }
        };
        xhttp.open("GET","/api/facilitatorget/"+value);
        xhttp.send();
        // Updated Swal
        $('#getForm').submit(function(){
              swal({
                title: "Updated",
                text: "Facilitator Updated",
                icon: "success",
              });
      });
    }

    // Delete
    function deleteDatafromDB(value)
        {swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    console.log(this.responseText);
                    console.log(res);
                    if(res == 1){
                      //-----------
                      swal("Invited facilitator account deleted!", {
                      title:'Deleted',
                      icon: "success",
                      timer:1000
                    }).then(()=> {
                      window.location.reload();
                    })
                    }
                    else if (res == 0)
                   {
                    swal({
                          title:'Oops',
                          icon:'info',
                          text:'This Facilitator is using App',
                        });
                   }
                   //-------------
              }
            };
            xhttp.open("GET","/api/facilitatordelete/"+value);
            xhttp.send();
          }
        })
            ;
      }
</script>


<style>
    button svg{
      height: 15px;
      width: 15px;
      margin-right: 5px;
    }
  </style>
