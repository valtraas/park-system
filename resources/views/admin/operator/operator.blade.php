@extends('layout.dashboard')
@section('search')
    <form action="{{ route('management.index') }}">

        <div class="p-2.5 flex items-center rounded-md px-4 duration-300  bg-gray-700 text-white">
            <i class="fa-solid fa-magnifying-glass text-sm"></i>
            <input type="text" placeholder="search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none"
                name="search" value="{{ request('search') }}">
        </div>
    </form>
@endsection
@section('content')
    <div class="container mt-28  pb-16 md:pl-[280px] px-[30px] md:px-0" id="content">
        <a href={{ route('management.create') }}
            class="border border-active w-[20%] p-3 rounded-xl hover:bg-active hover:text-white duration-300">
            <i class="fa-solid fa-user me-2"></i>
            Tambah operator
        </a>
        <div class="mt-10 overflow-x-auto mb-16 ">
            <table class="table-auto border-collapse border border-sea  ">
                <thead>
                    <tr class="text-sm">
                        <th class="px-5 py-3  text-active">#</th>
                        <th class="px-5 py-3 text-white bg-sea">Nama</th>
                        <th class="px-5 py-3 text-white bg-sea">Username</th>
                        <th class="px-5 py-3 text-white bg-sea">Role</th>
                        <th class="px-5 py-3 text-white bg-sea">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operator as $item)
                        <tr>
                            <th class="px-5 py-3 border">{{ $loop->iteration }}</th>
                            <td class="px-5 py-3 border">{{ $item->nama }}</td>
                            <td class="px-5 py-3 border">{{ $item->username }}</td>
                            <td class="px-5 py-3 border">{{ $item->role->nama }}</td>
                            <td class="px-5 py-3 border">
                                <div class="flex gap-2 items-center">
                                    <div>
                                        <a href="{{ route('management.edit', ['management' => $item->username]) }}"
                                            class="border border-yellow-500 p-1 rounded-md text-yellow-500 hover:bg-yellow-500 hover:text-white duration-200 ">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('management.destroy', ['management' => $item->username]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <span
                                                class="border border-red-600 p-1 rounded-md text-red-600 hover:bg-red-600 hover:text-white duration-200 deleteButton">
                                                <i class="fa-solid fa-trash"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <p class="text-xl text-active"><i class="fa-solid fa-users me-2"></i> Rekap Login Operator</p>
        <div class="mt-10 overflow-x-auto mb-16 ">
            <table class="table-auto border-collapse border border-sea  ">
                <thead>
                    <tr class="text-sm">
                        <th class="px-5 py-3  text-active">#</th>
                        <th class="px-5 py-3 text-white bg-sea">Nama</th>
                        <th class="px-5 py-3 text-white bg-sea">Username</th>
                        <th class="px-5 py-3 text-white bg-sea">login</th>
                        <th class="px-5 py-3 text-white bg-sea">logout</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($login as $item)
                        <tr>
                            <th class="px-5 py-3 border">{{ $loop->iteration }}</th>
                            <td class="px-5 py-3 border">{{ $item->user->nama }}</td>
                            <td class="px-5 py-3 border">{{ $item->user->username }}</td>
                            <td class="px-5 py-3 border">{{ $item->login }}</td>
                            <td class="px-5 py-3 border">{{ $item->logout }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // delete 
            const deleteButton = document.querySelectorAll(".deleteButton");
            deleteButton.forEach(element => {
                element.addEventListener("click", function(event) {
                    const deleteForm = event.target.closest('form')
                    event.preventDefault();
                    Swal.fire({
                        title: "Apakah anda yakin?",
                        text: "Data ini akan di hapus",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Delete",
                        cancelButtonText: "Cancel",
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil di hapus',
                                'success'
                            )
                            deleteForm
                        .submit(); // Mengirim form untuk melakukan DELETE request
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire(
                                "Cancelled",
                                "Anda membatalkan penghapusan data",
                                "error"
                            );
                        }
                    });
                });

            });
        })
    </script>
@endsection
