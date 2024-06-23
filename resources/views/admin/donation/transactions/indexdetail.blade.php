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

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-inner">
                                                <h6 class="card-subtitle mb-2">Total Paid</h6>
                                                <h5 class="card-title">Rp. {{ number_format("$total_paid")}}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-inner">
                                                <h6 class="card-subtitle mb-2">Total Success</h6>
                                                <h5 class="card-title">{{ $total_success}}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-inner">
                                                <h6 class="card-subtitle mb-2">Total Requests</h6>
                                                <h5 class="card-title">{{ $total_pending}}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-inner">
                                                <h6 class="card-subtitle mb-2">Total Failed</h6>
                                                <h5 class="card-title">{{ $total_failed}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>


                                <div class="card card-preview">
                                    <div class="card-inner">
                                        {{-- <div class="row">
                                            <div class="col-md-2">
                                                <span class="sub-text">Total Request</span>
                                                <h4>{{ $total_pending}}</h4>
                                            </div>

                                            <div class="col-md-2">
                                                <span class="sub-text">Total Success</span>
                                                <h4>{{ $total_success}}</h4>
                                            </div>
                                        </div>
                                        <br> --}}



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
                                                    <th class="nk-tb-col tb-col-sm"><span>Order Code</span></th>
                                                    <th class="nk-tb-col"><span>Donate ID</span></th>
                                                    <th class="nk-tb-col"><span>Nama Donasi</span></th>
                                                    <th class="nk-tb-col"><span>Email</span></th>
                                                    <th class="nk-tb-col"><span>Nama User</span></th>
                                                    <th class="nk-tb-col"><span>Tanggal</span></th>
                                                    <th class="nk-tb-col"><span>Grand Total</span></th>
                                                    <th class="nk-tb-col"><span>Status</span></th>
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
                                                        <span class="tb-lead">{{ $transaction->order_code}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->donate_id}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->title}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->email}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->name}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->date}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">Rp. {{ number_format("$transaction->grand_total",2,',','.')}}</span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-lead">{{ $transaction->status}}</span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1 my-n1">
                                                            <li class="me-n1">
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="#"><em class="icon ni ni-eye"></em><span>View Donation</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Donation</span></a></li>
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
