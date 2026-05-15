@extends('layouts.app')

@section('content')
    @include('partials.navigation')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.projects', ['projects' => $projects])
    @include('sections.gallery', ['mediaItems' => $mediaItems])
    @include('sections.contact')
    @include('partials.footer')
@endsection
