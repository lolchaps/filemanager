@extends('layouts.app')

@section('content')
  <div class="container-fluid">

    {{-- Top Bar --}}
    <div class="row page-title-row">
      <div class="col-md-6">
        <div class="pull-left">
          <ul class="breadcrumb">
            @foreach ($breadcrumbs as $path => $disp)
              <li><a href="/admin/upload?folder={{ $path }}">{{ $disp }}</a></li>
            @endforeach
            <li class="active">{{ $folderName }}</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 text-right">
        <button type="button" class="btn btn-default btn-md"
                data-toggle="modal" data-target="#modal-folder-create">
          <i class="fa fa-plus-circle"></i> New Folder
        </button>
        <button type="button" class="btn btn-default btn-md"
                data-toggle="modal" data-target="#modal-file-upload">
          <i class="fa fa-upload"></i> Upload
        </button>
      </div>
    </div>

    <div class="row">

      <div class="col-sm-2 p-0">
        {{-- @include('admin.partials.errors')
        @include('admin.partials.success') --}}
        <aside class="text-center">
          <ul class="nav nav-stacked">
            @foreach ($subfolders as $path => $name)
              <li class="active">
                <a href="/admin/upload?folder={{ $path }}">{{ $name }}</a>
              </li>
            @endforeach
          </ul>
        </aside>
      </div>

      <div class="col-sm-10" style="background-color: black; height: 500px; border: 10px solid #757575;">
        {{-- The Files --}}
        <div class="file-content">
          @foreach ($files as $file)
            <div class="row">
              @if (is_image($file['mimeType']))
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <a href="{{ $file['webPath'] }}">
                      <img src="{{ $file['webPath'] }}" alt="" style="width:100%">
                      <div class="caption">
                        <p>{{ $file['name'] }}</p>
                      </div>
                    </a>
                  </div>
                </div>
              @endif

              @if (is_video($file['mimeType']))
                <div class="col-sm-4">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $file['webPath'] }}"></iframe>
                  </div>
                  <p style="color: white">
                    {{ $file['name'] }}
                  </p>
                </div>
              @endif

              @if (is_application($file['mimeType']))
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <a href="{{ $file['webPath'] }}">
                      <img src="/img/pdf.jpg" alt="" style="width:100%">
                      <div class="caption">
                        <p>{{ $file['name'] }}</p>
                      </div>
                    </a>
                  </div>
                </div>
              @endif

            </div>
          @endforeach
        </div>
        
      </div>

    </div>
  </div>

  @include('filemanager.partials.modals')

@stop

@section('scripts')
  <script>

    // Confirm file delete
    function delete_file(name) {
      $("#delete-file-name1").html(name);
      $("#delete-file-name2").val(name);
      $("#modal-file-delete").modal("show");
    }

    // Confirm folder delete
    function delete_folder(name) {
      $("#delete-folder-name1").html(name);
      $("#delete-folder-name2").val(name);
      $("#modal-folder-delete").modal("show");
    }

    // Preview image
    function preview_image(path) {
      $("#preview-image").attr("src", path);
      $("#modal-image-view").modal("show");
    }

    // Startup code
    $(function() {
      $("#uploads-table").DataTable();
    });
  </script>
@stop