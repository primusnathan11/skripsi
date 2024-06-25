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
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form action="{{ route('store.news') }}" method="POST" enctype="multipart/form-data" class="form-validate">
            @csrf
                <div class="row g-gs">
                <div class="col-md-12">

                    <div class="form-group">
                        <label class="form-label" for="fv-subject">Judul</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="title" required>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-full-name">Penulis</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="fv-full-name" name="author" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-phone">Slug</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" name="slug" required>
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
                                                <input type="file" class="form-file-input" id="customFile" name="image" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                            <label class="form-label" for="fv-phone">Berita</label>
                            <div class="card">
                                <div class="card-inner">
                                    <!-- <input placeholder="Editor content goes here"  name="content" > -->
                
                                    <!-- <trix-editor id="generateBody" name="content">  

                                    </trix-editor> -->
                                    <textarea name="content" id="generateBody" style="min-width:500px; max-width:100%; min-height:50px; height:100%; width:100%;">

                                    </textarea>
                                </div>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalDefault">
                                    Buat konten dengan AI
                                </button>
                            </div>
                            <div id="bodyGenerate">

                            </div>
                    </div>
                    <label class="form-label" for="isPublish"></label>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio1" name="type" value="1" >Publish
                                                    <label class="form-check-label" for="radio1"></label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="radio2" name="type" value="0">Unpublish
                                                    <label class="form-check-label" for="radio2"></label>
                                                  </div>
                                            </div>
                    <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary"> Tambahkan Berita </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="{{ url('newsletter/add')}}" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        <div class="modal-header">
            <h5 class="modal-title">Buat konten dengan AI</h5>
        </div>
        <div class="modal-body">
        <form id="keyprompt" >
            @csrf
            <input type="text" class="form-control" name="prompt" required>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-primary" id="loadData">Generate</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
// <!-- Ajax Return Result on Textarea Code -->
$(document).ready(function(){
    $('#loadData').click(function(event){
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data to send to the server
        var formData = $('#keyprompt').serialize();

        $.ajax({
            url: "{{ route('generate.news') }}",
            type: 'GET', // Ensure this matches your route's expected method
            data: formData,
            success: function(response){
                console.log(response);

                $('#modalDefault').modal('hide');
                // Assuming your response is like the one provided in the example
                var generateBody = response.cleaned_data;
                // $('#generateBody').html(response); // Use .html() to set HTML content
                $('#generateBody').val(response);
            },
            error: function(xhr, status, error){
                console.log(error);
            }
        });
    });
});


    </script>