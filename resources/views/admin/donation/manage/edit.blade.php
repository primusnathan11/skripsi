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
            <form action="{{ route('update.donation', $donation->id)}}" class="form-validate" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-gs">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Select UKM Tani</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="default-06" name="id_ukm">
                                        @foreach ($ukms as $ukm)
                                            <option value="{{ $ukm->id}}" name="id_ukm">{{ $ukm->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="fv-subject">Title</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="fv-subject" name="title" value="{{ $donation->title }}" required autofocus>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Target</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    Rp
                                </div>
                                <input type="text" class="form-control" id="target" placeholder="Input placeholder" name="target" value="{{ $donation->target }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Due Date</label>
                            <div class="form-control-wrap">
                                <div class="input-group">

                                    <input type="date" class="form-control" required name="due_date" value="{{ $donation->due_date }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Planting Date</label>
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <input type="date" class="form-control" required name="planting_date" value="{{ $donation->planting_date }}"
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <label class="form-label" for="fv-phone">Description</label>
                                
                            </div>
                            <div class="card">
                                <div class="card-inner">
                                    <!-- Create the editor container -->
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder="Write your message" name="description" value="{{ $donation->description }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Select Location</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="default-06" name="id_location">
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id}}">{{ $location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Select Donation Partners</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="default-06" name="id_mitra">
                                        @foreach ($partners as $partners)
                                            <option value="{{ $partners->id }}">{{ $partners->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Select Tree Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="default-06" name="id_tree">
                                        @foreach ($treetype as $t)
                                            <option value="{{ $t->id }}">{{ $t->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="isPublish">Status</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio1" name="status" value="Enabled" >Enabled
                            <label class="form-check-label" for="radio1"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio2" name="status" value="Disabled">Disabled
                            <label class="form-check-label" for="radio2"></label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="isPublish">Is Published</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio1" name="is_published" value="Yes" >Yes
                            <label class="form-check-label" for="radio1"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio2" name="is_published" value="No">No
                            <label class="form-check-label" for="radio2"></label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="is_bingkaikarya">Is Bingkai Karya</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio1" name="is_bingkaikarya" value="Yes">Bingkai Karya
                            <label class="form-check-label" for="radio1"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio2" name="is_bingkaikarya" value="No" checked>No
                            <label class="form-check-label" for="radio2"></label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Update donation</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div><!-- .nk-block -->

@include('admin.template.footer')
