@extends('layouts.app')

@section('head_resources')

	@parent
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

@endsection

@section('content')
<div class="container-fluid">
	@include('modals.modal_upload')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="col-md-12 mb-4">
				<button type="button" class="btn btn-primary btn-ico" data-toggle="modal" data-target="#uploaderModal"><i class="fa fa-files-o"></i> {{ __('File Upload') }}</button>
			</div>
		</div>
	</div>
    <div class="row">
        @foreach($media_obj as $media)
            <div class="col-md-2 border m-1 p-1">
                <img src="{!! env('APP_URL').'/'.$media->url !!}" style="width:100%; height:auto">
                <div>name: {{ $media->name }}</div>
                <div>mime: {{ $media->mime }}</div>
                <div>size: {{ $media->humanFileSize() }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('footer_resources')
@parent
	<!-- Scripts -->
	<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
	<script>
		var home_url = "{{env('APP_URL') }}";
		var deleteAction = '{{ route("file-delete") }}';
		var generalTS =  document.getElementById('dataTS').value;
		var generalDATE = document.getElementById('dataDATE').value;
		var token = '{!! csrf_token() !!}';
	</script>

	<script src="{{ asset('js/file_upload.js') }}"></script>
@endsection
