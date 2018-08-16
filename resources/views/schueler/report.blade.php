@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-3 text-white"])
		<h4>@lang('messages.createcase')</h4>
		
		@if ($errors->any())

            @foreach ($errors->all() as $error)
            	<div class="alert alert-warning">
            		<span class="font-weight-bold">Error: </span> {{ $error }}
            	</div>
            @endforeach
		@endif

		<form id="case-form" method="post" class="form" role="form" action="{{ route('incidents.store') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">
					@lang('messages.casetitle')
				</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="@lang('placeholders.casetitle')">
			</div>

			<div class="form-group">
				<label for="message">
					@lang('messages.casedescription')
				</label>
				<textarea class="form-control" id="message" name="message"></textarea>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="message">
						@lang('messages.mentorsselect')
					</label>
					<mentor-select-field :mentors='[
						@foreach (auth()->user()->school->users()->mentor()->mentoring()->get() as $mentor)
							{!! json_encode(["id" => $mentor->id, "name" => $mentor->fullName()]) !!},
						@endforeach
					]'/>
				</div>
				<div class="form-group col-md-6">
					<label for="category">
						@lang('messages.categoryselect')
					</label>

					<select id="category-select" class="form-control" id="category" name="category">
					@for ($i = 0; $i < sizeof(config('exclamo.categories', [])); $i++)
						<option value="{{ $i }}">{{ ucwords(config('exclamo.categories')[$i]) }}</option>
					@endfor
					</select>
				</div>
			</div>
			<div class="form-row">
		        <div class="col-md-6">
		        	<div class="form-group">
		                <div class="input-group date" id="case-date-picker" data-target-input="nearest">
							<label for="date">
								@lang('messages.dateselect')
							</label>

							<div class="input-group">
			                    <datepicker :monday-first="true" :disabled-dates="{'from': new Date()}" class="form-control datetimepicker-input" name="incident_date"></datepicker>

			                    <div class="input-group-append">
			                        <div class="input-group-text">
			                        	<i class="fa fa-calendar"></i>
			                        </div>
			                    </div>
			                </div>
			            </div>
		        	</div>
                </div>
		        <div class="col-md-6">
					<div class="form-group">
						<label for="location">
							@lang('messages.locationselect')
						</label>

						<select id="location-select" class="form-control" id="location" name="location">
						@foreach(auth()->user()->school->locations as $location)
							<option value="{{ $location->id }}">
								{{ $location->title }}
							</option>
						@endforeach
						</select>
					</div>
                </div>
			</div>

			<div class="form-row">
				<div class="form-check justify-content-center align-self-center mx-auto">
					<input type="checkbox" class="form-check-input" id="case-anonymous" name="case-anonymous" value="case-anonymous">
					<label class="form-check-label" for="case-anonymous">
						@lang('messages.case_should_be_anonymous')
					</label>
				</div>
			</div>

			<div class="form-group text-center justify-content-center mt-3">
				<button type="submit" class="btn btn-primary">
					<i class="far fa-check-circle"></i>
					@lang('messages.createbutton')
				</button>
			</div>
		</form>
	@endexclamoflexsection
@endsection