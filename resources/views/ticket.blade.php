@extends('layout')

@section('title')
    Homepage
@endsection

@section('body')
   

{{--  --}}
<section class="navDesign">
  <nav class="navbar navbar-expand-lg customBg" data-bs-theme="dark">
    <div class="container">

      <a class="navbar-brand" href="{{ route('ticket') }}">
        <h1 class="logo">Ti<span>ck</span>et</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse menu" id="navbarScroll">
        <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('ticket') }}">Tickets</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/create">Ticket Support</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
          </li>

        </ul>
        
      </div>
    </div>
  </nav>

  {{--  --}}



  {{--  --}}

  <div class="allTicket">
    <div class="container">
      <h2>All Ticket List</h2>
      <table>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Issued Date</th>
          <th colspan="3">Actions</th>
        </tr>

      @if (count($allTicket) > 0)
      @foreach ($allTicket as $data )
          <tr>
        <td>{{ $data->id }}</td>
        <td>{{ ucfirst($data->title) }}</td>
        {{-- <td>{{ ucfirst( $data->description) }}</td> --}}
        <td>
          @if(strlen($data->description) > 75)
              {{ ucfirst(substr($data->description, 0, 75)) }} 
              <a class="desc_link" href="{{ route('ticket.contents', $data->id) }}">...Read more</a>
          @else
              {{ ucfirst($data->description) }}
          @endif
      </td>
    
      {{--  --}}
        <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
        <td><a href="{{ route('ticket.details', $data->id) }}" class="cs_view">View</a></td>
        <td><a href="{{ route('update.view', $data->id) }}" class="cs_view">Edit</a></td>
        <td><a href="{{ route('ticket.delete', $data->id) }}" class="cs_view">Delete</a></td>
        {{-- date formate er jonno carbon formate use kora holo--}}
      </tr>
      @endforeach

      @else
        <td colspan="5" class="text-center">There is No Ticket List Available</td>
      @endif
        
      </table>
     
      <div class="cs_pagination mt-4">
        {{ $allTicket->links() }}
      </div>

  
    </div>
  </div>


</section>
{{--  --}}
@endsection


{{-- @section('ticketBody')



@endsection --}}


