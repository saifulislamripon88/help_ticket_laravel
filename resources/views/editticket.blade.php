@extends('layout')

@section('title')
    Edit ticket
@endsection

@section('body')
    <div class="storeForm">
        <div class="container">
            <div class="customForm">
                <h2 class="text-primary">update issued ticket</h2>
                <form action="{{ route('ticket.update', $uvTicket->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" value="{{ $uvTicket->title }}" class="form-control c_formControl 
                        @error('title') is-invalid @enderror" id="title" name="title">
                        <span class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control c_formControl @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ ("$uvTicket->description") }}</textarea>
                      <span class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                      </span>
                        </div>

                  

                      <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment(if any)</label>
                        <input class="form-control c_formControl @error('attachment') ? 'is-invalid' : '' @enderror" type="file" id="attachment" name="attachment">
                        <span class="text-danger">
                            @error('attachment')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <!-- Display the current attachment details -->
                        <p class="text-success">
                           Current Attachment : @if ( $uvTicket->attachment )
                           {{ $uvTicket->attachment }}
                           @else
                             <span class="text-danger">There is no attachment available</span>
                           @endif
                       </p> 
                    </div>
                    
                      <button type="submit" class="btn btn-primary">Update Ticket</button>

                </form>
            </div>
        </div>
    </div>
@endsection

