@extends('layout')

@section('title')
    Contents
@endsection

@section('body')
    <section class="contents">
        <div class="container">
            <div class="detailsContent">
                <p><strong>Title :</strong>       {{ ucfirst($readContents->title) }}</p>
                <p><strong>Description :</strong> {{ ucfirst($readContents->description) }}</p>
                <p><strong>Attachment :</strong></p>
                <div class="contentAttachment">

                    @if ($readContents->attachment)
                        @php
                            $fileExtension = strtolower(pathinfo($readContents->attachment, PATHINFO_EXTENSION));
                        @endphp
                
                        @if (in_array($fileExtension, ['jpeg', 'jpg', 'png',]))
                            <img src="{{ Storage::url($readContents->attachment) }}" class="img-thumbnail" alt="image" />
                        @elseif ($fileExtension === 'pdf')
                            <a class="pdf_d" href="{{ Storage::url($readContents->attachment) }}">View PDF</a>
                        @else
                            <p>File type not supported</p>
                        @endif
                    @else
                        <p class="text-danger">There is no attachment available</p>
                    @endif
             
            </div>

            </div>
        </div>
    </section>
@endsection