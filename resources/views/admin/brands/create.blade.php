@extends('layouts.admin')

@section('title', __('words.newBrand'))

@section('myheader')
@endsection

@section('content')
<section>
    <h1>{{ __('words.newBrand') }}</h1>
</section>

<section class="content container-fluid">
  <!--------------------------
| Your Page Content Here |
-------------------------->

<div class="col-xs-12">
  <div class="box box-primary">
      
    <div class="box-header with-border">
      <h3 class="box-title">{{ __('words.newBrand') }}</h3>
    </div>

    <form role="form" method="post"  action="{{ url('admin/brand/') }}" enctype="multipart/form-data">
      @csrf

      <div class="box-body">
        <div asp-validation-summary="ModelOnly" class="text-danger"></div>

        <div class="form-group">
            <label for="Name" class="control-label">{{ __('words.Pic') }}</label>
            <div>
              <img id="inputImage" onclick="$('#pic').trigger('click');" style="cursor: pointer;width: auto;height: 180px;"
                src="/img/no-image.png" class="img-rounded" alt="no Image Available">
              <input id="pic" name="pic" type="file" onchange="GetImage()" style="display: none" accept="image/*"/>
            </div>
        </div>

      </div>

      <!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('words.Save') }}</button>
      </div>

    </form>

  </div>
</div>

</section>

@endsection

@section('myfooter')
  <script>
    function GetImage() {
      try {
        var input = document.getElementById("pic");
        if (input.files && input.files[0]) {
          //var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
          var fileExtension = ['jpg'];
          if ($.inArray(input.value.split('.')[input.value.split('.').length - 1].toLowerCase(), fileExtension) === -1) {
            $("#pic").val("");
            showAppMessage("فایل ها تنها با فرمت تصویر مجاز می باشند. " + fileExtension.join(', '), "warning");
          }
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#inputImage').attr('src', e.target.result);
            changeImage = true;
          }
          reader.readAsDataURL(input.files[0]);
        }
      } catch (e) {
        showAppMessage(e.statusMessage, "error");
      }
    };
  </script>
@endsection