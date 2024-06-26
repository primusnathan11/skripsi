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
            <form action="{{ route('store.projects') }}" method="POST" enctype="multipart/form-data" class="form-validate">
            @csrf
                <div class="row g-gs">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="name" required>
                            </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="default-06">Select Company</label>
                        <div class="form-control-wrap ">
                            <div class="form-control-select">
                                <select class="form-control" id="default-06" name="user_id">
                                    @foreach ($partners as $p)
                                        <option value="{{ $p->id }}">{{ $p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="fv-subject">Deskripsi</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="fv-subject" name="description" required>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="fv-subject">Alamat</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="fv-subject" name="address" required>
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
                                                <input type="file" class="form-file-input" id="customFile" name="photo">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="fv-subject">Tanggal Inisiasi</label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control" id="fv-subject" name="planting_date" required>
                                        </div>
                                </div>
                            </div>

                    <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary"> Tambahkan Project </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')
