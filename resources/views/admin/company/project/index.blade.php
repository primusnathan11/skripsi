@include('admin.template.header')
@include('admin.template.sidebar')
@include('admin.template.topbar')

<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Project List</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total 95 projects.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            
                                        </li>
                                        <li class="nk-block-tools-opt d-none d-sm-block">
                                            <a href="{{ route('add.projects') }}"  class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambahkan Projek</span></a>
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
                <div class="nk-block">
                    <table class="nk-tb-list is-separate nk-tb-ulist">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="pid-all">
                                        <label class="custom-control-label" for="pid-all"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">Project Name</span></th>
                                <th class="nk-tb-col tb-col-xxl"><span class="sub-text">Client</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Project Lead</span></th>
                                <!-- <th class="nk-tb-col tb-col-lg"><span class="sub-text">Team</span></th> -->
                                <!-- <th class="nk-tb-col tb-col-xxl"><span class="sub-text">Status</span></th> -->
                                <!-- <th class="nk-tb-col tb-col-md"><span class="sub-text">Progress</span></th> -->
                                <th class="nk-tb-col tb-col-sm"><span class="sub-text">Deadline</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-end">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-xs btn-trigger btn-icon dropdown-toggle me-n1" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Mark As Done</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-archive"></em><span>Mark As Archive</span></a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </th>
                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                        @foreach ($project as $project)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="pid-01">
                                        <label class="custom-control-label" for="pid-01"></label>
                                    </div>
                                </td>
                                <td class="nk-tb-col">
                                    <a href="html/apps-kanban.html" class="project-title">
                                        <!-- <div class="user-avatar sq bg-purple"><span>DD</span></div> -->
                                        <div class="project-info">
                                            <h6 class="title">{{ $project->name }}</h6>
                                        </div>
                                    </a>
                                </td>
                                <td class="nk-tb-col tb-col-xxl">
                                    <span>Softnio</span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <span>{{ $project->description }}</span>
                                </td>
                                
                                <td class="nk-tb-col tb-col-sm">
                                    <span class="badge badge-dim bg-warning"><em class="icon ni ni-clock"></em><span>{{ $project->planting_date }}</span></span>
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <!-- <li><a href="html/apps-kanban.html"><em class="icon ni ni-eye"></em><span>View Project</span></a></li> -->
                                                        <!-- <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Project</span></a></li> -->
                                                        <li><a href="{{ route('update.projects', $project->id) }}"><em class="icon ni ni-edit"></em><span>Edit Proyek</span></a></li>
                                                        <!-- <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Mark As Done</span></a></li> -->
                                                        <form action="{{ route('delete.projects', $project->id) }}" method="POST">
                                                     @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus berita ini?')" >Remove Product</button>
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
                    </table><!-- .nk-tb-list -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    <ul class="pagination justify-content-center justify-content-md-start">
                                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul><!-- .pagination -->
                                </div>
                                <div class="g">
                                    <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                        <div>Page</div>
                                        <div>
                                            <select class="form-select js-select2" data-search="on" data-dropdown="xs center">
                                                <option value="page-1">1</option>
                                                <option value="page-2">2</option>
                                                <option value="page-4">4</option>
                                                <option value="page-5">5</option>
                                                <option value="page-6">6</option>
                                                <option value="page-7">7</option>
                                                <option value="page-8">8</option>
                                                <option value="page-9">9</option>
                                                <option value="page-10">10</option>
                                                <option value="page-11">11</option>
                                                <option value="page-12">12</option>
                                                <option value="page-13">13</option>
                                                <option value="page-14">14</option>
                                                <option value="page-15">15</option>
                                                <option value="page-16">16</option>
                                                <option value="page-17">17</option>
                                                <option value="page-18">18</option>
                                                <option value="page-19">19</option>
                                                <option value="page-20">20</option>
                                            </select>
                                        </div>
                                        <div>OF 102</div>
                                    </div>
                                </div><!-- .pagination-goto -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@include('admin.template.footer')
<!-- content @e -->
