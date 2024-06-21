@include('admin.template.header')
@include('admin.template.sidebar')
@include('admin.template.topbar')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Validation - Regular Style</h4>
            <div class="nk-block-des">
                <p>Validating your form, just add the class <code class="code-class">.form-validate</code> to any <code class="code-tag">&lt;form&gt;</code>, then it validate the form show error message.</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <form action="{{ route('update.company', $company->id) }}" method="POST" enctype="multipart/form-data" class="form-validate">
            @csrf
            @method('PUT')
                <div class="row g-gs">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="name" value="{{ $company->name }}" required>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-full-name">Email</label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control" id="fv-full-name" name="email" value="{{ $company->email }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-phone">No. Telpon</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" name="phone"  value="{{ $company->phone }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="fv-subject">Alamat</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="fv-subject" name="address" value="{{ $company->address }}" required>
                                        </div>
                                </div>
                            </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-full-name">Latitude</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="fv-full-name" name="latitude" value="{{ $company->latitude }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-phone">Longitude</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" name="longitude" value="{{ $company->longitude }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <label class="form-label">Unggah Gambar</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <div class="form-group">
                                                <label class="form-file-label" for="customFile">Choose file</label>
                                                <input type="file" class="form-file-input" id="customFile" name="photo" value="{{ $company->photo }}">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                                            <label class="form-label" for="isActive">Active Status</label>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio1" name="is_active" value="1" >Active
                                                    <label class="form-check-label" for="radio1"></label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio2" name="is_active" value="0">Not Active
                                                    <label class="form-check-label" for="radio2"></label>
                                                  </div>
                                            </div>
                                            <label class="form-label" for="isActive">Verification</label>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio1" name="is_verified" value="1" >Verified
                                                    <label class="form-check-label" for="radio1"></label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio2" name="is_verified" value="0">Not Verified
                                                    <label class="form-check-label" for="radio2"></label>
                                                  </div>
                                            </div>

                    <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary"> Update Akun </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')
