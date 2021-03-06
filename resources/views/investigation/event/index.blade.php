@extends(Auth::user() ? 'app' : 'appPublic')
@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="page-title">
            <h3>Lista de Eventos</h3>
	    </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h3 class="panel-title">Eventos</h3>
			</div>
		  	<div class="panel-body">

		  		<div class="row">
			  		<div class="col-md-6">
			            <form action="#" method="get">
			                <div class="input-group">
			                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
			                    <input class="form-control" id="event-search" name="q" placeholder="Buscar" required>
			                    <span class="input-group-btn">
			                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			                    </span>
			                </div>
			            </form>
			        </div>
			        @if(Auth::user() && (Auth::user()->IdPerfil != 5 || Auth::user()->IdPerfil == Config::get('constants.admin')))
			        <div class="col-md-6">
						<a href="{{route('evento.create')}}">
							{{Form::button('<i class="fa fa-plus"></i> Crear Evento',['class'=>'btn btn-success pull-right'])}}
						</a>
					</div>
					@endif
				</div>

		  		<div class="table-responsive">
					<table class="table table-list-search table-striped responsive-utilities jambo_table bulk_action"> 
						<thead> 
							<tr class="headings"> 
								<th>Nombre</th> 
								<th>Fecha del evento</th> 
								<th>Tipo</th> 
								<th>Grupo</th> 
								<th colspan="2">Acciones</th>
							</tr> 
						</thead> 
						<tbody> 
							@foreach($events as $event)
							<tr> 
								<td>{{$event->nombre}}</td> 
								<td>{{$event->fecha}}</td> 
								<td>
								@if($event->tipo == 0)
									Público
								@else
									Privado
								@endif
								</td>
								<td>{{$event->group->nombre}}</td> 
								<td>
									<a href="{{route('evento.show', $event->id)}}" class="btn btn-primary btn-xs" title="Visualizar"><i class="fa fa-eye"></i></a>
									@if(Auth::user() && (Auth::user()->IdUsuario == $event->group->leader->user->IdUsuario || Auth::user()->IdPerfil == Config::get('constants.admin')))
									<a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#{{$event->id}}" title="Eliminar"><i class="fa fa-remove"></i></a>
									@endif
								</td>
							</tr> 

							@include('modals.delete', ['id'=> $event->id, 'message' => '¿Esta seguro que desea eliminar este evento?', 'route' => route('evento.delete', $event->id)])
							@endforeach
							
						</tbody> 
					</table>
				</div>
		  	</div>
		</div>
    </div>
</div>

<script src="{{ URL::asset('js/intranetjs/investigation/event/index-event.js')}}"></script>

@endsection