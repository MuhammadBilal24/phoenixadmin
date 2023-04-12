@include('header')

<div class="content container-fluid">
    <!-- Page Title -->
    <div class="mb-3">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="" alt="">

        </h2>
    </div>
    <!-- End Page Title -->

    <!-- End Page Header -->
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="title-color text-capitalize"
                                           for="exampleFormControlInput1">Title</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="New notification"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label class="title-color text-capitalize"
                                           for="exampleFormControlInput1">Description</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <center>
                                        <img class="upload-img-view mb-4" id="viewer"
                                             onerror=""
                                             src=""
                                             alt="image"/>
                                    </center>
                                    <label
                                        class="title-color text-capitalize">Image </label>
                                    <span class="text-info">Ratio_1:1</span>
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileEg1">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-secondary">reset </button>
                            <button type="submit" class="btn btn--primary">Send -> Notification </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                            <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2">
                               Push_Notification_Table
                                <span
                                    class="badge badge-soft-dark radius-50 fz-12 ml-1">total</span>
                            </h5>
                        </div>
                        <div class="col-sm-8 col-md-6 col-lg-4">
                            <form action="" method="GET">
                                <div class="input-group input-group-merge input-group-custom">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                           placeholder=""
                                           aria-label="Search orders" value="" required>
                                    <button type="submit"
                                            class="btn btn--primary">search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                           class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                        <tr>
                            <th>{{\App\CPU\translate('SL')}} </th>
                            <th>{{\App\CPU\translate('Title')}} </th>
                            <th>{{\App\CPU\translate('Description')}} </th>
                            <th>{{\App\CPU\translate('Image')}} </th>
                            <th>{{\App\CPU\translate('Notification_Count')}} </th>
                            <th>{{\App\CPU\translate('Status')}} </th>
                            <th>{{\App\CPU\translate('Resend')}} </th>
                            <th class="text-center">{{\App\CPU\translate('Action')}} </th>
                        </tr>

                        </thead>

                        <tbody>
                        @foreach($notifications as $key=>$notification)
                            <tr>
                                <td>{{$notifications->firstItem()+ $key}}</td>
                                <td>
                                    <span class="d-block">
                                        {{\Illuminate\Support\Str::limit($notification['title'],30)}}
                                    </span>
                                </td>
                                <td>
                                    {{\Illuminate\Support\Str::limit($notification['description'],40)}}
                                </td>
                                <td>
                                    <img class="min-w-75" width="75" height="75"
                                         onerror="this.src='{{asset('public/assets/back-end/img/160x160/img2.jpg')}}'"
                                         src="{{asset('storage/app/public/notification')}}/{{$notification['image']}}">
                                </td>
                                <td id="count-{{$notification->id}}">{{ $notification['notification_count'] }}</td>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="status switcher_input"
                                               id="{{$notification['id']}}" {{$notification->status == 1?'checked':''}}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-success square-btn btn-sm"
                                       onclick="resendNotification(this)" data-id="{{ $notification->id }}">
                                        <i class="tio-refresh"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-outline--primary btn-sm edit square-btn"
                                           title="{{\App\CPU\translate('Edit')}}"
                                           href="{{route('admin.notification.edit',[$notification['id']])}}">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-outline-danger btn-sm delete"
                                           title="{{\App\CPU\translate('Delete')}}"
                                           href="javascript:"
                                           id="{{$notification['id']}}')">
                                            <i class="tio-delete"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <table class="mt-4">
                        <tfoot>
                        links
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
</div>
@include('footer')
