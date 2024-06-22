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
            <form action="{{ route('store.user') }}" method="POST" enctype="multipart/form-data" class="form-validate">
            @csrf
                <div class="row g-gs">
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="name" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="fv-subject" name="email" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Password</label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" id="fv-subject" name="password" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">No. Telepon</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" id="fv-subject" name="telp" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Role</label>
                            <div class="form-control-wrap">
                                <!-- <input type="text" class="form-control" id="fv-subject" name="role" required> -->
                                <select class="form-control" id="default-06" name="role">
                                        
                                            <option value="admin">admin</option>
                                            <option value="staff">staff</option>
                                            <option value="creator">creator</option>
                                        
                                    </select>
                            </div>
                    </div>
                    <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary"> Tambahkan Pengguna Baru </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')
