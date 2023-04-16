@section('content')
    <main class="h-full overflow-y-auto" x-data="classRoomData()">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Turmas
            </h2>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                          <livewire:class-room.datatable/>
                    </div>
                </div>
            </div>
        </div>
     <div>
        <livewire:class-room.create>
     </div>   
     
    </main>

    
@endsection

@push('scripts')
    <script>
        function classRoomData() {
            return {
                showCreateModal: false,
                toogleShowCreateModal() {
                    this.showCreateModal = !this.showCreateModal
                }
            }
        }
    </script>
@endpush
