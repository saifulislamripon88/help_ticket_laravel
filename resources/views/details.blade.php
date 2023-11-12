@extends('layout')

@section('title')
    Ticket Details
@endsection

@section('body')
    <section class="detailsTicket">
        <div class="container">
            <h2>ticket details</h2>
            <div class="detailsCard">
                <div class="row align-items-center">

                    <div class="col-lg-4">
                        <div class="attachment">

                                @if ($tcDetails->attachment)
                                    @php
                                        $fileExtension = strtolower(pathinfo($tcDetails->attachment, PATHINFO_EXTENSION));
                                    @endphp
                            
                                    @if (in_array($fileExtension, ['jpeg', 'jpg', 'png',]))
                                        <img src="{{ Storage::url($tcDetails->attachment) }}" class="img-thumbnail" alt="image" />
                                    @elseif ($fileExtension === 'pdf')
                                        <a class="pdf_d" href="{{ Storage::url($tcDetails->attachment) }}">View PDF</a>
                                    @else
                                        <p>File type not supported</p>
                                    @endif
                                @else
                                    <p class="text_d text-danger">There is no attachment available</p>
                                @endif
                         
                        </div>
                    </div>
                    
                    <div class="col-lg-8">
                        <div class="ticketDet">
                            <pre>Id No        : {{ ucfirst($tcDetails->id) }}</pre>
                            <pre>Title        : {{ ucfirst($tcDetails->title) }}</pre>
                            <pre>Issued Time  : {{ \Carbon\Carbon::parse($tcDetails->created_at)->diffForHumans() }}</pre>
                            <pre>Updated Time : {{ \Carbon\Carbon::parse($tcDetails->updated_at)->diffForHumans() }}</pre> 
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection