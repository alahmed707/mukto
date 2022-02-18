@extends('layouts.load')

@section('content')
<div class="content-area">

  <div class="add-product-content">
      <div class="row">
          <div class="col-lg-12">
              <div class="product-description">
                  <div class="body-area">
                      @include('includes.admin.form-error')
                      <form id="geniusformdata" action="{{route('admin-portfolio-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{ __('Title') }} *</h4>
                                      <p class="sub-heading">({{ __('In Any Language') }})</p>
                                  </div>
                              </div>
                              <div class="col-lg-7">
                                  <input type="text" class="input-field" name="title" placeholder="{{ __('Title') }}" value="{{$data->title}}" required="">
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{ __('Subtitle') }} *</h4>
                                      <p class="sub-heading">({{ __('In Any Language') }})</p>
                                  </div>
                              </div>
                              <div class="col-lg-7">
                                  <input type="text" class="input-field" name="subtitle" placeholder="{{ __('Subtitle') }}" required="" value="{{$data->subtitle}}">
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                                  </div>
                              </div>
                              <div class="col-lg-7">
                                  <div class="img-upload">
                                      <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/portfolio/'.$data->photo):asset('assets/images/noimage.png') }});">
                                          <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                          <input type="file" name="photo" class="img-upload" id="image-upload">
                                      </div>
                                      <p class="text">{{ __('Prefered Size: (600x600) or Square Sized Image') }}</p>
                                  </div>

                              </div>
                          </div>

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{ __('Details') }} *</h4>
                                      <p class="sub-heading">({{ __('In Any Language') }})</p>
                                  </div>
                              </div>
                              <div class="col-lg-7">
                                  <textarea class="form-control" name="details" placeholder="Details" resize="both" rows="10" required>{{ $data->details }}</textarea>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="left-area">

                                  </div>
                              </div>
                              <div class="col-lg-7">
                                  <button class="addProductSubmit-btn" type="submit">{{ __('Update') }}</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>         

@endsection

