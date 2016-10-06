@extends('app')
@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="page-title">
	        <div class="title_left">
	            <h3>Lista de Proyectos</h3>
	        </div>
	    </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<a href="{{route('proyecto.create')}}">
			{{Form::button('<i class="fa fa-plus"></i> Crear Proyecto',['class'=>'btn btn-success pull-right'])}}
		</a>
	</div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h3 class="panel-title">Proyectos</h3>
			</div>
		  	<div class="panel-body">
				<table class="table table-striped responsive-utilities jambo_table bulk_action"> 
					<thead> 
						<tr> 
							<th>Nombre</th> 
							<th>Fecha final</th> 
							<th>Area</th> 
							<th>Cantidad de integrantes</th> 
							<th>Estado</th> 
							<th colspan="2">Acciones</th>
						</tr> 
					</thead> 
					<tbody> 
						@foreach($proyectos as $proyecto)
						<tr> 
							<td>{{$proyecto->nombre}}</td> 
							<td>{{$proyecto->fecha_fin}}</td> 
							<td>{{$proyecto->area->nombre}}</td> 
							<td>{{count($proyecto->investigators)}}</td>
							<td>
							@if($proyecto->status)
								{{$proyecto->status->nombre}}
							@endif
							</td>
							<td>
								<a href="{{route('proyecto.show', $proyecto->id)}}" class="btn btn-primary btn-xs" title="Visualizar"><i class="fa fa-search"></i></a>
								<a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#{{$proyecto->id}}" title="Eliminar"><i class="fa fa-remove"></i></a>
							</td>
						</tr> 

						@include('modals.delete', ['id'=> $proyecto->id, 'message' => '¿Esta seguro que desea eliminar este proyecto?', 'route' => route('proyecto.delete', $proyecto->id)])
						@endforeach
						
					</tbody> 
				</table>
		  	</div>
		</div>
    </div>
</div>


@endsection