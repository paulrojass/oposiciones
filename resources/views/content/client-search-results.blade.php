<div class="block double-gap-top double-gap-bottom">
	<div class="container">
		<div class="row justify-content-center align-center-items">
			@if($questions->count() >= 10)
			<div class="col-lg-12">
				<div class="simple-text-block">
					<h3 style="color:#202020">{{$questions->count()}} preguntas relacionadas</h3>
					<span style="color:#202020" class=" ml-4 mr-4">
					Existe la cantidad de preguntas necesarias para realizar un exámen,<br/> Puede comenzar un examen seleccionando la cantidad deseada de preguntas y haciendo clic en el siguiente enlace<br/>
					<strong>Nota:</strong> Al hacer clic en el enlace se creará un examen en su cuenta.
				</span>
				</div>
			</div>

			<div class="col-lg-6">
				<span style="color:#202020" class="pf-title">Cantidad de preguntas</span>
				<div class="pf-field">
					<input class="small-input" type="number" min="10" max="{{ $questions->count() }}" name="number" id="number" value="10">
				</div>
			</div>
				

			<div class="browse-all-cat mt-0">
				<button class="examen-button" type="submit">Comenzar Examen</button>
			</div>

			@else
			<div class="col-lg-12">
				<div class="simple-text-block">
					<h3 style="color:#202020">{{$questions->count()}} preguntas relacionadas</h3>
					<span style="color:#202020">Selecciona otras etiquetas</span>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>