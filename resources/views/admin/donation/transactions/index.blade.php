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
                                            <h3 class="nk-block-title page-title">Manage Transactions</h3>
                                        </div><!-- .nk-block-head-content -->
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
                                                    <th class="nk-tb-col tb-col-sm"><span>Title</span></th>
                                                    <th class="nk-tb-col"><span>Collected</span></th>
                                                    <th class="nk-tb-col"><span>Target</span></th>
                                                    <th class="nk-tb-col"><span>Due Date</span></th>
                                                    <th class="nk-tb-col"><span>Is Published</span></th>
                                                    <th class="nk-tb-col"><span>Status</span></th>
                                                    <th class="nk-tb-col"><span>UKM Tani</span></th>
                                                    <th class="nk-tb-col"><span>Location</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                                </tr><!-- .nk-tb-item -->
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ( $donations as $donation )
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
                                                    <td class="nk-tb-col tb-col-sm">
                                                        <span class="tb-product">
                                                            <img src="{{ asset('storage/'. $donation->image)}}" alt="{{ asset('storage/'. $donation->image)}} }}" class="thumb">
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{Str::limit($donation->title, 20)}}<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span>{{Str::limit($donation->description, 20)}}</span>
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">Rp. {{ $donation->collected}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">Rp. {{ number_format("$donation->target",2,',','.')}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-sub">{{ $donation->due_date}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">

                                                        @if($donation->is_published=="Yes")
                                                            <form action="{{ route('update.unpublish', $donation->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                @csrf
                                                                @METHOD('PUT')
                                                                <button type="submit" class="btn btn-success" onclick="return confirm('{{ __('Are you sure you want unpublish this donation?') }}')">Published</button>
                                                            </form>
                                                        @else
                                                        <form action="{{ route('update.publish', $donation->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                            @csrf
                                                            @METHOD('PUT')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want publish this donation?') }}')">Unpublished</button>
                                                        </form>
                                                        @endif

                                                    </td>
                                                    <td class="nk-tb-col">

                                                        @if($donation->status=="Enabled")
                                                            <form action="{{ route('update.disable.donation', $donation->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                @csrf
                                                                @METHOD('PUT')
                                                                <button type="submit" class="btn btn-success" onclick="return confirm('{{ __('Are you sure you want disable this donation?') }}')">Enabled</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('update.enable.donation', $donation->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                                @csrf
                                                                @METHOD('PUT')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want enable this donation?') }}')">Disabled</button>
                                                            </form>
                                                        @endif

                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{$donation->nama_ukm}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{$donation->nama_lokasi}}</span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="{{ route('detail.donation', $donation->id) }}"><em class="icon ni ni-eye"></em><span>View Transactions</span></a></li>
                                                                            {{-- <li>
                                                                            <form action="{{ route('destroy.donation',$donation->id) }}"" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button onclick="return confirm('Are you sure you want to delete this donation?')"><em class="icon ni ni-trash"></em><span>Remove Donation</span></button>
                                                                            </form>
                                                                            </li> --}}
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
