<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | Gallery UKK</title>
  <!--ligthbox-->
  <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="{{ route('blank') }}" role="button"><i class="fas fa-fire"> Gallery Onlinemu!</i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('profile') }}" class="nav-link"><i class="fas fa-hello">Selamat Datang {{ Auth::user()->name }}</i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a href="/logout" role="button" class="nav-link">
            <i class="fas fa-th-large"> Logout</i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery UKK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button href="#" class="btn btn-warning mr-4" data-toggle="modal" data-target="#baru"><i class="fas fa-upload"> Upload Foto</i></button>
            </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row mr-12">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
                @foreach ($galeries as $xbr)
                    
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-red">{{ date('d-M-Y', strtotime($xbr->created_at)) }}</span>
                </div>
                <div>
                    <i class="fa fa-camera bg-purple"></i>
                    <div class="timeline-item row-mr-5">
                        <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                        <h3 class="timeline-header"><b href="#">{{ $xbr->judul }}</b> | {{ $xbr->deskripsi }}</h3>
                        <div class="timeline-body">
                          <a href="{{ Storage::url($xbr->photo) }}" download="{{ $xbr->photo }}" class="img-fluid" width="490px" data-toggle="lightbox" data-title="{{ $xbr->judul }}" data-gallery="gallery">
                            <img src="{{ Storage::url($xbr->photo) }}" class="img-fluid mb-2" width="490px"/>
                          </a>
                            <div class="row mb-4">
                              <a href="" class="btn btn-warning mr-4 fas fa-edit" style="color: white; border-radius: 5px;" data-toggle="modal" data-target="#edit{{ $xbr->id }}"> EDIT</a>
                              <a href="{{ route('galery.destroy',$xbr->id) }}" onclick="return confirm('yakin akan dihapus??')" style="border-radius: 5px" class="btn btn-danger"><i class="fas fa-trash"> HAPUS</i></a>
                            </div>
                            <div class="modal fade" id="edit{{ $xbr->id }}">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">
                                              FORM UPLOAD FOTO
                                          </h4>
                                          <button type="button" class="close" data-dissmis="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form action="{{ route('galery.update',$xbr->id) }}" method="post" enctype="multipart/form-data" id="formpost">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="id" id="id">
                                      <div class="modal-body">
                                          <div class="form-group">
                                              <label for="judul">JUDUL</label>
                                              <input type="text" name="judul" id="judul" class="form-control" placeholder="masukan judul" value="{{ $xbr->judul }}">
                                              <span class="text-danger">
                                                  @error('judul')
                                                      {{ $message }}
                                                  @enderror
                                              </span>
                                          </div>
                                          <div class="form-group">
                                              <label for="deslripsi">DESKRIPSI</label>
                                              <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="masukan deskripsi" value="{{ $xbr->deskripsi }}">
                                              <span class="text-danger">
                                                  @error('judul')
                                                      {{ $message }}
                                                  @enderror
                                              </span>
                                          </div>
                                          <div class="form-group">
                                              <label for="photo">FOTO</label>
                                              <input type="file" name="photo" id="photo" class="form-control" placeholder="masukan foto" value="{{ $xbr->photo }}">
                                              <img src="{{ Storage::url($xbr->photo) }}" alt="...">
                                              <span class="text-danger">
                                                  @error('judul')
                                                      {{ $message }}
                                                  @enderror
                                              </span>
                                          </div>
                                          <div class="modal-footer justify-content-beetwen">
                                            <button type="submit" class="btn btn-primary mr-4 "><i class="fas fa-upload"> SIMPAN PERUBAHAN</i></button>
                                          </div>
                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->
    </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="baru">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        FORM UPLOAD FOTO
                    </h4>
                    <button type="button" class="close" data-dissmis="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data" id="formpost">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">JUDUL</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="masukan judul">
                        <span class="text-danger">
                            @error('judul')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="deslripsi">DESKRIPSI</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="masukan deskripsi">
                        <span class="text-danger">
                            @error('judul')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="photo">FOTO</label>
                        <input type="file" name="photo" id="photo" class="form-control" placeholder="masukan foto">
                        <span class="text-danger">
                            @error('judul')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="modal-footer justify-content-beetwen">
                      <button type="submit" class="btn btn-primary mr-4 "><i class="fas fa-upload"> UPLOAD</i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

  <!-- /.content-wrapper -->

  <footer class="main-footer ml-1 mr-0" style="text-align: center; background-color:rgb(42, 41, 41); color:white;">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2023-2024 <a style="color:aliceblue;" href="#">MUHAMMAD RAFLI</a>.</strong> UKK SMEA.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!--ligthbox-->
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!--jQuery-->




<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>





<!--/jQuery-->
</body>
</html>
