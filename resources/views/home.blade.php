@extends('layouts.app')

@section('content')
    @include('partials.navigation')
    @include('sections.hero')
    @include('sections.services')

    @if ($projects->isNotEmpty())
        @include('sections.projects', ['projects' => $projects])
    @endif

    @if ($mediaItems->isNotEmpty())
        @include('sections.gallery', ['mediaItems' => $mediaItems])
    @endif

    @include('sections.contact')
    @include('partials.footer')
@endsection
