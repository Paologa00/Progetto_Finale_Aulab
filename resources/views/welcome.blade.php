<x-layout header="diNuovo">
    @if(session('message'))
        <div class="alert alert-success text-center">
            {{session('message')}}
        </div>
    @endif

    <div class="container p-5">
        <div class="row justify-content-center">
            @foreach($articles as $article)

            
            <div class="col-12 col-md-3">
                <h1 class="text-center"> {{ $article->category->name }} </h1>
                
                <div class="card shadow">
                    <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center p-1"> {{ $article->title }} </h5>
                      <p class="small text-muted text-center"> {{ $article->category->name }} </p>
                    </div>
                    <div class= "text-muted d-flex justify-content-center align-items-center text-center">
                        <a href="{{ route('article.show', compact('article')) }}" class="btn btn-warning"> Dettagli </a>
                    </div>
                    <hr>
                    <p class="text-center p-2 text-muted"> Creato il : {{ $article->created_at->format('d/m/Y') }} da {{ $article->user->name }} </p>
                </div>
                
            </div>
           @endforeach 
        </div>
    </div>


</x-layout>