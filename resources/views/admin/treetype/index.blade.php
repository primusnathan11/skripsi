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
                                            <h3 class="nk-block-title page-title">Planting Partner</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                                                                                <li class="nk-block-tools-opt d-none d-sm-block">
                                                            <a href="{{ url('treetype/add') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Tree</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Description</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Is_adopted</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($treetype as $t)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid1">
                                <label class="custom-control-label" for="uid1"></label>
                            </div>
                        </td>
                        <td class="nk-tb-col">
                            <span class="tb-sub">{{ $t->name }}</span>
                        </td>
                        <td class="nk-tb-col">
                            <span class="tb-sub">{{ $t->description }}</span>
                        </td>
                        <td class="nk-tb-col">

                            @if($t->is_adopted=="1")
                                <form action="{{ route('disable.treetype', $t->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                    @csrf
                                    @METHOD('PUT')
                                    <button type="submit" class="btn btn-success" onclick="return confirm('{{ __('Are you sure you want disable this UKM?') }}')">{{$t->status}}</button>
                                </form>
                            @else
                                <form action="{{ route('enable.treetype', $t->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                    @csrf
                                    @METHOD('PUT')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want enable this UKM?') }}')">{{$t->status}}</button>
                                </form>
                            @endif

                    </td>

                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Wallet">
                                        <em class="icon ni ni-wallet-fill"></em>
                                    </a>
                                </li>
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                        <em class="icon ni ni-mail-fill"></em>
                                    </a>
                                </li>
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                        <em class="icon ni ni-user-cross-fill"></em>
                                    </a>
                                </li>
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                <li class="divider"></li><li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
                                                <li><a href="{{ route('edit.treetype', $t->id) }}"><em class="icon ni ni-edit"></em><span>Edit Tree</span></a></li>
                                                <form action="{{ route('delete.treetype', $t->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove Tree</button>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr><!-- .nk-tb-item  -->
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
@include('admin.template.footer')


