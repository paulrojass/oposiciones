@extends('layouts.tema')
@section('title', 'Examen')
@section('header_type', 'stick-top forsticky')

@section('content')
<section>
	<div class="block no-padding">
		<div class="container fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-featured-sec">
						<div class="new-slide-2">
							{{-- <img src="http://placehold.it/1920x800" alt="" /> --}}
							<img src="" alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section>
	<div class="block less-top">
		<div class="container">
			 <div class="row">
			 	<aside class="col-lg-3 column margin_widget">
			 		<div class="widget">
			 			<div class="search_widget_job">
			 				<div class="field_w_search">
			 					<input type="text" placeholder="Search Keywords" />
			 					<i class="la la-search"></i>
			 				</div><!-- Search Widget -->
			 				<div class="field_w_search">
			 					<input type="text" placeholder="All Locations" />
			 					<i class="la la-map-marker"></i>
			 				</div><!-- Search Widget -->
			 			</div>
			 		</div>
			 		<div class="widget border">
			 			<h3 class="sb-title open">Specialism</h3>
			 			<div class="specialism_widget">
			 				<div class="simple-checkbox">
								<p><input type="checkbox" name="spealism" id="as"><label for="as">Accountancy (2)</label></p>
								<p><input type="checkbox" name="spealism" id="asd"><label for="asd">Banking (2)</label></p>
								<p><input type="checkbox" name="spealism" id="errwe"><label for="errwe">Charity & Voluntary (3)</label></p>
								<p><input type="checkbox" name="spealism" id="fdg"><label for="fdg">Digital & Creative (4)</label></p>
								<p><input type="checkbox" name="spealism" id="sc"><label for="sc">Estate Agency (3)</label></p>
								<p><input type="checkbox" name="spealism" id="aw"><label for="aw">Graduate (2)</label></p>
								<p><input type="checkbox" name="spealism" id="ui"><label for="ui">IT Contractor (7)</label></p>
			 				</div>
			 			</div>
			 		</div>
			 		<div class="widget border">
			 			<h3 class="sb-title open">Team Size</h3>
			 			<div class="specialism_widget">
			 				<div class="simple-checkbox">
								<p><input type="checkbox" name="spealism" id="t1"><label for="t1">1 - 10</label></p>
								<p><input type="checkbox" name="spealism" id="t2"><label for="t2">100 - 200</label></p>
								<p><input type="checkbox" name="spealism" id="t3"><label for="t3">201 - 301</label></p>
								<p><input type="checkbox" name="spealism" id="t4"><label for="t4">301 - 401</label></p>
								<p><input type="checkbox" name="spealism" id="t5"><label for="t5">401 - 501</label></p>
								<p><input type="checkbox" name="spealism" id="t6"><label for="t6">501 - 601</label></p>
								<p><input type="checkbox" name="spealism" id="t7"><label for="t7">601 - 701</label></p>
			 				</div>
			 			</div>
			 		</div>
			 		<div class="widget border">
			 			<h3 class="sb-title open">Since</h3>
			 			<div class="range_slider">
			 				<div class="nstSlider" data-range_min="1990" data-range_max="2018"  data-cur_min="1991"    data-cur_max="2007">
							    <div class="bar"></div>
							    <div class="leftGrip"></div>
							    <div class="rightGrip"></div>
							</div>
							<div class="leftLabel"></div>
							<div class="rightLabel"></div>
			 			</div>
			 		</div>
			 	</aside>
			 	<div class="col-lg-9 column">
			 		<div class="filterbar">
			 			<p>Total of 145 Employer</p>
			 			<div class="sortby-sec">
			 				<span>Sort by</span>
							<select data-placeholder="20 Per Page" class="chosen">
								<option>30 Per Page</option>
								<option>40 Per Page</option>
								<option>50 Per Page</option>
								<option>60 Per Page</option>
							</select>
			 			</div>
			 		</div>
			 		<div class="alpha-pag">
			 			<a href="#" title="" class="active">ALL</a><a href="#" title="">A</a><a href="#" title="">B</a><a href="#" title="">C</a><a href="#" title="">D</a><a href="#" title="">E</a><a href="#" title="">F</a><a href="#" title="">G</a><a href="#" title="">H</a><a href="#" title="">I</a><a href="#" title="">J</a><a href="#" title="">K</a><a href="#" title="">L</a><a href="#" title="">M</a><a href="#" title="">N</a><a href="#" title="">O</a><a href="#" title="">P</a><a href="#" title="">Q</a><a href="#" title="">R</a><a href="#" title="">S</a><a href="#" title="">T</a><a href="#" title="">U</a><a href="#" title="">V</a><a href="#" title="">W</a><a href="#" title="">X</a><a href="#" title="">Y</a><a href="#" title="">Z</a>
			 		</div>
			 		<div class="emply-list-sec style2">
			 			<div class="emply-list">
			 				<div class="emply-list-thumb">
			 					<a href="#" title=""><img src="http://placehold.it/80x80" alt="" /></a>
			 				</div>
			 				<div class="emply-list-info">
			 					<div class="emply-pstn">4 Open Position</div>
			 					<h3><a href="#" title="">King LLC</a></h3>
			 					<span>Accountancy, Human Resources</span>
			 					<h6><i class="la la-map-marker"></i> Toronto, Ontario</h6>
			 					<p>The Heavy Equipment / Grader Operator  is responsible for operating one or several types construction equipment, such as front end loader, roller, bulldozer, or excavator to move,…</p>
			 				</div>
			 			</div><!-- Employe List -->
			 		</div>
			 	</div>
			</div>
		</div>
	</div>
</section>








@endsection


@section('scripts')

@endsection