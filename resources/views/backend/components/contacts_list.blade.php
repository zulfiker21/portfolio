 @extends('backend.layouts.admin')
 @section('title', 'Contacts - List')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Contacts</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">List of Contacts</li>
             </ol>
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Phone</th>
                         <th scope="col">Message</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($contacts as $contact)
                         <tr>
                             <th scope="row">{{ $contact->id }}</th>
                             <td>{{ $contact->name }}</td>
                             <td>{{ $contact->email }}</td>
                             <td>{{ $contact->phone }}</td>
                             <td>{{ $contact->message }}</td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="9" class="text-center">No contacts found.</td>
                         </tr>
                     @endforelse

                 </tbody>
             </table>
     </main>
 @endsection
