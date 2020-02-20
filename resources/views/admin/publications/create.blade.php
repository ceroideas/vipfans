@extends('admin.layout')
@section('title' , 'Vip fans - Agregar publicación')
@section('title_content' , 'Agregar publicación')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la publicación</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/publications') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="user">Usuario</label>
			                		<select name="user" id="user" class="form-control" style="height: 36px !important">
			                			<option value="">Seleccione usuario</option>
			                			@foreach($u as $us)
			                				<option value="{{ $us->id }}">
			                					{{ $us->name }}
			                				</option>
			                			@endforeach
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="type">Tipo de publicación</label>
			                		<select name="type" id="type" class="form-control">
			                			<option value="">Seleccione tipo</option>
			                			<option value="c">Comentario</option>
			                			<option value="l">Like</option>
			                			<option value="v">Video</option>
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="status">Estatus de la publicación</label>
			                		<select name="status" id="status" class="form-control">
			                			<option value="">Seleccione estatus</option>
			                			<option value="1">Activa</option>
			                			<option value="0">Inactiva</option>
			                		</select>
			                	</div>
	                		</div>
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="content">Contenido</label>
	                				<textarea name="content" id="content" cols="30" rows="9" class="form-control" placeholder="Contenido de la publicación"></textarea>
	                			</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
		                			<label for="avatar">Foto de portada</label>
		                			<input type="file" id="input-file-now" class="dropify" name="avatar" accept="image/*" />
		                		</div>	
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">Guardar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
				$('.mydatepicker').datepicker({
					todayHighlight:true,
					format:'d/m/yyyy'
				});

		        $('.dropify').dropify({
					messages: {
		                default: 'Click aqui o arrastra un archivo',
		                remove: 'Remover',
		                error: 'Error, archivo no soportado',
		                replace:'Click aqui o arrastra un archivo para reemplazar'
		            }
				});

				$('#user').select2();

				$('.select2-selection').css('height' , '38px');
			});
		</script>
	@endsection
@stop