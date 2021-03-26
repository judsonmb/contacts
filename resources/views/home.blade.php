<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="block bg-gray-200 text-sm text-right py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                    <a href="{{ route('contact.create') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Novo registro
                        </button>
                    </a>
                </div>
                <div class="w-full max-w-screen-xl mx-auto px-6">
                    <div class="flex justify-center p-4 px-3 py-10">
                        <div class="w-full max-w-md">
                            <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                                <div class="block text-gray-700 text-lg font-semibold py-2 px-2">
                                    People List
                                </div>
                                <div class="flex items-center bg-gray-200 rounded-md">
                                    <div class="pl-2">
                                        <svg class="fill-current text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path class="heroicon-ui"
                                                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                        </svg>
                                    </div>
                                    <input
                                        class="w-full rounded-md bg-gray-200 text-gray-700 leading-tight focus:outline-none py-2 px-2"
                                        id="search" name="search" onkeyup="searchPerson();" type="text" placeholder="Search people">
                                </div>
                                <div id="list" class="py-3 text-sm">
                                    @foreach($people as $person)
                                        <div class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                            <span class="bg-gray-400 h-2 w-2 m-2 rounded-full"></span>
                                            <div class="flex-grow font-medium px-2">{{ $person->name }}</div>
                                            @if(count($person->contacts) > 0)
                                                <div class="text-sm font-normal text-gray-500 tracking-wide">{{ $person->contacts[0]->contact }} - {{ $person->contacts[0]->type }}</div>
                                            @else
                                                <div class="text-sm font-normal text-gray-500 tracking-wide">no contacts</div>
                                            @endif
                                        </div>
                                        @if(count($person->contacts) > 0)
                                            @for($i = 1; $i < count($person->contacts); $i++)
                                                <div class="flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                                                    <div class="flex-grow font-medium px-2"></div>
                                                    <div class="text-sm font-normal text-gray-500 tracking-wide">{{ $person->contacts[$i]->contact }} - {{ $person->contacts[$i]->type }}</div>
                                                </div>
                                            @endfor
                                        @endif
                                    @endforeach
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function searchPerson(){
        let text = document.getElementById('search').value;
        text = (text == '') ? '%' : text;
        if(text.length >= 3 || text == '%'){
                $.ajax({
                type:'POST',
                url:"/api/person/search/",
                dataType: 'JSON',
                data: {
                    "name": text,
                },
                success:function(data){
                
                    $('#list').html('');
                    $newList = "";
                
                    $newList += "<div class='py-3 text-sm'>";
                    for(i=0;i<data.data.length;i++)
                    {
                        $newList += "<div class='flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2'>";
                        $newList += "<span class='bg-gray-400 h-2 w-2 m-2 rounded-full'></span>";
                        $newList += "<div class='flex-grow font-medium px-2'>"+data.data[i].name+"</div>";
                        $newList += (data.data[i].contacts.length > 0) 
                                        ? "<div class='text-sm font-normal text-gray-500 tracking-wide'>"+data.data[i].contacts[0].contact+" - "+data.data[i].contacts[0].type+"</div>"
                                        : "<div class='text-sm font-normal text-gray-500 tracking-wide'>no contacts</div>";
                        $newList += "</div>";
                        if(data.data[i].contacts.length > 0){
                            for(j=1;j<data.data[i].contacts.length;j++){
                                $newList += "<div class='flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2'>";
                                $newList += "<div class='flex-grow font-medium px-2'></div>";
                                $newList += "<div class='text-sm font-normal text-gray-500 tracking-wide'>"+data.data[i].contacts[j].contact+" - "+data.data[i].contacts[j].type+"</div>"
                                $newList += "</div>";
                            }
                        }
                    }
                    $newList += "</div>"; 

                    $('#list').html($newList);
                    // console.log(data.data[0].id);
                },
                error:function($e){
                    console.log($e.responseJSON.message)
                },
            });
        } 
    }
</script>