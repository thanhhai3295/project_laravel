<!-- jQuery -->
<script src="{{asset('assmin/js/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assmin/asset/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assmin/js/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('assmin/asset/nprogress/nprogress.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('assmin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assmin/asset/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('assmin/js/ckeditor/ckeditor.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('assmin/js/custom.min.js')}}"></script>
<script src="{{asset('assmin/js/toastr.min.js')}}"></script>
<script src="{{asset('assmin/js/message_notify.js')}}"></script>
<script src="{{asset('assmin/js/my-js.js')}}"></script>

@php
  App\Helpers\Template::showMessageNotify();
@endphp