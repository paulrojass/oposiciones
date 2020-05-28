
<h3>Etiquetas</h3>
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
