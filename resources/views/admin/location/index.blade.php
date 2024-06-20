@include('admin.template.header')
@include('admin.template.sidebar')
@include('admin.template.topbar')

<!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Location Lists</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="{{ url('/location')}}"><span>Enabled</span></a></li>
                                                                        <li><a href="{{ url('/location/indexDisabled')}}"><span>Disabled</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt d-none d-sm-block">
                                                            <a href="{{ url('/location/add') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New Location</span></a>
                                                        </li>
                                                        <li class="nk-block-tools-opt d-block d-sm-none">
                                                            <a href="#" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->

                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                                            <thead>

                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="puid">
                                                            <label class="custom-control-label" for="puid"></label>
                                                        </div>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-sm"><span>No</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Name</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Description</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Latitude</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Longitude</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Status</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools">

                                                    </th>
                                                </tr><!-- .nk-tb-item -->

                                            </thead>

                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ($locations as $location)

                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="puid1">
                                                            <label class="custom-control-label" for="puid1"></label>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{$no++}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $location->name }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $location->description }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $location->latitude }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $location->longitude }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">

                                                            @if($location->status=="Enabled")
                                                                <form action="{{ route('update.disable', $location->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                    @csrf
                                                                    @METHOD('PUT')
                                                                    <button type="submit" class="btn btn-success" onclick="return confirm('{{ __('Are you sure you want disable this location?') }}')">{{$location->status}}</button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('update.enable', $location->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                    @csrf
                                                                    @METHOD('PUT')
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want enable this location?') }}')">{{$location->status}}</button>
                                                                </form>
                                                            @endif

                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="{{ url('location/edit', $location->id) }}"><em class="icon ni ni-edit"></em><span>Edit Location</span></a></li>
                                                                            <li><a href="http://www.google.com/maps/place/{{ $location->latitude}},{{ $location->longitude}}" target="_blank"><em class="icon ni ni-eye"></em><span>View Location</span></a></li>
                                                                            <form action="{{ route('delete.location', $location->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            
                                                                            <button type="submit" class="btn btn-danger">Remove Location</button>
                                                                        </form>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr><!-- .nk-tb-item -->
                                                @endforeach
                                        </tbody>

                                    </table>

                                </div>
                                </div>

@include('admin.template.footer')

<div class="modal fade zoom" tabindex="-1" id="modalZoom">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Berita?</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus data berita berikut?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary">Hapus</a>
                <a class="btn btn-outline-light" data-bs-dismiss="modal">Tidak</a>
            </div>
        </div>
    </div>
</div>
