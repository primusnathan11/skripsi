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
                                            <h3 class="nk-block-title page-title">Manage Activity</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt d-none d-sm-block">
                                                            <a href="{{ url('/donation/activity/add',$id_donations) }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Activity</span></a>
                                                        </li>
                                                        <li class="nk-block-tools-opt d-block d-sm-none">
                                                            <a href="#" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->

                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="true">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="puid">
                                                            <label class="custom-control-label" for="puid"></label>
                                                        </div>
                                                    </th>
                                                    <th class="nk-tb-col"><span>No</span></th>
                                                    <th class="nk-tb-col"><span>Subject</span></th>
                                                    <th class="nk-tb-col tb-col-sm"><span>Activity</span></th>
                                                    <th class="nk-tb-col"><span>Link</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                                </tr><!-- .nk-tb-item -->
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ( $transactions as $transaction )
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
                                                        <span class="tb-lead">{{ $transaction->subject}}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-sm">
                                                        <span class="tb-product">
                                                            <img src="{{ asset('storage/'. $transaction->image)}}" alt="{{ asset('storage/'. $transaction->image)}} }}" class="thumb">
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{Str::limit($transaction->title, 20)}}<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span>{{Str::limit($transaction->description, 50)}}</span>
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $transaction->link}}</span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="{{ route('edit.activity', $transaction->id) }}"><em class="icon ni ni-edit"></em><span>Edit Activity</span></a></li>
                                                                            <li><a href="{{ route('send.activity', ['id' => $transaction->id_donation, 'id_activity' => $transaction->id]) }}"><em class="icon ni ni-edit"></em><span>Send Email</span></a></li>
                                                                            <form action="{{ route('destroy.activity', $transaction->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button onclick="return confirm('Are you sure you want to delete this activity?')" >Remove Activity</button>
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
