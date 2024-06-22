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
                                            <h3 class="nk-block-title page-title">Users Lists</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt d-none d-sm-block">
                                                            <a href="{{ url('/user/add') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New User</span></a>
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
                                                    <th class="nk-tb-col tb-col-sm"><span>Email</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Telp</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Role</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools">

                                                    </th>
                                                </tr><!-- .nk-tb-item -->

                                            </thead>

                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ($users as $user)

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
                                                        <span class="tb-sub">{{ $user->name }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $user->email }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $user->telp }}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $user->role }}</span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="{{ url('user/edit', $user->id) }}"><em class="icon ni ni-edit"></em><span>Edit User</span></a></li>
                                                                            <form action="{{ route('delete.user', $user->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Remove this User?')">Remove User</button>
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
