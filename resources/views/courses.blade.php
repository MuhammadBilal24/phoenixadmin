@include('header')
<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Courses</h4>
                    <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover text-center" id="tableExport" style="width:100%;">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Courses</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($Course_data as $value)
                        <tr>
                            <td>{{$value->id_course}}</td>
                            <td>{{$value->course_title}}</td>
                            <td>{{$value->course_desc}}</td>
                            <td><button type="button" onclick="getDatafromDB('{{$value->id_course}}')" data-id="{{$value->id_course}}" class="btn btn-icon icon-left btn-light ml-auto" data-toggle="modal" data-target="#exampleModal2"><i data-feather="edit"></i> Edit</button>
                            <button type="button" onclick="deleteDatafromDB('{{$value->id_course}}')" data-id="{{$value->id_course}}" class="btn btn-icon icon-left btn-danger ml-auto">Delete</button>
                            <a href="/courses/lectures/{{$value->id_course}}"><button type="button"  data-id="{{$value->id_course}}" class="btn btn-primary ml-auto">
                                Details</button></a></td>
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

  <!-- Add Course Model -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/add/course" method="post" class="" id="saved">
            @csrf
            <div class="modal-body">
                <label for="course_title">Course Name</label>
                <input type="text" class="form-control" name="course_title" id="course_title">
                <label for="course_desc">Description</label>
                <input type="text" class="form-control" name="course_desc" id="course_desc">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Edit Course Model -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/edit/course" method="post" class="" id="getForm">
            @csrf
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id_course" id="get_id_course">
                <label for="course_title">Course Name</label>
                <input type="text" class="form-control" name="course_title" id="get_course_title">
                <label for="course_desc">Description</label>
                <input type="text" class="form-control" name="course_desc" id="get_course_desc">
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
            text: "New Course Added",
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
            document.getElementById('get_id_course').value = res.id_course;
            document.getElementById('get_course_title').value = res.course_title;
            document.getElementById('get_course_desc').value = res.course_desc;
          }
        };
        xhttp.open("GET","/api/Courseget/"+value);
        xhttp.send();
        // Updated Swal
        $('#getForm').submit(function(){
              swal({
                title: "Updated",
                text: "Course Updated",
                icon: "success",
              });
      });
    }

    // Delete faq Type Data
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
                      swal("Your Course has been deleted!", {
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
                          text:'There is some user using this course',
                        });
                   }
                   //-------------
              }
            };
            xhttp.open("GET","/api/Coursedelete/"+value);
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
