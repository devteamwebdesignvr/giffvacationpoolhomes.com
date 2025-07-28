
<h4 class="text-warning">Seo Section</h4>

  

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label("Location") !!}      
      {!! Form::select("location_id",ModelHelper::getLocationSelectList(),null,["class"=>"form-control","placeholder" =>"select location"]) !!}
      <span class="text-danger">{{ $errors->first("seo_url") }}</span>
    </div>
  </div>
    <div class="col-md-6">
    <div class="form-group">
         <label>SEO URL ( Only A-z,0-9,_,- are allowed)*</label>
            {!! Form::text("seo_url",null,["class"=>"form-control", "pattern"=>"[a-zA-Z0-9-_]+", "title"=>"Enter Valid SEO URL", "oninvalid"=>"this.setCustomValidity('SEO URL is not Valid Please enter first letter must be a-z and only accept chars a-z 0-9,-,_')" ,"onchange"=>"try{setCustomValidity('')}catch(e){}", "oninput"=>"setCustomValidity(' ')","required"=>"required"]) !!}
      <span class="text-danger">{{ $errors->first("seo_url") }}</span>
    </div>
  </div>
    <div class="col-md-3">
    <div class="form-group">
      {!! Form::label("Home page show") !!}
      {!! Form::select("is_home",Helper::getBooleanDataActual(),null,["class"=>"form-control"]) !!}
    </div>
  </div>
    <div class="col-md-3">
    <div class="form-group">
      {!! Form::label("status") !!}
      {!! Form::select("status",Helper::getBooleanDataActual(),null,["class"=>"form-control"]) !!}
    </div>
  </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("meta_title") !!}
            {!! Form::textarea("meta_title",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("meta_title")}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("meta_keywords") !!}
            {!! Form::textarea("meta_keywords",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("meta_keywords")}}</span>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("rental_Agreement_attachment") !!}
            {!! Form::file("rental_aggrement_attachment",["class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("rental_aggrement_attachment")}}</span>
             @isset($data)
                @if($data->rental_aggrement_attachment!="")
                     <a href="{{ asset(($data->rental_aggrement_attachment)) }}" target="_BLANK" >Attachment</a>  <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_rental_aggrement_attachment" value="yes" type="checkbox" id="remove_rental_aggrement_attachment" >
                        <label for="remove_rental_aggrement_attachment" class="custom-control-label">Remove Rental Agreement Attachment</label>
                    </div>
                @endif
            @endisset
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("meta_description") !!}
            {!! Form::textarea("meta_description",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("meta_description")}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("header_section") !!}
            {!! Form::textarea("header_section",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("header_section")}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("footer_section") !!}
            {!! Form::textarea("footer_section",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("footer_section")}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("bookng_widget") !!}
            {!! Form::textarea("bookng_widget",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("bookng_widget")}}</span>
        </div>
    </div>
</div>