<div class="simple-checkbox">
	<p>
		<input type="checkbox" name="all-checked" id="all-checked">
		<label for="all-checked">Seleccionar todas las etiquetas</label>
	</p>
</div>

@foreach ($subcategories as $subcategory)
	<h3>{{$subcategory->name}}</h3>
	@php($tags = $subcategory->tags)
	<div class="specialism_widget">
		<div class="simple-checkbox">
			@foreach ($tags as $tag)
				<p>
					<input class="checkbox-tag" type="checkbox" name="tag[{{ $tag->id }}]" id="{{ $tag->id }}" value="{{ $tag->id }}">
					<label for="{{ $tag->id }}">{{ $tag->name }}</label>
				</p>
			@endforeach
		</div>
	</div>
@endforeach
