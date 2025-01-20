<div class="card" style=" border: dashed 1px; ">
    <div class="card-body text-center"><strong>
        <form action="{{ route('manager.config.template', ['type' => 'slogan', 'name' => 'slogan'])}}" method="POST">
            @csrf
            <div class="form-row align-items-center">
                    <div class="col-2">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control mb-2" name="value" value="{{$templateConfig['slogan']}}" required>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-tone y mb-2">Save</button>
                    </div>
            </div>
        </form>
        </strong></div>
</div>
<div class="card" style=" border: dashed 1px; ">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                <div class="card" style=" border: dashed 1px; ">
                    <div class="card-body text-center">
                        <strong>Logo (169x45)</strong>
                        <form action="{{ route('manager.config.template', ['type' => 'banner', 'name' => 'km_banner']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group m-t-10">
                                <input type="file" class="form-control-file" id="inputImage" name="value" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-tone">Save</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card" style=" border: dashed 1px; ">
    <div class="card-body text-center"> <b>Menu</b></div>
</div>
<div class="card"  style=" border: dashed 1px; ">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="card" style=" border: dashed 1px; ">
                    <div class="card-body text-center">
                        <b>Promotions</b>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4" >
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12"><div class="card text-center" style=" border: dashed 1px; "><div class="card-body"><b>Right Banner 1 </b>                                                       <div class="form-group m-t-10">
                        <input type="file" class="form-control-file m-b-15" id="inputImage" name="image" accept="image/*">
                        <button type="submit" class="btn btn-primary btn-tone ">Save</button>
                    </div>
                </div>
            </div>
        </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12"><div class="card text-center" style=" border: dashed 1px; "><div class="card-body"><b>Right Banner 2 </b>                                                       <div class="form-group m-t-10">
                        <input type="file" class="form-control-file m-b-15" id="inputImage" name="image" accept="image/*">
                        <button type="submit" class="btn btn-primary btn-tone ">Save</button>
                        
                    </div></div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" style=" border: dashed 1px; ">
    <div class="card-body text-center"><b>Deal of the day</b></div>
</div>

<div class="card" style=" border: dashed 1px; ">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <b>Left Banner</b>
                        <div class="form-group m-t-10">
                            <input type="file" class="form-control-file" id="inputImage" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary btn-tone ">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <b>Left Banner</b>
                        <div class="form-group m-t-10">
                            <input type="file" class="form-control-file" id="inputImage" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary btn-tone ">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        <b>Center Banner</b>
                        <div class="form-group m-t-10">
                            <input type="file" class="form-control-file" id="inputImage" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary btn-tone ">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>