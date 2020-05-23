
<div class="col-lg-12 col-md-5 col-sm-12 col-xs-12 mt-5">
	@foreach ($tags as $tag)
	<p class="remember-label mr-4">
		<input class="chbox" type="checkbox" name="tag[{{ $tag->id }}]" id="{{ $tag->id }}">
		<label class="chbox" for="{{ $tag->id }}">{{ $tag->name }}</label>
	</p>
	@endforeach
</div>

@if($tags->count() > 0 )
<div class="col-lg-12">
	<div class="simple-text-block">
		<a type="submit" title="">Realizar búsqueda</a>
		<button class="bsearch" type="submit" title="">Realizar búsqueda</button>
	</div>
</div>
@endif



