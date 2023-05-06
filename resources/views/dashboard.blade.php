<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex collum justify-between">
                <div class="p-6 border-solid-black">
                    <div class="flex border-solid border-black border-2 p-2 mb-5">
                        <form action="{{ route('book.store') }}" method="POST" >
                            @csrf
                            <legend>Adicionar livro</legend>
                            <x-text-input name="title"  placeholder="title"/>
                            <x-text-input name="writter"  placeholder="writter"/>
                            <x-text-input name="year"  placeholder="year"/>
                            <x-primary-button>Send</x-primary-button>
                        </form>                        
                    </div>

                    <div class="border-solid border-black border-2 p-2">
                        <legend>Livros</legend>
                        @foreach (Auth::user()->books as $books)
                            <div class="flex justify-between border-solid border-grey bg-blue-100 border-2 p-1 m-1" x-data="{ boo: false}">
                                <template  x-if="!boo">
                                    <div class="flex">
                                        <div class="flex mt-2">
                                            <p class="ml-2 mr-2">Titulo:</p>
                                            {{ $books->title }}  
                                        </div> 
                                        <div class="flex mt-2" >
                                            <p class="ml-2 mr-2">Escritor:</p>
                                            {{ $books->writter }}    
                                        </div> 
                                        <div class="flex mt-2">
                                            <p class="ml-2 mr-2">Ano:</p>
                                            {{ $books->year }}    
                                        </div> 
                                    </div>
                                </template>
                                <div class="flex">
                                    <template x-if="boo">
                                        <div>
                                            <form action="{{ route('book.update', $books) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-text-input name="t" value="{{ $books->title }}" />
                                                <x-text-input name="w" value="{{ $books->writter }}" />
                                                <x-text-input name="y" value="{{ $books->year }}" />
                                                <button class="bg-blue-500 text-white">Save</button>
                                            </form>
                                        </div>
                                    </template> 
                                    <template x-if="!boo">
                                        <x-primary-button class="ml-20" @click=" boo = true ">Edit</x-primary-button> 
                                    </template> 
                                    <template x-if="boo">
                                        <x-primary-button class="ml-20" @click=" boo = false ">Back</x-primary-button> 
                                    </template> 
                                    <form action="{{ route('book.destroy', $books) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="ml-2">Delete</x-danger-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
