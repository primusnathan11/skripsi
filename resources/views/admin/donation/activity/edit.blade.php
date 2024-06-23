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
            <form action="{{ route('update.activity', $activity->id)}}" class="form-validate" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-gs">
                    <input type="hidden" class="form-control" id="fv-subject" name="id_donation" value="{{$activity->id_donation}}" required>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="fv-subject">Subject</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="subject" value="{{$activity->subject}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="fv-subject">Title</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="title" value="{{$activity->title}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Image</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" multiple class="form-file-input" id="customFile" name="image">
                                    <label class="form-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Deskripsi</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$activity->description}}</textarea>
                             </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="fv-subject">Link</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="link" value="{{ $activity->link}}"required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Add New Activity</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')
