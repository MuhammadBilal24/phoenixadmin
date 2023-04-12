@include('header')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Facilitators Courses</h4>
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
                            <th>Courses</th>
                            <th>Wallet Code</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

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
      @include('footer')
