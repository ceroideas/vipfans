@extends('admin.layout')
@section('title' , 'Vip fans - Lista de publicaciones')
@section('title_content' , 'Publicaciones')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Publicaciones registradas</h5>
	                <a href="{{ url('/admin/publications/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Agregar publicación</a>
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
                    @elseif(isset($msj))
                    	<div class="alert alert-danger">
	                		{{ $msj }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <div class="table-responsive m-t-40">
		            	<table id="myTable" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Publicación</th>
									<th>Foto</th>
									<th>Usuario</th>
									<th>Tipo</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($p as $c)
									<tr>
										<td>
											{{ $c->id }}
										</td>
										<td>
											{{ $c->comment }}
										</td>
										<td>
											<img src="{{ $c->avatar }}" width="100">
										</td>
										<td>
											{{ $c->name }}
										</td>
										<td>
											@if($c->type == 'c')
												<b>Comentario</b>
											@elseif($c->type == 'l')
												<b>Like</b>
											@else
												<b>Video</b>
											@endif
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/publications/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="#delete_{{ $c->id }}" data-toggle="modal" class="btn btn-sm btn-danger">Eliminar</a>
											</div>
											<div class="modal fade" id="delete_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	¿Seguro de eliminar esta publicacion?
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	{{-- <h4>
										                		<b>{{ $c->title }}</b>
										                	</h4> --}}
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/publications/updateStatus/'.$c->id) }}" class="btn btn-danger">Eliminar</a>
										                		<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button> 
										                	</div>
										                </div>
										            </div>
										        </div>
										    </div>
										</td> 
									</tr>
								@endforeach
							</tbody>
		            	</table>
		            </div>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
			    $('#myTable').DataTable({
			        "language": {
			            "lengthMenu": "Mostrando _MENU_ registros por página",
			            "zeroRecords": "Sin datos encontrados",
			            "info": "Mostrando _PAGE_ de _PAGES_",
			            "infoEmpty": "Sin datos para mostrar",
			            "infoFiltered": "(filtrado de _MAX_ registros totales)",
			            'search':'Buscar:',
				        paginate: {
			                'first':      "Primero",
			                'previous':   "Anterior",
			                'next':       "Siguiente",
			                'last':       "Ultima"
			            }
			        }
			    });

			    $('#city').select2();

			    $('.mydatepicker').datepicker({
					todayHighlight:true,
					format:'d/m/yyyy'
				});

				setTimeout(function(){
					$('.select2-selection').css('height', '37.5px');
				} , 200);
			});
		</script>
	@endsection
@stop