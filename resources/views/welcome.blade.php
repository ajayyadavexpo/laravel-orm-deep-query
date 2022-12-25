<x-guest-layout>


  <div class="overflow-hidden relative w-64 mt-4 mb-4 p-5">
    <form class="form" method="POST" action="{{route('upload')}}" enctype="multipart/form-data">
      @csrf
      <input type="file" name="file" /> 
      <button type="submit" class="px-5 py-2 mt-3 rounded-lg bg-black text-white">Submit</button>
  </div>

  <div class="w-full mt-6">
    <div class="bg-white pb-4 px-4 rounded-md w-full">
      <div class="flex justify-between w-full pt-6 ">
        <p class="ml-3"> Posts Table</p>
        <svg width="14" height="4" viewBox="0 0 14 4" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g opacity="0.4">
            <circle cx="2.19796" cy="1.80139" r="1.38611" fill="#222222"/>
            <circle cx="11.9013" cy="1.80115" r="1.38611" fill="#222222"/>
            <circle cx="7.04991" cy="1.80115" r="1.38611" fill="#222222"/>
          </g>
        </svg>

      </div>
      <div class="overflow-x-auto mt-6">
        <table class="table-auto border-collapse w-full">
          <thead>
            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
              <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Title</th>
              <th class="px-4 py-2 " style="background-color:#f8f8f8">Author</th>
              <th class="px-4 py-2 " style="background-color:#f8f8f8">Created At</th>
            </tr>
          </thead>
          <tbody class="text-sm font-normal text-gray-700">
           @foreach($posts as $post)
           <tr class="hover:bg-gray-100 hover:text-blue-400 border-b border-gray-200 py-10">
            <td class="px-4 py-4"><a href="{{ route('post.view',['slug'=>$post->slug]) }}">{{ $post->title }}</a></td>
            <td class="px-4 py-4">{{ $post->user->name }}</td>
            <td class="px-4 py-4">{{ $post->created_at->diffForHumans() }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div id="pagination" class="w-full flex justify-center border-t border-gray-100 pt-8 items-center">

      {{ $posts->links() }}


    </div>
  </div>

  <style>
  
  thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
  thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}

  tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
  tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}


</style>
</div>

</x-guest-layout>

