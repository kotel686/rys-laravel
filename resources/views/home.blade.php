@extends('layouts.app')

@section('content')
    @include('partials.navigation')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.projects', ['projects' => $projects])
    @include('sections.gallery', ['photos' => $photos, 'videos' => $videos])
    @include('sections.contact')
    @include('partials.footer')
@endsection
