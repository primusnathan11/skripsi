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
                                            <h3 class="nk-block-title page-title">UKM Tani</h3>
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
                                                                        <li><a id="filter-all"><span>All</span></a></li>
                                                                        <li><a id="filter-enabled"><span>Enabled</span></a></li>
                                                                        <li><a id="filter-disabled"><span>Disabled</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt d-none d-sm-block">
                                                            <a href="{{ url('/ukm/add') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New UKM Tani</span></a>
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
                                                    <th class="nk-tb-col tb-col-sm"><span>ID</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Name</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>PIC</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Status</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Selected</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-bar-c"></em><span>Update Stock</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-invest"></em><span>Update Price</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </th>
                                                </tr><!-- .nk-tb-item -->

                                            </thead>

                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ($ukm as $u)
                                                @if (request()->get('filter') == $u->status || request()->get('filter') == null)
                                                    <tr class="nk-tb-item ukm-filter" data-status="{{ $u->status }}">
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
                                                            <span class="tb-sub">{{ $u->name }}</span>
                                                        </td>
                                                        <td class="nk-tb-col">
                                                            <span class="tb-sub">{{ $u->pic }}</span>
                                                        </td>
                                                        <td class="nk-tb-col">

                                                            @if($u->status=="Enabled")
                                                                <form action="{{ route('ukm.disable', $u->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                    @csrf
                                                                    @METHOD('PUT')
                                                                    <button type="submit" class="btn btn-success" onclick="return confirm('{{ __('Are you sure you want disable this UKM?') }}')">{{$u->status}}</button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('ukm.enable', $u->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                    @csrf
                                                                    @METHOD('PUT')
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want enable this UKM?') }}')">{{$u->status}}</button>
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
                                                                                <li><a href="{{ url('ukm/edit', $u->id) }}"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Product</span></a></li>
                                                                                <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Product Orders</span></a></li>
                                                                                <form action="{{ route('delete.ukm', $u->id) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Remove this UKM?')">Remove UKM</button>
                                                                            </form>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr><!-- .nk-tb-item -->
                                                @endif
                                                @endforeach
                                        </tbody>

                                    </table>

                                </div>
                                </div>

@include('admin.template.footer')
<script>
$(document).ready(function () {
    function filterUkm(status) {
        window.location.href = window.location.origin + window.location.pathname + '?filter=' + status
    }
    $('#filter-all').click(function (e) {
        e.preventDefault();
        filterUkm('');
    });
    $('#filter-enabled').click(function (e) {
        e.preventDefault();
        filterUkm('Enabled');
    });
    $('#filter-disabled').click(function (e) {
        e.preventDefault();
        filterUkm('Disabled');
    });
});
</script>

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
