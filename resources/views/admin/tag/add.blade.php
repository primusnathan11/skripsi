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
                                            <h3 class="nk-block-title page-title">Print Tag</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">

                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->

                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="nk-block nk-block-lg">

                                            <div class="card">
                                                <div class="card-inner">

                                                        <div class="row g-gs">
                                                        <div class="col-md-12">

                                                            <form action="{{ route('print') }}" method="POST" enctype="multipart/form-data" class="form-validate">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label class="form-label" for="fv-subject">Code</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="fv-subject" name="tag_code" required>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="fv-subject">Company Name</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="fv-subject" name="company_name" required>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="fv-subject">Company Logo</label>
                                                                    <div class="form-control-wrap">
                                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                                        <input type="file"  class="form-file-input" id="customFile" name="company_logo" accept="image/*">
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="fv-subject">Start</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="number" class="form-control" id="fv-subject" name="start" min=1 required>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="fv-subject">End</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="number" class="form-control" id="fv-subject" name="end" min=1 required>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                            <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-lg btn-primary"> Print Tag </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block -->

                                </div>
                                </div>

@include('admin.template.footer')


